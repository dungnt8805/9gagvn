<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 10/1/15
 * Time: 11:01 PM
 */

namespace App\Funny\Models;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    public $timestamps = false;


    const GENERAL_TYPE = 1;
}