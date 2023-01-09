<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index-post',['posts'=>$posts]);
    }
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

        Session::flash('post-created','Post with title: "' .$data['title']. '" has been created');
        return redirect()->route('postsAdmin.index');
    }

    public function edit(Post $postsAdmin)
    {
        return view('admin.posts.edit-post',['postsAdmin'=>$postsAdmin]);
    }

    public function update(Post $postsAdmin)
    {
        $data = \request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required',
        ]);

        $postsAdmin->title = $data['title'];
        $postsAdmin->body = $data['body'];

        if (\request('post_image')) {
            $data['post_image'] = \request('post_image')->store('images');
            $postsAdmin->post_image = $data['post_image'];
        }

        auth()->user()->posts()->save($postsAdmin);

        Session::flash('post-updated','Post with title: "' .$data['title']. '" has been updated');

        return redirect()->route('postsAdmin.index');

    }
    public function destroy(Post $postsAdmin)
    {
        $postsAdmin->delete();

        Session::flash('post-deleted','Post with title: "' .$postsAdmin->title. '" has been deleted');
        return redirect()->back();
    }
}
