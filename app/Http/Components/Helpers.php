<?php
/**
 * Created by PhpStorm.
 * User: Poya
 * Date: 08/11/15
 * Time: 8:15 PM
 */

namespace App\Http\Components;


class Helpers {

	/**
	 * Standard function to convert an int/string array to format optimized for search needed to be stored in db
	 *
	 * @param array $array data to be converted to storable string
	 * @return string
	 */
	public static function convertDBArrayToString($array)
	{
		if ($array == null || empty($array)) return null;

		$return = "|";
		$return .= implode('|', $array);
		$return .= "|";

		return $return;
	}

	/**
	 * A standard function to convert a stored DB array in form of a string back to the original array.
	 *
	 * @param string $string String data obtained from DB
	 * @return array
	 */
	public static function convertDBStringToArray($string)
	{
		$array = explode('|', $string);
		foreach ($array as $i => $item) {
			if ($item === '' || $item === null) unset($array[$i]);
		}

		return $array;
	}

	/**
	 * Generates a standard url safe slug given any string
	 *
	 * @param string $text
	 * @return string
	 */
	public static function generateSlug($text)
	{
		$remove = array("!", ",", ":", ";", "@", "#", "?", "(", ")", "*", ".", "\"", "/", '"', "%", "&");
		$return = strtolower(str_replace(' ', '-', str_replace($remove, '', $text)));

		return $return;
	}

	/**
	 * Limits the character count of a long string to a certain count (def 255) and adds "..." if string is truncated.
	 * Returns the truncated string that doesnt not exceed the char count provided
	 *
	 * @param string $string original
	 * @param int $len Length of the desired string
	 * @return string
	 */
	public static function truncate($string, $len = 255)
	{
		if ($string == null)
			return "";
		if (strlen($string) > ($len - 3)) {
			$string = substr($string, 0, $len - 3);
			$string .= '...';
			return $string;
		} else {
			return $string;
		}
	}

	/**
	 * Gets information such as Sublocal, city, state, and country from google API from a set of Lat & Lng
	 *
	 * @param double $lat Latitude
	 * @param double $lng longitude
	 *
	 * @return array
	 */
	public static function getLocationInfo($lat, $lng)
	{
		$session = curl_init('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $lng . '&sensor=false&key=');
		// Tell cURL to return the request data
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
		// Execute cURL on the session handle
		$response = curl_exec($session);
		$results = json_decode($response);
		curl_close($session);

		$result = array('sublocal' => null, 'city' => null, 'state' => null, 'country' => null);

		if ($results->status === 'OK') {
			foreach ($results->results as $res) {
				if (in_array('locality', $res->types)) {
					foreach ($res->address_components as $comp) {
						if (in_array('sublocality', $comp->types)) $result['sublocal'] = $comp->long_name;
						if (in_array('locality', $comp->types)) $result['city'] = $comp->long_name;
						if (in_array('administrative_area_level_1', $comp->types)) {
							$result['state'] = $comp->long_name;
						} elseif (in_array('administrative_area_level_2', $comp->types)) {
							$result['state'] = $comp->long_name;
						}
						if (in_array('country', $comp->types)) $result['country'] = $comp->long_name;
					}
				}
			}
			if ($result['city'] == null) $result['city'] = $result['sublocal'];
			if ($result['city'] == NULL) {
				foreach ($results->results as $res) {

					foreach ($res->address_components as $comp) {
						if (in_array('sublocality', $comp->types)) $result['sublocal'] = $comp->long_name;
						if (in_array('locality', $comp->types)) $result['city'] = $comp->long_name;
						if (in_array('administrative_area_level_1', $comp->types)) $result['state'] = $comp->long_name;
						if (in_array('country', $comp->types)) $result['country'] = $comp->long_name;
					}

				}


			}
		}
		if ($result['city'] == null) $result['city'] = $result['sublocal'];
		$result['lat'] = (double)$lat;
		$result['lng'] = (double)$lng;

		return $result;
	}

	/**
	 * getCoords
	 *
	 * Gets coordinates of a given location
	 *
	 * @param string $address address
	 *
	 * @return array lat, lng, type, status
	 */
	public static function getCoords($address)
	{
		//TODO: required valid GOOGLE_GCM_API_KEY
		$google_api_key = '';
		//
		// Google api free tier has limit of 2,500 request per day and returns null if exceeded
		//
		$session = curl_init('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=false&key=' . $google_api_key);
		// Tell cURL to return the request data
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
		// Execute cURL on the session handle
		$response = curl_exec($session);
		$result = json_decode($response);
		curl_close($session);

		$return = array('lat' => null, 'lng' => null, 'type' => null, 'status' => $result->status);

		if ($result->status === 'OK') {
			$res = $result->results;
			$return['lat'] = $res[0]->geometry->location->lat;
			$return['lng'] = $res[0]->geometry->location->lng;
			$return['type'] = $res[0]->geometry->location_type;
		}

		return $return;
	}

	/**
	 * Just a quick func to verify if a variable is set and if not set it to a default
	 *
	 * @param mixed $var Any variable or array index that might not have been set
	 * @param mixed $default Default value t return if not set
	 * @return null $var value if set and $default value if not set
	 */
	public static function verify(&$var, $default = null)
	{
		return isset($var) ? $var : $default;
	}
}