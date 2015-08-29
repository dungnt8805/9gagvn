<?php

/**
 * @author dungnt13
 * @date 8/18/2015
 */
namespace App\Funny\Repositories\Eloquent;

use App\Funny\Presenters\CategoryPresenter;
use App\Funny\Repositories\BaseRepository, App\Funny\Repositories\CategoryRepositoryInterface;

use App\Funny\Services\Forms\CategoryForm;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function __construct(Category $category)
    {
        $this->model = $category;
    }


    /**
     * Get an array of key-value pairs of all categories
     *
     * @return array
     */
    public function listAll()
    {
        $categories = $this->model->lists('title', 'id');
        return $categories;
    }

    /**
     * Get an array of key-value pair with tree of all categories
     *
     * @param int $id
     * @return mixed
     */
    public function generateTree($id = 0)
    {
        $categories = $this->findAll('id', 'asc');
        $sorted = $this->getPresenter()->sortedTree($categories);
        $tree = $this->getPresenter()->selectBoxTree($sorted, [0 => 'None'], 0, $id);
        return $tree;
    }

    /**
     * Find all categories
     *
     * @param string $orderColumn
     * @param string $oderDir
     * @return mixed
     */
    public function findAll($orderColumn = 'created_at', $oderDir = 'desc')
    {
        $categories = $this->model->orderBy($orderColumn, $oderDir)->get();
        return $categories;
    }

    /**
     * Get the category create/update form service.
     *
     * @return \App\Funny\Services\Forms\CategoryForm
     */
    public function getForm()
    {
        return new CategoryForm;
    }

    /**
     * Get the category presenter
     *
     * @return \App\Funny\Presenters\CategoryPresenter
     */
    public function getPresenter()
    {
        return new CategoryPresenter;
    }

    /**
     * Delete the specified category from the database.
     *
     * @param  mixed $id
     * @return void
     */
    public function _delete($id)
    {
        $model = $this->findById($id);
        if (!is_null($model)) {
            $this->model->where('parent_id', '=', $model->id)->update(['parent_id' => $model->parent_id]);
            $model->delete();
        }
    }
}