<?php

namespace App\Http\Controllers;

use App\project;
use App\Traits\reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    use reply;
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), $this->rule(''));
        if ($validator->errors()->all()) {return $this->f($validator->errors()->first());}

        $create_space = project::create($request->all());

        if ($create_space) {return $this->s('project created Succssfully', '');}
    }

    public function get()
    {
        $data = project::get();
        return $this->s('Project Fetched successfull', $data);
    }

    public function image_path(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            ], [
                'image.max' => 'Image must be less than 1MB',
            ]);

        if ($validator->errors()->all()) {return $this->f($validator->errors()->first());}

        if ($request->image) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/profile_pic');
            $image->move($destinationPath, $name);
            $imageurl = 'profile_pic/' . $name;
            $data['status_code'] = 1;
            $data['status_text'] = 'success';
            $data['message'] = 'Image Uploaded';
            $data['data']["image_url"] = $imageurl;
            return $data;

        }
    }

    public function rule($id)
    {
        $rule = [

            'projectimage' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|min:2|string|max:100',
            'link' => 'required|min:2|string|max:100',
        ];
        if ($id != '') {
            $rule['title'] = 'required|min:2|string|max:50|unique:spaces,title,' . $id;
        }
        return $rule;

    }
}
