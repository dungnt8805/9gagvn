<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 9/9/2015
 * Time: 10:46 AM
 */

namespace App\Funny\Facades;


use Illuminate\Support\Facades\Facade;

class ImageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return new \App\Funny\Services\Image;
    }
}