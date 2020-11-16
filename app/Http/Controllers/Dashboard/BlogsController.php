<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Cache;
use App\Http\Requests\BlogRequest;


class BlogsController extends Controller
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
        'blog_translations.title'   => [ 'like', request('title') ],
        'blogs.status'              => [ '=', request('status') ]
      ];

      $query = Blog::join('blog_translations', 'blogs.id', 'blog_translations.blog_id')
                        ->groupBy('blogs.id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $blogs = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.blogs.index', compact('blogs'));
    }


    /**
     * Goto the form for creating a new blog.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.blogs.create');
    }


    /**
     * Store a newly created blog.
     *
     * @param  \App\Modules\Admin\Http\Requests\BlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $blog = Blog::create($request->all());

        Cache::forget('properties_blogs');

        return redirect()->route('admin.blogs.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Blog $blog)
    {
        $showLang = $request->showLang;
        return view('dashboard.blogs.show', compact('blog', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('dashboard.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, Blog $blog)
    {

        $blog->update($request->all());

        Cache::forget('properties_blogs');

        return redirect()->route('admin.blogs.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the blog
     */
    public function destroy(Blog $blog)
    {
        // Delete Record
        $blog->delete();

        Cache::forget('properties_blogs');

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
