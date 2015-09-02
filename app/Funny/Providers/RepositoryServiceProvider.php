<?php
/**
 * @author dungnt13
 * @date 8/25/2015
 */

namespace app\Funny\Providers;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Funny\Repositories\CategoryRepositoryInterface',
            'App\Funny\Repositories\Eloquent\CategoryRepository'
        );
        $this->app->bind(
            'App\Funny\Repositories\PostRepositoryInterface',
            'App\Funny\Repositories\Eloquent\PostRepository'
        );
        $this->app->bind(
            'App\Funny\Repositories\StoreRepositoryInterface',
            'App\Funny\Repositories\Eloquent\StoreRepository'
        );
    }
}