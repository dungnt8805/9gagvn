<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 10/11/15
 * Time: 6:13 PM
 */

namespace App\Funny\Services;


class Youtube
{
    public function youtubeEmbedFromUrl($youtube_url, $width, $height)
    {
        $vid_id = extractUTubeVidId($youtube_url);
        return generateYoutubeEmbedCode($vid_id, $width, $height);
    }

    public function extractUTubeVidId($url)
    {
        /*
		* type1: http://www.youtube.com/watch?v=H1ImndT0fC8
		* type2: http://www.youtube.com/watch?v=4nrxbHyJp9k&feature=related
		* type3: http://youtu.be/H1ImndT0fC8
		*/
        $vid_id = "";
        $flag = false;
        if (isset($url) && !empty($url)) {
            /*case1 and 2*/
            $parts = explode("?", $url);
            if (isset($parts) && !empty($parts) && is_array($parts) && count($parts) > 1) {
                $params = explode("&", $parts[1]);
                if (isset($params) && !empty($params) && is_array($params)) {
                    foreach ($params as $param) {
                        $kv = explode("=", $param);
                        if (isset($kv) && !empty($kv) && is_array($kv) && count($kv) > 1) {
                            if ($kv[0] == 'v') {
                                $vid_id = $kv[1];
                                $flag = true;
                                break;
                            }
                        }
                    }
                }
            }

            /*case 3*/
            if (!$flag) {
                $needle = "youtu.be/";
                $pos = null;
                $pos = strpos($url, $needle);
                if ($pos !== false) {
                    $start = $pos + strlen($needle);
                    $vid_id = substr($url, $start, 11);
                    $flag = true;
                }
            }
        }
        return $vid_id;
    }

    public function generateYoutubeEmbedCode($vid_id, $width, $height)
    {
        $w = $width;
        $h = $height;
        $html = '<iframe width="' . $w . '" height="' . $h . '" src="http://www.youtube.com/embed/' . $vid_id . '?rel=0" frameborder="0" allowfullscreen></iframe>';
        return $html;
    }

    public function processVideoImage($url, $file_name)
    {
        if ($url != '' && !is_null($url)) {
            $result = [];

            if (strpos($url, 'youtube') > 0 || strpos($url, 'youtu.be') > 0) {
                $video_id = $this->extractUTubeVidId($url);
                if (isset($video_id[1])) {
                    $img_url = 'http://img.youtube.com/vi/' . $video_id . '/0.jpg';
//                    $result['thumbnail'] =
                }
            }
        }
    }

}