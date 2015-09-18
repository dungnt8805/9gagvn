<?php
/**
 * @author dungnt13
 * @date 8/28/2015
 */

namespace App\Funny\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    const PHOTO_TYPE = 1;
    CONST VIDEO_TYPE = 2;
    CONST COMIC_TYPE = 3;
    CONST MEME_TYPE = 4;

    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var array
     */
    protected $fillable = ['code', 'user_id'];

    /**
     * Query the categories under which the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post', 'post_id', 'category_id');
    }

    /**
     * Query the tags under which the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Query the user that posted
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Query comments which the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    /**
     * 
     * 
     * 
     * 
     * @return string
     */
    public function getLink(){
        return route('post.details',$this->code);
    }
}