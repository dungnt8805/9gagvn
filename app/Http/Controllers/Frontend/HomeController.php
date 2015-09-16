<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 8/29/2015
 * Time: 8:59 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Funny\Repositories\Contracts\PostRepositoryInterface;

class HomeController extends FrontendController
{

    protected $post;

    public function __construct(PostRepositoryInterface $post)
    {
        parent::__construct();
        $this->post = $post;
    }

    /**
     * Show the homepage
     * @return \View
     */
    public function getIndex()
    {
        $posts = $this->post->index(10);
//        for ($i = 0; $i < 10; $i++) {
//            $posts[] = $post;
//        }
        return $this->view('frontend.home.index', compact('posts'));
    }
}