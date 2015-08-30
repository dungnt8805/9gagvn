<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 8/29/2015
 * Time: 8:59 PM
 */

namespace App\Http\Controllers\Frontend;


class HomeController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the homepage
     * @return \View
     */
    public function getIndex(){
        return $this->view('frontend.home.index');
    }
}