<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 9/9/2015
 * Time: 2:12 PM
 */

namespace App\Funny\Services;

use Config;

class Timthumb
{
    public function link($url, $width = 100, $height = 100, $zc = 1)
    {
        if ($url != "") {
            if (preg_match("/(\.)*ytimg\.com\/.*/", $url)) {
                return $url;
            } else if (!preg_match("/http:/", $url) && !preg_match("/https:/", $url)) {
                $url = Config::get('app.url') . '/' . $url;
            }
            $thumb = Config::get('app.url') . '/thumb.php?src=' . urlencode($url);
            if ($width != null)
                $thumb .= "&w=$width";
            if ($height != null)
                $thumb .= "&h=$height";
            if ($zc != null)
                $thumb .= "&zc=$zc";
            return $thumb;
        } else {
            return Config::get('constants.NULL_IMAGE');
        }
    }

}