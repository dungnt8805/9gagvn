<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 8/29/2015
 * Time: 8:59 PM
 */

namespace App\Http\Controllers\Frontend;


class HomeController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the homepage
     * @return \View
     */
    public function getIndex()
    {

        $post = new \stdClass();
        $post->id = 'aaaa';
        $post->title = "Happy 30th birthday, Mario";
        $post->type = 1;
        $post->thumbnail = "http://img-9gag-fun.9cache.com/photo/a1Y0n5D_700b.jpg";
        $post->comments = 68;
        $post->votes = "10,145";
        $posts = [];
        for ($i = 0; $i < 10; $i++) {
            $posts[] = $post;
        }
        return $this->view('frontend.home.index',compact('posts'));
    }
}