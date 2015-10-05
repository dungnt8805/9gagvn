<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 10/1/15
 * Time: 11:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Funny\Models\Setting;

class DashboardController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->view('admin/dashboard/index');
    }

    public function custom_code()
    {
        $custom_css = $this->setting->load('custom_css')->value;

        $custom_js = $this->setting->load('custom_js')->value;

        return $this->view('admin/dashboard/settings/custom_code', ['custom_css' => $custom_css, 'custom_js' => $custom_js]);
    }

    public function settings()
    {
        $settings = $this->setting->loadAllSettingsByType(Setting::GENERAL_TYPE);
        return $this->view('admin/dashboard/settings/index', ['settings' => $settings]);
    }
}