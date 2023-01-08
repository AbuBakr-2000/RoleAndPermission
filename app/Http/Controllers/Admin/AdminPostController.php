<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function create()
    {
        return view('admin.posts.create-post');
    }

    public function store()
    {
        $data = \request()->validate([
            'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            'body'=>'required',
        ]);

        if (\request('post_image'))
        {
            $data['post_image'] = \request('post_image')->store('images');
        }

        auth()->user()->posts()->create($data);
        return back();
    }
}
