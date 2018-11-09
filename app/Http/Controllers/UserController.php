<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signup(Request $request) {

        Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required|numeric',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4|confirmed'
        ])->validate();


        $user = new User([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'password' => bcrypt($request->get('password'))
        ]);

        $credentials = $request->only('email', 'password');
        $user->save();
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            echo 'ok';
        }

        
    }
    public function signin(Request $request) {
        Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required|min:4'
        ])->validate();
        $userdata = array(
            'email'     => $request->get('email'),
            'password'  => $request->get('password')
        );
        // echo $credentials;
        if(Auth::attempt($userdata)) {
            echo 'ok';
        }
    }

    public function getSignin() {

        return view('auth.login');
    }

    public function getLogout() {
        Auth::logout();
        return redirect()->route('homepage');
    }
}
