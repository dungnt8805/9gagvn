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
        $this->middleware('auth', ['except' => ['getDetails']]);
    }


    public function getAdd()
    {
        $type = Request::input('type', '');
        $post = $this->post->getNew();
        return $this->view('frontend.posts.add', compact('post', 'type'));
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
        // $post = $this->post->getByCode($code);
        $post = $this->post->getByCode($code);
        return $this->view("frontend.posts.details", compact('post'));
    }
}