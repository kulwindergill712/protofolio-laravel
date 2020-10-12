<?php

namespace App\Http\Controllers;

use App\Traits\reply;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SocialController extends Controller
{
    use reply;
    public function googlelogin(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rule(''));
        if ($validator->errors()->all()) {return $this->f($validator->errors()->first());}

        $token = $request->access;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/oauth2/v1/userinfo?access_token=" . $token);
        // SSL important
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $user = json_decode($output, true);

        $existingUser = User::where('email', $user['email'])->first();
        if (!$existingUser) {

            $newUser = new User;
            $newUser->provider_name = 'google';
            $newUser->provider_id = $user['id'];
            $newUser->name = $user['name'];
            $newUser->email = $user['email'];
            $newUser->email_verified_at = now();
            $newUser->password = Hash::make('secret');
            $newUser->save();

            $userinfo = User::where('email', $user['email'])->first();
            return $this->s("user created success", $userinfo);
        }
        $userinfo = User::where('email', $user['email'])->first();
        return $this->s('user is already registered', $userinfo);
    }

    public function rule($id)
    {
        $rule = [
            'access' => 'required',

        ];
        if ($id != '') {

        }
        return $rule;

    }
}
