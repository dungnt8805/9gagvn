<?php
/**
 * @author dungnt13
 * @date 8/18/2015
 */

namespace App\Funny\Repositories;


abstract class BaseRepository
{

    /**
     * The model instance
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Get a new instance of the model
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getNew(array $attributes = array())
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * Get Model by id.
     *
     * @param int $id
     * @return \App\Models\Model
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Destroy a model
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->findById($id)->delete();
    }

    /**
     * Restore a model
     *
     * @param int $id
     */
    public function restored($id)
    {
        $object = $this->model->withTrashed()->find($id);
        $object->restore();
    }

    /**
     * Save model to database
     *
     * @param $array
     * @return static
     */
    public function create($array)
    {
        $model = $this->getNew();
        foreach ($array as $key => $value) {
            if ($key != 'id') {
                $model->{$key} = $value;
            }
        }
        $model->save();
        return $model;
    }

    /**
     * update model to database
     *
     * @param $array
     * @param int $id
     * @return \App\Models\Model
     */
    public function update($array, $id = 0)
    {
        $id = $id != 0 ? $id : $array['id'];
        $model = $this->findById($id);
        foreach ($array as $key => $value) {
            if ($key != 'id' && $key != '_token') {
                $model->{$key} = $value;
            }
        }
        $model->save();
        return $model;
    }

    public function findAll($orderColumn = 'create_at', $orderDir = 'desc')
    {
        return $this->model->orderBy($orderColumn, $orderDir)->get();
    }

}