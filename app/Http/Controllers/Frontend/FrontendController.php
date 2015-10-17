<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 8/29/2015
 * Time: 11:29 AM
 */

namespace App\Http\Controllers\Frontend;


use App\Funny\Models\Category;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $categories = null;
        if (\Cache::has(Category::cache_key))
            $categories = \Cache::get(Category::cache_key);
        else {
            $categories = \Cache::rememberForever(Category::cache_key, function () {
                return Category::lists('title', 'slug');
            });
        }
        \View::share('app_categories', $categories);
    }
}