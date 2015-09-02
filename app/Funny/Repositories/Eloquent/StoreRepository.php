<?php

namespace App\Funny\Repositories\Eloquent;

use App\Funny\Models\Store;
use App\Funny\Repositories\BaseRepository;
use App\Funny\Repositories\StoreRepositoryInterface;

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

    public function getForm(){
        return \App\Funny\Services\Forms\StoreForm;
    }
}