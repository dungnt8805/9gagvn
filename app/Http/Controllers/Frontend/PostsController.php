<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 8/29/2015
 * Time: 11:28 AM
 */

namespace App\Http\Controllers\Frontend;


use App\Funny\Repositories\PostRepositoryInterface;

class PostsController extends FrontendController
{
    /**
     * The BlogRepository instance
     *
     * @var \App\Funny\Repositories\Eloquent\PostRepository
     */
    protected $post;

    public function __construct(PostRepositoryInterface $post)
    {
        parent::__construct();
        $this->post = $post;
    }


    public function getAdd()
    {

    }
}