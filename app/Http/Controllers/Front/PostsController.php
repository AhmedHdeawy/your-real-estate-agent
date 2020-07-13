<?php

namespace App\Http\Controllers\Front;

use App\User;
use Validator;
use App\Models\Post;

use App\Models\Group;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

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
     * Show the Post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request)
    {
        // Find the Post
        $post = Post::whereUniqueId($request->post_permlink)->first();

        return view('front.groups.post', compact('post'));
    }

    /**
     * Store new post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function savePost(Request $request)
    {

        $this->validate($request, [
            'groupID'   =>  'nullable|numeric',
            'text'  =>  'required|min:2|string',
            'attachedFiles' =>  'nullable|array'
        ]);

        $group = Group::whereUniqueName($request->groupID)->first();

        // Load Group Posts
        $post = $group->posts()->create([
            'text'  =>  $request->text,
            'user_id'   =>  Auth::id()
        ]);

        // Save Unique Id for the post
        $uniqueID = $this->generatePostUniqueID();
        $post->unique_id = $uniqueID;
        $post->save();

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
     * Update the equest
     * @return void
     */
    public function updatePost(Request $request)
    {

        $this->validate($request, [
            'id'    =>  'required|numeric',
            'text'  =>  'required|min:2|string',
            'attachedFiles' =>  'nullable|array'
        ]);

        // Find the Post
        $post = Post::whereUniqueId($request->id)->firstOrFail();

        // Update Post data
        $post->text = $request->text;
        $post->save();

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
     * Delete the post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function deletePost(Request $request)
    {

        // Find the Post
        $post = Post::whereUniqueId($request->id)->firstOrFail();

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
     * Get Post Comments
     * @return void
     */
    public function fetchComments(Request $request)
    {

        $this->validate($request, [
            'id'    =>  'required|numeric',
        ]);

        // Find the Post
        $post = Post::whereUniqueId($request->id)->firstOrFail();

        $comments = $post->comments()->latest()->paginate(5);

        return response()->json($comments, 200);
    }

    /**
     * Comment on the post
     * @return void
     */
    public function commentPost(Request $request)
    {

        $this->validate($request, [
            'id'    =>  'required|numeric',
            'text'   =>  'required'
        ]);

        // Find the Post
        $post = Post::whereUniqueId($request->id)->firstOrFail();


        $authId = Auth::id();

        // Create New Comment
        $comment = $post->comments()->create(['user_id'   =>  $authId, 'text'  =>  $request->text]);

        $comment = Comment::find($comment->id);
        $commentCount = Post::findOrFail($post->id)->comments->count();

        return response()->json(['comment' => $comment, 'count' =>  $commentCount]);
    }

    /**
     * Like the equest
     * @return void
     */
    public function likePost(Request $request)
    {

        $this->validate($request, [
            'id'    =>  'required|numeric',
        ]);


        // Find the Post
        $post = Post::findOrFail($request->id);


        $authId = Auth::id();
        $likes = $post->likes()->get()->pluck('user_id')->toArray();

        // if this User already Liked the Post, then Unlike the Post
        if (in_array($authId, $likes)) {
            Like::where('post_id', $post->id)->where('user_id', $authId)->first()->delete();
        } else {
            $post->likes()->create(['user_id'   =>  $authId]);
        }

        $post = Post::find($post->id);

        return response()->json(['post' => $post]);
    }



    /**
     * Store images.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function deletePostAttachment(Request $request)
    {
        // Find the Post
        $post = Post::findOrFail($request->post_id);

        // Get Image name
        $post->media()->where('name', $request->filename)->delete();

        // Collect file info
        $fileName = $request->filename;

        // Delete Image
        $this->deleteFile('posts/', $fileName);

        return response()->json(['name' => $fileName]);
    }

    /**
     * Store images.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function deleteMedia(Request $request)
    {
        // Get Image name
        $media = Media::findOrFail($request->mediaId);

        // Collect file info
        $fileName = $media->name;

        // Delete Image from DB
        $media->delete();

        // Delete Image from Storage
        $this->deleteFile('posts/', $fileName);

        return response()->json(['name' => $fileName]);
    }

    /**
     * Store files.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function uploadAttachment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file'  =>  'required|max:50000'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        if ($request->file('file')->isValid()) {
            //
            $file = $request->file('file');

            $fileName =  $file->getClientOriginalName();

            // $file->storeAs('posts/', $fileName);
            $file->move(public_path("/uploads/posts/"), $fileName);

            // Get file Type
            $type = $this->getFileType($file);

            return response()->json(['name' => $fileName, 'type'  =>  $type]);
        }
    }

    /**
     * Delete files.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * Get File type.
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

    /**
     * Generate Unique Name for each Post
     */
    private function generatePostUniqueID()
    {
        $number = mt_rand(1000000000, 9999999999); // better than rand()
        // call the same function if the unique_id exists already
        if (Post::whereUniqueId($number)->exists()) {
            return $this->generatePostUniqueID();
        }
        // otherwise, it's valid and can be used
        return $number;
    }
}
