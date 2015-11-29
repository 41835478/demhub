<?php
/**
 * Created by PhpStorm.
 * User: Poya
 * Date: 29/11/15
 * Time: 3:05 PM
 */

namespace App\Http\Components;


class Video
{
	const _youtube_regex = '/(\/\/.*?youtube\.[a-z]+)\/watch\?v=([^&]+)&?(.*)/';
	const _youtubeshort_regex = '/(\/\/.*?youtu\.be)\/([^\?]+)(.*)/i';
	const _vimeo_regex = '/(\/\/.*?)vimeo\.[a-z]+\/([0-9]+).*?/';

	/**
	 * Given filetype column from DB's article_medias table will return true if the media is video
	 * @param string $source source from article_medias.filetype column
	 * @return bool True if video
	 */
	public static function isVideo($source)
	{
		if ($source == 'youtube' || $source == 'youtu.be' || $source == 'vimeo') {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Given a url param to a youtube or vimeo video, will return the related format
	 * @param string $url Url to the video
	 * @return bool|string
	 */
	public static function getSource($url)
	{
		if (preg_match(self::_youtube_regex, $url)) {
			$format = 'youtube';
		} else if (preg_match(self::_youtubeshort_regex, $url)) {
			$format = 'youtu.be';
		} else if (preg_match(self::_vimeo_regex, $url)) {
			$format = 'vimeo';
		} else {
			return false;
		}

		return $format;
	}

	/**
	 * Given a video url to either a youtube or vimeo video, will return the specific video id
	 * @param string $url Video url
	 * @return bool|string
	 */
	public static function getSourceID($url)
	{
		$format = self::getSource($url);

		switch ($format) {
			case 'vimeo':
				$vid_id = preg_replace(self::_vimeo_regex, '$2', $url);
				if (substr($vid_id, 0, 5) == "http:") { $vid_id = substr($vid_id, 5); }
				if (substr($vid_id, 0, 6) == "https:") { $vid_id = substr($vid_id, 6); }
				break;

			case 'youtube':
				$vid_id = rtrim(preg_replace(self::_youtube_regex, '$2', $url), '?');
				if (substr($vid_id, 0, 5) == "http:") { $vid_id = substr($vid_id, 5); }
				if (substr($vid_id, 0, 6) == "https:") { $vid_id = substr($vid_id, 6); }
				break;

			case 'youtu.be':
				$vid_id = rtrim(preg_replace(self::_youtubeshort_regex, '$2', $url), '?');
				if (substr($vid_id, 0, 5) == "http:") { $vid_id = substr($vid_id, 5); }
				if (substr($vid_id, 0, 6) == "https:") { $vid_id = substr($vid_id, 6); }
				break;

			default:
				return false;
		}
		return $vid_id;
	}

	/**
	 * Returns a url to the thumbnail image of the video
	 * @param string $id Vimeo/youtube video id
	 * @param string $format video format/source
	 * @param string $size Size of the thumb needed
	 * @return bool|string Url to the thumb or false if not found
	 */
	public static function getThumb($id, $format, $size = 'thumb')
	{
		if($size == '') $size = 'large';
		switch ($format) {
			case 'vimeo':
				//$hash = unserialize(file_get_contents('http://vimeo.com/api/v2/video/'.$id.'.php'));
				$curl_handle=curl_init();
				curl_setopt($curl_handle, CURLOPT_URL,'https://vimeo.com/api/v2/video/'.$id.'.php');
				curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
				curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Talentell');
				$curl_content = curl_exec($curl_handle);
				curl_close($curl_handle);

				$hash = unserialize($curl_content);

				if($size == 'icon')
					$thumb = $hash[0]['thumbnail_small'];		//too small
				elseif($size == 'thumb')
					$thumb = $hash[0]['thumbnail_medium'];
				elseif($size == 'small')
					$thumb = $hash[0]['thumbnail_large'];
				elseif($size == 'large')
					$thumb = $hash[0]['thumbnail_large'];

				break;

			case 'youtube':
				if($size == 'icon')
					$thumb = "https://img.youtube.com/vi/".$id."/default.jpg";
				elseif($size == 'thumb')
					$thumb = "https://img.youtube.com/vi/".$id."/0.jpg";  //mqdefault.jpg
				elseif($size == 'small')
					$thumb = "https://img.youtube.com/vi/".$id."/0.jpg";  //hqdefault.jpg
				elseif($size == 'large')
					$thumb = "https://img.youtube.com/vi/".$id."/0.jpg";  //sddefault.jpg
				break;

			case 'youtu.be':
				if($size == 'icon')
					$thumb = "https://img.youtube.com/vi/".$id."/default.jpg";
				elseif($size == 'thumb')
					$thumb = "https://img.youtube.com/vi/".$id."/0.jpg";  //mqdefault.jpg
				elseif($size == 'small')
					$thumb = "https://img.youtube.com/vi/".$id."/0.jpg";  //hqdefault.jpg
				elseif($size == 'large')
					$thumb = "https://img.youtube.com/vi/".$id."/0.jpg";  //sddefault.jpg sometimes missing
				break;

			default:
				return false;
		}
		return $thumb;
	}

	/**
	 * Gets the videos official url for use in browser
	 * @param string $id Video id
	 * @param string $format Video format/source
	 * @return bool|string Url of the video
	 */
	public static function getUrl($id, $format)
	{
		switch ($format) {
			case 'vimeo':
				$link = 'https://vimeo.com/'.$id;
				break;

			case 'youtube':
				$link = 'https://www.youtube.com/?v='.$id;
				break;

			case 'youtu.be':
				$link = 'https://www.youtube.com/?v='.$id;
				break;

			default:
				return false;
		}
		return $link;
	}

	/**
	 * Gets the html url for the video
	 * @param string $id Video id
	 * @param string $format Video format/source
	 * @return bool|string returns url for embedding the video
	 */
	public static function getEmbedURL($id, $format)
	{
		switch ($format) {
			case 'vimeo':
				$link = 'https://player.vimeo.com/video/'.$id;
				break;

			case 'youtube':
				$link = 'https://www.youtube.com/embed/'.$id;
				break;

			case 'youtu.be':
				$link = 'https://www.youtube.com/embed/'.$id;
				break;

			default:
				return false;
		}

		return $link;
	}

	/**
	 * Gets the html embed code for the playable video
	 * @param string $id Video id
	 * @param string $format Video format/source
	 * @return bool|string returns HTML code for embedding the video
	 */
	public static function getEmbedHTML($id, $format)
	{
		$link = self::getEmbedURL($id, $format);

		$iframe = '<iframe id="" src="'.$link.'" style="width:100%;" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		return $iframe;
	}
} 