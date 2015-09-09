<?php

namespace App\Funny\Repositories;

interface StoreRepositoryInterface
{

    /**
     * Find all store
     *
     * @param string $orderColumn
     * @param string $orderDir
     * @return mixed
     */
    public function findAll($orderColumn = 'created_at', $orderDir = 'desc');

    /**
     * Get an array of key-value pairs of all stores
     *
     * @return array
     */
    public function listAll();
}

?>