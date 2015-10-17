<?php
/**
 * @author dungnt13
 * @date 8/25/2015
 */

namespace App\Funny\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'categories';

    const PHOTO_TYPE = 1;
    CONST VIDEO_TYPE = 2;
    CONST COMIC_TYPE = 3;
    CONST MEME_TYPE = 4;

    const cache_key = 'categories_list';

    /**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post', 'category_id', 'post_id');
    }

}