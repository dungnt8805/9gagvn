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

    /**
     * Show admin store index page
     */
    public function getIndex()
    {
        $store = $this->store->getNew();
        $stores = $this->store->findAll();
        return $this->view('admin.stores.index', compact('store', 'stores'));
    }

    /**
     * Handle the creation of the store
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postIndex()
    {
        $form = $this->store->getForm();
        if (!$form->isValid()) {
            return $this->redirectBack()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getInputData();
        if (isset($data['is_avatar'])) {
            $data['thumbnail'] = $data['is_avatar'];
            unset($data['is_avatar']);
        }
        $store = $this->store->create($data);
        return $this->redirectRoute('admin.stores.index');
    }
}