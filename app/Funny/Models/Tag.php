<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 8/29/2015
 * Time: 10:54 AM
 */

namespace App\Funny\Models;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $table = 'tags';

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}