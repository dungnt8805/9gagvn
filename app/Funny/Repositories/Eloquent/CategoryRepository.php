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
     * Get an list multi select of all categories
     *
     * @return string
     */
    public function multiChoice($selected = null)
    {
        $categories = $this->findAll('id', 'asc');
        $sorted = $this->getPresenter()->sortedTree($categories);
        $multi = $this->getPresenter()->multiChoice($sorted, $selected);
        return $multi;
    }

    /**
     * Find all categories
     *
     * @param string $orderColumn
     * @param string $orderDir
     * @return mixed
     */
    public function findAll($orderColumn = 'created_at', $orderDir = 'desc')
    {
        $categories = $this->model->orderBy($orderColumn, $orderDir)->get();
        return $categories;
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


}