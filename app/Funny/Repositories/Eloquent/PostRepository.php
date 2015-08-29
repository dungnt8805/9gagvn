<?php
/**
 * @author dungnt13
 * @date 8/28/2015
 */

namespace App\Funny\Repositories\Eloquent;


use App\Funny\Models\Post;
use App\Funny\Repositories\BaseRepository;
use App\Funny\Repositories\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * Create a new DbPostRepository instance.
     *
     * @param  \App\Funny\Models\Post $post
     */

    public function __construct(Post $post)
    {
        $this->model = $post;
    }
}