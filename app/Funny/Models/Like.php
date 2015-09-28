<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 9/27/15
 * Time: 10:04 AM
 */

namespace App\Funny\Models;


use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    public $timestamps = false;
}