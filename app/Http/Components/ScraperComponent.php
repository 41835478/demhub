<?php
/**
 * Created by PhpStorm.
 * User: Poya
 * Date: 28/10/15
 * Time: 1:49 PM
 */

namespace App\Http\Components;


class ScraperComponent
{

	const itemTypeNewsArticle = 1;
	const itemTypeScientificPaper = 2;
	const itemTypeOther = 9;



	/**
	 * Standard function to convert an int/string array to format optimized for search needed to be stored in db
	 *
	 * @param array $array data to be converted to storable string
	 * @return string
	 */
	public static function convertDBArrayToString($array)
	{
		$return = "|";
		$return .= implode('|', $array);
		$return .= "|";

		if(empty($array)) $return = '';

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
		foreach($array as $i=>$item){
			if($item === '' || $item === null) unset($array[$i]);
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
		$remove = array("!",",",":",";","@","#","?","(",")","*",".","\"","/",'"',"%","&");
		$return = strtolower(str_replace(' ', '-', str_replace($remove,'',$text)));

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
	public static function truncate($string, $len=255){
		if($string == null)
			return "";
		if(strlen($string)>($len-3)){
			$string = substr($string, 0, $len-3);
			$string .= '...';
			return $string;
		} else {
			return $string;
		}
	}
} 