<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Traits\reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

    use reply;
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rule(''), $this->custom());
        if ($validator->errors()->all()) {return $this->f($validator->errors()->first());}

        $create_space = Blog::create($request->all());

        if ($create_space) {return $this->s('Blog Created Sucessfully', '');}
    }

    public function get($id = null)
    {
        if ($id != null) {
            $data = Blog::where('id', $id)->get();
            return $this->s('Blogs Fetched successfull', $data);
        }
        $data = Blog::get();
        return $this->s('Blogs Fetched successfull', $data);
    }
    public function custom()
    {
        return [

        ];
    }
    public function delete($id)
    {
        $delete_social = Blog::find($id);
        if (!$delete_social) {return $this->f('Invalid Data');}

        $delete_social->delete();
        return $this->s('Blog Deleted Successfully', " ");

    }

    public function update(Request $request, $id)
    {
        $update_catagory = Blog::find($id);
        if (!$update_catagory) {return $this->f('Invalid Data');}

        $validator = Validator::make($request->all(), $this->rule($id));
        if ($validator->errors()->all()) {return $this->f($validator->errors()->first());}

        if ($update_catagory->update($request->all()));
        {return $this->s('Social Updated Successfully', '');}

    }

    public function rule($id)
    {
        $rule = [
            'title' => 'required|min:2|string',
            'picture' => 'required',
            'author' => 'required|min:2|string|max:100',
            'description' => 'required|min:2|string',

        ];
        if ($id != '') {

        }
        return $rule;

    }
}
