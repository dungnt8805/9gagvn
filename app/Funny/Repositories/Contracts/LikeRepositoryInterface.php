<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 9/27/15
 * Time: 10:06 AM
 */

namespace App\Funny\Repositories\Contracts;


interface LikeRepositoryInterface
{
    /**
     * check like
     *
     * @param $post_id
     * @param $user_id
     * @return \App\Funny\Models\Like
     */
    public function checkLike($post_id, $user_id);
}