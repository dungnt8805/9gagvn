<?php

namespace App\Funny\Repositories\Eloquent;

use App\Funny\Models\Store;
use App\Funny\Repositories\BaseRepository;
use App\Funny\Repositories\StoreRepositoryInterface;
use \App\Funny\Services\Forms\StoreForm;

class StoreRepository extends BaseRepository implements StoreRepositoryInterface
{
    /**
     * Create a new DBStoreRepository instance
     *
     * @param Store $store
     */
    public function __construct(Store $store)
    {
        $this->model = $store;
    }

    public function getForm()
    {
        return new StoreForm;
    }

    /**
     * Find all store
     *
     * @param string $orderColumn
     * @param string $orderDir
     * @return mixed
     */
    public function findAll($orderColumn = 'created_at', $orderDir = 'desc')
    {
        $stores = $this->model->orderBy($orderColumn, $orderDir)->get();
        return $stores;
    }

    /**
     * Get an array of key-value pairs of all stores
     *
     * @return array
     */
    public function listAll()
    {
        return $this->model->lists('title', 'id');
    }
}