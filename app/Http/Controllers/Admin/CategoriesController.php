<?php
/**
 * @author dungnt13
 * @date 8/18/2015
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Funny\Repositories\CategoryRepositoryInterface;
use View;

class CategoriesController extends Controller
{
    /**
     * category repository
     *
     * @var \App\Funny\Repositories\CategoryRepositoryInterface
     */
    protected $category;

    /**
     * Create a new CategoriesController instance.
     *
     * @param CategoryRepositoryInterface $category
     *
     */
    public function __construct(CategoryRepositoryInterface $category)
    {
//        parent::__construct();
        $this->category = $category;
    }

    /**
     * Show admin categories index page
     *
     * @return \Response
     */
    public function getIndex()
    {
        $category = $this->category->getNew();
        $categories = $this->category->findAll('created_at', 'asc');
        $sorted = $this->category->getPresenter()->sortedTree($categories);

        $tree = $this->category->getPresenter()->selectBoxTree($sorted, [0 => 'None'], 0, 0);

        $list = $this->category->getPresenter()->getListTree($sorted, 0, []);

        return View::make('admin.categories.list', compact('category', 'tree', 'list'));
    }

    /**
     * Handle the creation of a category.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postIndex()
    {
        $form = $this->category->getForm();
        if (!$form->isValid()) {
            return $this->redirectBack()->withErrors($form->getErrors())->withInput();
        }
        $category = $this->category->create($form->getInputData());
        return $this->redirectRoute('admin.categories.index');
    }

    /**
     * Show the category edit form
     *
     * @param $id
     * return \Response
     */
    public function getView($id)
    {
        $category = $this->category->findById($id);
        $categories = $this->category->findAll('created_at', 'asc');
        $sorted = $this->category->getPresenter()->sortedTree($categories);

        $tree = $this->category->getPresenter()->selectBoxTree($sorted, [0 => 'None'], 0, $id);
        return $this->view('admin.categories.edit', compact('category', 'tree'));
    }

    /**
     * Handle the editting of a category
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postView($id)
    {
        $form = $this->category->getForm();
        if (!$form->isValid()) {
            return $this->redirectBack()->withErrors($form->getMessages())->withInput();
        }
        $category = $this->category->update($form->getInputData());
        return $this->redirectRoute('admin.categories.view', $id);
    }

    /**
     * @return mixed
     */
    public function postDelete(){
        return $this->json([]);
    }
}