<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 8/29/2015
 * Time: 11:02 AM
 */

namespace App\Funny\Models;


use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    /**
     * The database table used by model
     *
     * @var string
     */
    protected $table = 'post_tag';

    /**
     * The timestamps
     *
     * @var bool
     */
    public $timestamps = false;
}