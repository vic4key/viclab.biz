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

	/**
	 * Queries the unique visitors that total/min/max visitors in a time hour/week/month.
	 * @param	string	$time	The time to query.
	 * @return json		The total/min/max visitors.
	 */
	public function QueryVisitors($time)
	{
		$result = array();

		$jdata = CloudFlare::Instance()->GetObject("analytics/dashboard", array("since" => -$time));
		jassert($jdata);

		if (!$jdata->success)
		{
			return json_encode($result);
		}

		switch ($time) {
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

		$result["total_visitors"] = $jdata->result->totals->uniques->all;

		foreach ($jdata->result->timeseries as $item)
		{
			if (!array_key_exists("min_visitors", $result) || $result["min_visitors"] > $item->uniques->all)
			{
				$result["min_visitors"] = $item->uniques->all;
			}

			if (!array_key_exists("max_visitors", $result) || $result["max_visitors"] < $item->uniques->all)
			{
				$result["max_visitors"] = $item->uniques->all;
			}
		}

		return a2j($result);
	}
}

?>