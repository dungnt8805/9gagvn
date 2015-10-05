<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     *
     *
     * @return mixed
     */
    public function getFacebook()
    {
        try {
            $oauth = Socialite::driver('facebook')->user();
//
        } catch (\Exception $ex) {
            return Socialite::driver('facebook')->redirect();
        }
        if (is_null($user = User::where('fb_id', '=', $oauth->id)->first()))
            if (!is_null($oauth->email) && is_null($user = User::whereEmail($oauth->email)->first()))
                $user = new User();
        $user->fb_id = $oauth->id;
        $user->activated = true;
        $user->email = !is_null($oauth->email) ? $oauth->email : "$oauth->id@facebook.com";
        $user->name = $oauth->name;
        $user->password = bcrypt('12345678');
        $user->avatar = $oauth->avatar;
        $user->save();
        Auth::login($user);
        return $this->redirectRoute("HomePage");
    }
}
