<?php

require_once("configures.php");

/**
 * Converts an array to a json object.
 * @param	array	$a	The array data.
 * @return json	The json data.
 */
function a2j($a)
{
	return json_decode(json_encode($a));
}

/**
 * Cloud Flare
 */
class CloudFlare
{
	private static $m_Instance = null;

	private $m_Host = "";
	private $m_Endpoint = "";
	private $m_Domain = "";
	private $m_ZoneID = "";
	private $m_Headers  = [];

	public function __construct()
	{
		$this->m_Host = "api.cloudflare.com";
		$this->m_Endpoint = sprintf("https://%s/client/v4/", $this->m_Host);
	}

	public static function Instance()
	{
		if (!isset(self::$m_Instance))
		{
			self::$m_Instance = new CloudFlare();
		}

		return self::$m_Instance;
	}

	/**
	 * Initializes the instance.
	 * @param	string	$domain	The domain.
	 * @param	string	$email	The email.
	 * @param	string	$key		The token.
	 * @param	string	$auth		The authentication.
	 */
	public function Initialize($domain, $email, $key, $auth)
	{
		$this->m_Headers[] = "X-Auth-Key: ".$key;
		$this->m_Headers[] = "X-Auth-Email: ".$email;
		$this->m_Headers[] = "Authorization: ".$auth;
		$this->m_Headers[] = "Content-Type: application/json";

		$zone = $this->GetZone($domain);
		jassert($zone);

		$this->m_ZoneID = $zone->id;
	}

	/**
	 * Requests an URI (HTTP & HTTPS).
	 * @param	string	$method		The method.
	 * @param	string	$uri			The URI.
	 * @param	number	$timeout	The time-out.
	 * @return json		The response data.
	 */
	public function Request($method, $uri, $timeout = 5)
	{
		# https://incarnate.github.io/curl-to-php/

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0");
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

		curl_setopt($curl, CURLOPT_URL, $uri);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $this->m_Headers);

		$data = curl_exec($curl);

		curl_close($curl);

		return json_decode($data);
	}

	/**
	 * Gets all zones (the added sites).
	 * @return json	The zones data.
	 */
	public function GetZones()
	{
		return $this->Request("GET", $this->m_Endpoint."zones");
	}

	/**
	 * Gets a zone (an added site).
	 * @param	string	$domain The added domain.
	 * @return json		The zone data.
	 */
	public function GetZone($domain)
	{
		$result = "";

		$jdata = $this->GetZones();
		jassert($jdata);

		if (!$jdata->success)
		{
			return $result;
		}

		foreach ($jdata->result as $item)
		{
			if ($item->name == $domain)
			{
				$result = $item;
				break;
			}
		}

		return $result;
	}

	/**
	 * Requests an object.
	 * @param	string	$method	The method.
	 * @param	string	$path		The object path.
	 * @param	array		$args		The time-out.
	 * @return json		The response data.
	 */
	public function RequestObject($method, $path, $args)
	{
		if (strlen($this->m_ZoneID) == 0)
		{
			return a2j(array());
		}

		$uri  = $this->m_Endpoint;
		$uri .= sprintf("zones/%s/%s", $this->m_ZoneID, $path);

		if (!empty($args))
		{
			$uri .= "?";
			$uri .= http_build_query($args);
		}

		return $this->Request($method, $uri);
	}

	/**
	 * Gets an object.
	 * @param	string	$path		The object path.
	 * @param	array		$args		The time-out.
	 * @return json		The object data.
	 */
	public function GetObject($path, $args)
	{
		return $this->RequestObject("GET", $path, $args);
	}
}

?>