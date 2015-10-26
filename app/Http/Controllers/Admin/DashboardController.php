<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 10/1/15
 * Time: 11:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Funny\Models\Setting;
use App\Funny\Models\Post;
use App\Funny\Models\Category;
use App\Models\User;
use App\Funny\Models\Comment;

class DashboardController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $users = User::count();
        $posts = Post::count();
        $categories = Category::count();
        $comments = Comment::count();
        return $this->view('gag/admin/dashboard/index', ['users' => $users, 'posts' => $posts, 'categories' => $categories, 'comments' => $comments]);

    }

    public function custom_code()
    {
        $custom_css = $this->setting->load('custom_css')->value;

        $custom_js = $this->setting->load('custom_js')->value;

        return $this->view('gag/admin/dashboard/settings/custom_code', ['custom_css' => $custom_css, 'custom_js' => $custom_js]);
    }

    public function settings()
    {
        $settings = $this->setting->loadAllSettingsByType(Setting::GENERAL_TYPE);
        return $this->view('gag/admin/dashboard/settings/index', ['settings' => $settings]);
    }

    public function update_settings()
    {
        $input = $this->input();

        $this->setting->updateGeneralSettings($input);

        return $this->returnTo('/admin/#/settings');
    }

    public function updateCustomCss()
    {
        $input = $this->input();
        $css = $input['css'];
        $custom_css = $this->setting->updateCustomCss($css);
        return $custom_css;
    }
    public function updateCustomJs()
    {
        $input = $this->input();
        $css = $input['js'];
        $custom_css = $this->setting->updateCustomJavascript($css);
        return $custom_css;
    }


}