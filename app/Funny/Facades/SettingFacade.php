<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 10/1/15
 * Time: 11:46 PM
 */

namespace App\Funny\Facades;


use Illuminate\Support\Facades\Facade;

class SettingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return new \App\Funny\Repositories\Eloquent\SettingRepository;
    }
}