<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 9/26/15
 * Time: 9:44 PM
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

class AuthorizedController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
}