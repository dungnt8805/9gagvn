<?php
/**
 * @author dungnt13
 * @date 8/18/2015
 */

namespace App\Funny\Repositories;


interface CategoryRepositoryInterface
{

    /**
     * Get an array of key-value pairs of all categories
     *
     * @return array
     */
    public function listAll();

    /**
     * Get an array of key-value pair with tree of all categories
     *
     * @param int $id
     * @return mixed
     */
    public function generateTree($id = 0);

    /**
     * Find all categories
     *
     * @param string $orderColumn
     * @param string $orderDir
     * @return mixed
     */
    public function findAll($orderColumn = 'created_at',$orderDir = 'desc');

    /**
     * Delete the specified category from the database.
     *
     * @param  mixed $id
     * @return void
     */
    public function _delete($id);
}