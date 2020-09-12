<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Traits\reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    use reply;
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rule(''), $this->custom());
        if ($validator->errors()->all()) {return $this->f($validator->errors()->first());}

        $create_space = Contact::create($request->all());

        if ($create_space) {return $this->s('Message sent Successfully', '');}
    }
    public function custom()
    {
        return [

        ];
    }

    public function rule($id)
    {
        $rule = [
            'name' => 'required|min:2|string',
            'email' => 'required|min:2|email',
            'message' => 'required|min:2|string|max:100',
        ];
        if ($id != '') {
            $rule['title'] = 'required|min:2|string|max:50|unique:spaces,title,' . $id;
        }
        return $rule;

    }
}
