<?php

namespace App\Http\Controllers;

use App\Funny\Repositories\Eloquent\SettingRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use View;
use Input;
use Auth;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected $user;

    protected $setting;

    protected $settings;

    public function __construct()
    {
        $this->beforeFilter('csrf', ['on' => 'post']);

        if (Auth::check())
            $this->user = Auth::user();
        $this->setting = SettingRepository::getInstance();
        $this->loadSetting();
    }

    /**
     * Redirect to the specified named route.
     *
     * @param  string $route
     * @param  array $params
     * @param  array $data
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectRoute($route, $params = [], $data = [])
    {
        return Redirect::route($route, $params)->with($data);
    }

    /**
     * Redirect back with old input and the specified data.
     *
     * @param  array $data
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBack($data = [])
    {
        return Redirect::back()->withInput()->with($data);
    }

    /**
     * Set the specified view as content on the layout.
     *
     * @param  string $path
     * @param  array $data
     * @return void
     */
    protected function view($path, $data = [])
    {
//        $data['app_settings'] = $this->settings;
        return View::make($path, $data);
    }

    /**
     *  Return input data
     *
     * @return array
     *
     */
    protected function input()
    {
        return Input::all();
    }

    /**
     * Return data with json
     *
     * @param $data
     * @return mixed
     */
    protected function json($data)
    {
        return \Response::json($data);
    }

    protected function loadSetting()
    {
        $this->settings = $this->setting->loadAllSettings();
        View::share('app_settings', $this->settings);
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }
    
    protected function returnTo($url,$data = []){
        return Redirect::to($url)->with($data);
    }


}
