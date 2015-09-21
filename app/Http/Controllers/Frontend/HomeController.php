<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 8/29/2015
 * Time: 8:59 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Funny\Repositories\Contracts\PostRepositoryInterface;
use Request;

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
        if (Request::isMethod('post')) {
            $posts = $this->post->index(10);
            $tmp = [];
            foreach ($posts as $post) {
                $tmp[] = [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'code' => $post->code,
                    'url' => $post->getLink(),
                    'thumbnail' => \Timthumb::link($post->getThumbnail(), 500),
                    'username' => $post->username,
                    'user_id' => $post->user_id,
                    'type' => $post->type
                ];
            }
            $response = ['status' => '1', 'msg' => 'success', 'data' => $tmp];
            return $this->json($response);
        } else
//        $posts = $this->post->index(10);
//        for ($i = 0; $i < 10; $i++) {
//            $posts[] = $post;
//        }
            return $this->view('frontend.home.index2');
    }
}