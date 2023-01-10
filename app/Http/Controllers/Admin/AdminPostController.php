<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class AdminPostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->paginate(5);
//        $posts = auth()->user()->posts()->paginate(5);
        return view('admin.posts.index-post',['posts'=>$posts]);
    }
    public function create()
    {
        $this->authorize('create',Post::class);

        return view('admin.posts.create-post');
    }

    public function store()
    {
        $this->authorize('create',Post::class);

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
        $this->authorize('update',$postsAdmin);

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

        $this->authorize('update',$postsAdmin);

        auth()->user()->posts()->save($postsAdmin);

        Session::flash('post-updated','Post with title: "' .$data['title']. '" has been updated');

        return redirect()->route('postsAdmin.index');

    }
    public function destroy(Post $postsAdmin)
    {
        $this->authorize('delete',$postsAdmin);

        $postsAdmin->delete();

        Session::flash('post-deleted','Post with title: "' .$postsAdmin->title. '" has been deleted');
        return redirect()->back();
    }
}
