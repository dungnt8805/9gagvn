<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 9/7/2015
 * Time: 3:21 PM
 */

/**
 * Return sizes readable by humans
 */

function human_filesize($bytes, $decimals = 2)
{

    $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .
    @$size[$factor];
}

/**
 * Is the mime type an image
 */
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}