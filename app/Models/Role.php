<?php
/**
 * @author dungnt13
 * @date 8/17/2015
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}