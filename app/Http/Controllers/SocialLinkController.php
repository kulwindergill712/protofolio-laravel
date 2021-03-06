<?php

namespace App\Http\Controllers;

use App\SocialLink;
use App\Traits\reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialLinkController extends Controller
{

    use reply;
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rule(''), $this->custom());
        if ($validator->errors()->all()) {return $this->f($validator->errors()->first());}

        $create_space = SocialLink::create($request->all());

        if ($create_space) {return $this->s('Social Link Created', '');}
    }

    public function get()
    {
        $data = SocialLink::get();
        return $this->s('Social links Fetched successfull', $data);
    }
    public function custom()
    {
        return [

        ];
    }
    public function delete($id)
    {
        $delete_social = SocialLink::find($id);
        if (!$delete_social) {return $this->f('Invalid Data');}

        $delete_social->delete();
        return $this->s('Social link delete', " ");

    }

    public function update(Request $request, $id)
    {
        $update_catagory = SocialLink::find($id);
        if (!$update_catagory) {return $this->f('Invalid Data');}

        $validator = Validator::make($request->all(), $this->rule($id));
        if ($validator->errors()->all()) {return $this->f($validator->errors()->first());}

        if ($update_catagory->update($request->all()));
        {return $this->s('Social Updated Successfully', '');}

    }

    public function rule($id)
    {
        $rule = [
            'name' => 'required|min:2|string',
            'image' => 'required',
            'user_name' => 'required|min:2|string|max:100',
            'link' => 'required|min:2|string|max:100',
        ];
        if ($id != '') {

        }
        return $rule;

    }
}
