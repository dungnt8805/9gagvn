<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 10/23/15
 * Time: 3:29 PM
 */

namespace App\Http\Controllers\Admin;


class UsersController extends AdminController
{
    private $user;

    public function __construct()
    {
        parent::__construct();

    }
}