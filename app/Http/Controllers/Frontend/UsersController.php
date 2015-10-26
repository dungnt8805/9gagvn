<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 10/23/15
 * Time: 10:56 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Models\User;

class UsersController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();

    }

    public function topSideBar()
    {
        $users = User::limit(12)->get();
        $tmp = [];

        foreach ($users as $user) {
            $tmp[] = [
                'id' => $user->id,
                'name' => $user->name,
                'avatar' => \Timthumb::link($user->avatar, 35, 35, 1),
                'point' => 100,
                'link' => ''
            ];
        }
        $response = ['status' => '1', 'msg' => 'success', 'data' => $tmp];
        return $this->json($response);
    }

}