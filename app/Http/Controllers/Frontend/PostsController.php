<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 8/29/2015
 * Time: 11:28 AM
 */

namespace App\Http\Controllers\Frontend;


use App\Funny\Repositories\CategoryRepositoryInterface;
use App\Funny\Repositories\Contracts\PostRepositoryInterface;
use Request;

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
        $this->middleware('auth', ['only' => ['getAdd', 'postAdd']]);
    }


    public function getAdd()
    {
        $type = Request::input('type', '');
        $post = $this->post->getNew();
        return $this->view('gag.frontend.post.add', compact('post', 'type'));
    }

    public function postAdd()
    {
        $form = $this->post->getForm();
        if (!$form->isValid()) {
            return $this->redirectBack()->withInput()->withErrors($form->getErrors());
        } else {
            $this->post->updatePost($form->getInputData(), 0, $this->user->id);
            return $this->redirectRoute('admin.posts.index');
        }
    }

    public function getDetails($code)
    {
        $post = $this->post->getByCode($code);
        $next = $this->post->getNext($post->id);
        $prev = $this->post->getPrev($post->id);
        return $this->view('gag.frontend.post.details', compact('post', 'next', 'prev'));
    }

    /**
     * Request a random post
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function random()
    {
        $random = $this->post->randomPost();
        return $this->redirectRoute('post.details', ['code' => $random->code]);
    }
}