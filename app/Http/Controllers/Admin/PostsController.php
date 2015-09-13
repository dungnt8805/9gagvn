<?php
/**
 * @author dungnt13
 * @date 8/28/2015
 */

namespace App\Http\Controllers\Admin;


use App\Funny\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

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
     * @param \App\Funny\Repositories\Contracts\PostRepositoryInterface $post
     */
    public function __construct(PostRepositoryInterface $post)
    {
        parent::__construct();
        $this->post = $post;
    }

    /**
     * Display listing of posts
     *
     * @return Response
     */
    public function getIndex()
    {
        $n = Input::get('n', 1);
        $q = Input::get('q', null);
        $category = Input::get('category', null);
        $posts = $this->post->index($n, $q, $category);
        $categories = $this->post->getCategoryRepo()->findAll('created_at', 'asc');
        $sorted = $this->post->getCategoryRepo()->getPresenter()->sortedTree($categories);

        $tree = $sorted = $this->post->getCategoryRepo()->getPresenter()->selectBoxTree($sorted, [0 => 'None'], 0, 0);
        return $this->view('admin.posts.index', compact('posts', 'n', 'tree'));

    }

    /**
     * Display form for creating new post
     *
     * @return Response
     */
    public function getAdd()
    {
        $post = $this->post->getNew();
        $multi = $this->post->getCategoryRepo()->multiChoice(null);
        return $this->view('admin.posts.add', compact('post', 'multi'));
    }

    /**
     * Process create new post
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postAdd()
    {
        $form = $this->post->getForm();
        if (!$form->isValid()) {
            return $this->redirectBack()->withInput()->withErrors($form->getErrors());
        } else {
            $this->post->updatePost($form->getInputData(), 0, 1);
            return $this->redirectRoute('admin.posts.index');
        }
    }

    /**
     * Display form for editting a post
     *
     * @param $id
     *
     * @return Response
     */
    public function getEdit($id)
    {
        $post = $this->post->edit($id);
        $tags = [];
        foreach ($post->tags as $tag) {
            array_push($tags, $tag->tag);
        }

        $selectedCategories = [];
        foreach ($post->categories as $category) {
            array_push($selectedCategories, $category->id);
        }
        $multi = $this->post->getCategoryRepo()->multiChoice($selectedCategories);
        return $this->view('admin.posts.edit', compact('post', 'multi', 'selectedCategories', 'tags'));
    }

    /**
     * Process update a post
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postEdit($id)
    {
        $form = $this->post->getForm();
        if (!$form->isValid()) {
            return $this->redirectBack()->withInput()->withErrors($form->getErrors());
        } else {
            $this->post->updatePost($form->getInputData(), $id, null);
            return $this->redirectRoute('admin.posts.index');
        }
    }
}