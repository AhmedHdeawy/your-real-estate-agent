<?php

namespace App\Http\Controllers\Front;

use App\User;
use Validator;
use App\Models\Post;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    /**
     * Store images.
     *
     * @param  \Illuminate\Http\Response  $request
     * @return void
     */
    public function savePost(Request $request)
    {

        $this->validate($request, [
            'text'  =>  'required|min:2|string',
            'attachedFiles' =>  'nullable|array'
        ]);

        $group = Group::whereUniqueName($request->group_permlink)->first();

        // Load Group Posts
        $post = $group->posts()->create([
            'text'  =>  $request->text,
            'user_id'   =>  Auth::id()
        ]);

        if ($request->attachedFiles) {
            // loop through media, and save them
            foreach ($request->attachedFiles as $file) {

                $post->media()->create([
                    'name'  =>  $file['name'],
                    'type'  =>  $file['type'],
                ]);
            }
        }

        $post = Post::find($post->id);

        return response()->json(['post' => $post]);


    }

    /**
     * Store images.
     *
     * @param  \Illuminate\Http\Response  $request
     * @return void
     */
    public function uploadAttachment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file'  =>  'required|max:50000'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first()], 422);
        }

        if ($request->file('file')->isValid()) {
            //
            $file = $request->file('file');

            $fileName =  $file->getClientOriginalName();

            // $file->storeAs('posts/', $fileName);
            $file->move(public_path("/uploads/posts/"), $fileName);

            // Get file Type
            $type = $this->getFileType($file);

            return response()->json(['name'=>$fileName, 'type'  =>  $type]);
        }


    }

    /**
     * Store images.
     *
     * @param  \Illuminate\Http\Response  $request
     * @return void
     */
    public function deleteAttachment(Request $request)
    {
        // Collect file info
        $fileName = $request->filename;

        // Delete Image
        $this->deleteFile('posts/', $fileName);

        return response()->json(['name' => $fileName]);
    }


    /**
     * Load Posts Ajax.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function posts(Request $request)
    {

        $group = Group::whereUniqueName($request->group_permlink)->first();

        // Load Group Posts
        $posts = $group->posts()->paginate(2);

        return response()->json($posts, 200);
    }


    /**
     * Delete the post.
     *
     * @param  \Illuminate\Http\Response  $request
     * @return void
     */
    public function deletePost(Request $request)
    {

        // Find the Post
        $post = Post::findOrFail($request->id);

        // Get Image name
        $media = $post->media;

        // Delete Record
        $post->delete();

        // Delete the Medi
        foreach ($media as $file) {
            // Delete Image
            $this->deleteFile('posts/', $file);
        }

        return response()->json();
    }

    /**
     * Create New Group.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private function getFileType($file)
    {
        $type = explode('/', $file->getClientMimeType())[0];

        if ($type == 'application') {
            return 'file';
        }

        return $type;
    }


}
