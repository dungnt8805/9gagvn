<?php

namespace App\Http\Controllers\Admin;

use App\Funny\Repositories\StoreRepositoryInterface;

class StoresController extends AdminController
{
    /**
     * store repository
     *
     * @var \App\Funny\Repositories\Eloquent\StoreRepository
     */
    protected $store;

    /**
     * Create a new CategoriesController instance.
     *
     * @param StoreRepositoryInterface $store
     *
     */
    public function __construct(StoreRepositoryInterface $store)
    {
        parent::__construct();
        $this->store = $store;
    }

    public function getIndex()
    {
        $store = $this->store->getNew();
        $stores = [];
        return $this->view('admin.stores.index', compact('store'));
    }

    public function postIndex()
    {

    }
}