<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 9/26/15
 * Time: 9:05 PM
 */

namespace App\Http\Controllers\Auth;


use App\Funny\Repositories\Contracts\PostRepositoryInterface;
use App\Funny\Repositories\Eloquent\PostRepository;
use App\Http\Controllers\Controller;
use Auth;

class VoteController extends AuthorizedController
{
    protected $post;

    public function __construct(PostRepositoryInterface $post)
    {
        parent::__construct();
        $this->post = $post;

    }

    public function postLike()
    {
        $input = $this->input();
        $post_id = $input['post_id'];
        $result = $this->post->like($post_id, Auth::user()->id);
        return $this->json(['data' => $result, 'error' => 0, 'message' => 'success']);
    }

    public function postUnLike()
    {
        $input = $this->input();

    }

    public function postDislike()
    {
        $input = $this->input();
        $post_id = $input['post_id'];
        $result = $this->post->dislike($post_id, Auth::user()->id);
        return $this->json(['data' => $result, 'error' => 0, 'message' => 'success']);

    }
}