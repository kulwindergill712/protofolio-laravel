<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;
// use Mail;

trait Email
{

    public function Gmail($user)
    {
        $name = $user['name'];
        $email = $user['email'];
        $otp = $user['otp'];
        $details = [
            'title' => ' This is Mail From protofolio',
            'body' => 'OTP for RESET PASSWORD:' . $otp,
            'name' => 'Hi  ' . $name,
        ];

        Mail::send('email.verify', $details, function ($message) use ($email) {

            $title = 'Reset Password';

            $message->to($email)->subject($title);
            $message->from('WaguManager@gmail.com', 'WAGU');

        });
    }

    public function sendsms($post_fields)
    {
        $api = 'https://rest.nexmo.com/sms/json';
        $ch = curl_init();
        $post_fields_encoded = json_encode($post_fields, true);
        curl_setopt($ch, CURLOPT_URL, $api);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields_encoded);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json; charset=utf-8",
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        $response1 = json_decode($response, true);
        return $response1;
    }
}
