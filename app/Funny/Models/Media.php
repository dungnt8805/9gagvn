<?php
/**
 * @author dungnt13
 * @date 8/28/2015
 */

namespace App\Funny\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'medias';

    public function user(){
        return $this->belongsTo();
    }
}