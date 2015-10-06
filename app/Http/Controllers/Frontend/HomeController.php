<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 8/29/2015
 * Time: 8:59 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Funny\Repositories\Contracts\PostRepositoryInterface;
use Jenssegers\Date\Date;
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
            $addition = [];
            if (\Auth::check()) {
                $addition = [
                    'check_liked' => [
                        'user_id' => \Auth::user()->id
                    ]
                ];
            }
            $posts = $this->post->index(10, null, null, null, 'created_at', 'desc', $addition);
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
                    'type' => $post->type,
                    'name' => $post->name,
                    'views' => $post->views,
                    'likes' => $post->likes,
                    'score' => $post->score,
                    'comments' => 0,
                    'created_at_string' => Date::parse($post->created_at)->diffForHumans()
                ];
            }
            $response = ['status' => '1', 'msg' => 'success', 'data' => $tmp];
            return $this->json($response);
        } else
            return $this->view('frontend.home.index3');
    }
}