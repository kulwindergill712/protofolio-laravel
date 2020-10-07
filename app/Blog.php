<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'picture',
        'author',

        'description',
    ];

    public function getCommentAttribute()
    {
        return 20;
    }

    public function getLessDesAttribute()
    {
        $des = Blog::where('id', $this->id)->first();

        return substr($des->description, 0, 500);

    }

    public function toArray()
    {
        $array = parent::toArray();
        foreach ($this->getMutatedAttributes() as $key) {
            if (!array_key_exists($key, $array)) {
                $array[$key] = $this->{$key};
            }
        }
        return $array;
    }
}
