<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 9/9/2015
 * Time: 2:13 PM
 */

namespace App\Funny\Facades;


use Illuminate\Support\Facades\Facade;

class TimthumbFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return new \App\Funny\Services\Timthumb;
    }
}