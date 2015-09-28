<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 9/27/15
 * Time: 10:07 AM
 */

namespace App\Funny\Repositories\Eloquent;


use App\Funny\Models\Like;
use app\Funny\Repositories\Contracts\BaseRepository;
use App\Funny\Repositories\Contracts\LikeRepositoryInterface;

class LikeRepository extends BaseRepository implements LikeRepositoryInterface
{
    public function __construct(Like $like)
    {
        $this->model = $like;
    }


    /**
     * check like
     *
     * @param $post_id
     * @param $user_id
     * @return \App\Funny\Models\Like
     */
    public function checkLike($post_id, $user_id)
    {
        return $this->model->wherePostId($post_id)->whereUserId($user_id)->first();
    }
}