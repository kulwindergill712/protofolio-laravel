<?php

namespace App\Http\Controllers;

use App\Traits\reply;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use reply;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rule());
        if ($validator->errors()->all()) {return $this->f($validator->errors()->first());}

        if (!$this->attemptLogin($request)) {return $this->f("Incorrect Email or Password");}

        $data_user = User::where('id', Auth::id())->get(['id', 'name', 'email']);
        return $this->s("Login SuccessFully", $data_user);
    }

    protected function attemptLogin(Request $request)
    {
        //Try with email AND username fields
        if (Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password'],
        ], $request->has('remember'))
            || Auth::attempt([
                'mobile' => $request['email'],
                'password' => $request['password'],
            ], $request->has('remember'))) {
            return true;
        }
        return false;
    }

    public function rule($id = null)
    {
        $rule = [

            'email' => 'required',
            'password' => 'required|min:6',

        ];

        return $rule;
    }
}
