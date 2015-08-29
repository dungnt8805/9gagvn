<?php
/**
 * @author dungnt13
 * @date 8/28/2015
 */

namespace App\Http\Controllers\Admin;


use App\Funny\Repositories\CategoryRepositoryInterface;
use App\Funny\Repositories\PostRepositoryInterface;

class PostsController extends AdminController
{
    /**
     * Post repository
     *
     * @var \App\Funny\Repositories\PostRepositoryInterface
     */
    protected $post;

    /**
     * Create new PostsController instance
     *
     * @param \App\Funny\Repositories\PostRepositoryInterface $post
     */
    public function __construct(PostRepositoryInterface $post)
    {
        parent::__construct();
        $this->post = $post;
    }

    public function getIndex()
    {

    }

    public function getAdd(CategoryRepositoryInterface $category)
    {
        $post = $this->post->getNew();
        return $this->view('admin.post.add', compact('post'));
    }

    public function postAdd()
    {

    }
}