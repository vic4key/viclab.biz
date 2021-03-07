<?php

require_once("defines.php");
require_once("cloudflare.php");

const CF_UV_DAY   = 24 * 60;
const CF_UV_WEEK  = 7  * CF_UV_DAY;
const CF_UV_MONTH = 30 * CF_UV_DAY;

/**
 * Cloud Flare Helper
 */
class ICloudFlare
{
	private static $m_Instance = null;

	public function __construct()
	{
		CloudFlare::Instance()->Initialize(
			$GLOBALS["domain"],
			$GLOBALS["email"],
			$GLOBALS["token"],
			$GLOBALS["auth"]
		);
	}

	public static function Instance()
	{
		if (!isset(self::$m_Instance))
		{
			self::$m_Instance = new ICloudFlare();
		}

		return self::$m_Instance;
	}

	private function GetDateRange($time, &$since, &$until)
	{
		$DT_until = new DateTime("NOW");
		// $DT_until->modify("-1 day");

		$DT_since = clone($DT_until);

		switch ($time)
		{
			case CF_UV_DAY:
				{
					$DT_since->modify("1 day ago");
				}
				break;

			case CF_UV_WEEK:
				{
					$DT_since->modify("7 days ago");
				}
				break;

			case CF_UV_MONTH:
				{
					$DT_since->modify("30 days ago");
				}
				break;

			default:
				break;
		}

		$since = $DT_since->format("Y-m-d");
		$until = $DT_until->format("Y-m-d");
	}

	/**
	 * Queries analytics in a time hour/week/month.
	 * @param	string	$time	The time to query.
	 * @return json		The analytics.
	 */
	public function QueryAnalytics($time)
	{
		$result = array();

		switch ($time)
		{
			case CF_UV_DAY:
				{
					$result["unit_time"] = "day";
					$result["per_time"]  = "hour";
				}
				break;

			case CF_UV_WEEK:
				{
					$result["unit_time"] = "week";
					$result["per_time"]  = "day";
				}
				break;

			case CF_UV_MONTH:
				{
					$result["unit_time"] = "month";
					$result["per_time"]  = "day";
				}
				break;

			default:
				{
					$result["unit_time"] = "";
					$result["per_time"]  = "";
				}
				break;
		}

		$since = "";
		$until = "";
		$this->GetDateRange($time, $since, $until);

		$zoneid = CloudFlare::Instance()->ZoneID();

		$gql = '
		{
			"query": "query GetZoneAnalytics($zoneTag: string, $since: string, $until: string) {\\n  viewer {\\n    zones(filter: {zoneTag: $zoneTag}) {\\n      totals: httpRequests1dGroups(limit: 10000, filter: {date_geq: $since, date_lt: $until}) {\\n        uniq {\\n          uniques\\n        }\\n      }\\n      zones: httpRequests1dGroups(orderBy: [date_ASC], limit: 10000, filter: {date_geq: $since, date_lt: $until}) {\\n        dimensions {\\n          timeslot: date\\n        }\\n        uniq {\\n          uniques\\n        }\\n        sum {\\n          pageViews\\n        }\\n      }\\n    }\\n  }\\n}\\n",
			"variables": {
				"zoneTag": "'.$zoneid.'",
				"since": "'.$since.'",
				"until": "'.$until.'"
			},
			"operationName": "GetZoneAnalytics"
		}
		';

		$jdata = CloudFlare::Instance()->GetGQLObject($gql);
		jassert($jdata);

		if (!$jdata)
		{
			return json_encode($result);
		}

		$tmp = (array)$jdata->data->viewer->zones[0];
		$tmp["__result__"] = $result;

		return a2j($tmp);
	}

	/**
	 * Queries the unique visitors that total/min/max visitors in a time hour/week/month.
	 * @param	string	$time	The time to query.
	 * @return json		The total/min/max visitors.
	 */
	public function QueryVisitors($time)
	{
		$result = array();

		$jdata = $this->QueryAnalytics($time);
		if (!$jdata)
		{
			return json_encode($result);
		}

		$data = (array)$jdata;
		if (!$data || !array_key_exists("__result__", $data))
		{
			return json_encode($result);
		}

		$result = (array)$jdata->__result__;

		$result["total_visitors"] = $jdata->totals[0]->uniq->uniques;

		foreach ($jdata->zones as $item)
		{
			$val = $item->uniq->uniques;

			if (!array_key_exists("min_visitors", $result) || $result["min_visitors"] > $val)
			{
				$result["min_visitors"] = $val;
			}

			if (!array_key_exists("max_visitors", $result) || $result["max_visitors"] < $val)
			{
				$result["max_visitors"] = $val;
			}
		}

		return a2j($result);
	}

	/**
	 * Queries the time series in a time hour/week/month.
	 * @param	string	$time	The time to query.
	 * @return json		The time series.
	 */
	public function QueryTimeSeries($time)
	{
		$result = array();

		$jdata = $this->QueryAnalytics($time);
		if (!$jdata)
		{
			return json_encode($result);
		}

		$data = (array)$jdata;
		if (!$data || !array_key_exists("__result__", $data))
		{
			return json_encode($result);
		}

		$result = (array)$jdata->__result__;

		$time_series = array();

		foreach ($jdata->zones as $item)
		{
			$m = array();
			$m["date_time"] = $item->dimensions->timeslot;
			$m["count_visitors"] = $item->uniq->uniques;
			array_push($time_series, $m);
		}

		$result["time_series"] = $time_series;

		return a2j($result);
	}
}

?>