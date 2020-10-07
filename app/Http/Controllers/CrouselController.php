<?php

namespace App\Http\Controllers;

use App\Crousel;
use App\Traits\reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrouselController extends Controller
{
    use reply;

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), $this->rule(''));
        if ($validator->errors()->all()) {return $this->f($validator->errors()->first());}

        $create_space = Crousel::create($request->all());

        if ($create_space) {return $this->s('Crousel created Succssfully', '');}
    }

    public function get()
    {
        $data = Crousel::get();
        return $this->s('Crousel Fetched successfull', $data);
    }

    public function rule($id)
    {
        $rule = [

            'image_url' => 'required|string',
            'heading' => 'required|string',
            'description' => 'required|min:2|string|max:100',

        ];
        if ($id != '') {

        }
        return $rule;

    } //
}
