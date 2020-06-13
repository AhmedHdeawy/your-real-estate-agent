<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Post;

class PostsController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $request->flash();

      $inputsArray = [
        'posts.user_id'   => [ '=', request('user') ],
        'posts.group_id'   => [ '=', request('group') ],
        'posts.text'   => [ 'like', request('text') ],
        'posts.status'              => [ '=', request('status') ]
      ];

      $query = Post::with(['user', 'group'])->latest();

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $posts = $searchQuery->paginate(config('rbzgo.perPage'));

      return view('dashboard.posts.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Post $post)
    {
        return view('dashboard.posts.show', compact('post'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'status'    =>  'required|in:0,1'
        ]);

        $post->status = $request->status;
        $post->save();

        return redirect()->route('admin.posts.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the post
     */
    public function destroy(Post $post)
    {
        // Get Image name
        $image = $post->image;

        // Delete Record
        $post->delete();

        // Delete Image
        $this->deleteFile('posts/', $image);


      return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
