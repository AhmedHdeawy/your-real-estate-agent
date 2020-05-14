<?php

namespace App\Http\Controllers\Front;

use App\User;
use Validator;
use App\Models\Group;

use App\Models\GroupMember;
use App\Models\GroupRequest;
use Illuminate\Http\Request;
use App\Models\GroupQuestion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

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


            return response()->json(['name'=>$fileName]);
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

        $group = Group::whereUniqueName($request->name)->first();

        // Load Group Posts
        $posts = $group->posts()->paginate(2);

        return response()->json($posts, 200);
    }


    /**
     * Create New Group.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('front.groups.create');
    }


    /**
     * Save New Group.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  =>  'required|max:255|min:5|string',
            'description'  =>  'required|min:5|string',
            'questions'  =>  'required|array|min:2|max:10',
        ]);

        $request['user_id'] = Auth::id();

        // Save Group in DB
        $group = Group::create($request->all());

        // Save Unique Name for the group
        $uniqueName = $this->generateGroupUniqueNumber();
        $group->unique_name = $uniqueName;
        $group->save();

        // Create the Owner of the group
        $group->members()->attach(Auth::id(), ['role' => 'owner']);

        // Insert the group questions
        foreach ($request->questions as $question) {
            $group->questions()->create(['title'  =>  $question]);
        }

        return redirect()->route('groups.show', ['name' => $group->unique_name ]);

    }


    /**
     * Show the ContactUs page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contactus()
    {
        return view('front.contactus');
    }


    /**
     * Post the ContactUs Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postContactUs(Request $request)
    {
        // Validate Form
        $this->validateContactUs($request);

        // Create New Row
        ContactUs::create($request->all());

        return redirect()->route('contactus')->with('status', __('lang.contactUsDone'));

    }


    /**
     * Validate Form Request.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateContactUs(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|max:100',
            'message' => 'required|string',
        ])->validate();
    }


    /**
     * Show the Profile page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile(Request $request, $username)
    {
        return view('front.profile');
    }


    /**
     * Post the Profile Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        // Validate Form
        $this->validateProfile($request);

        $user = User::findOrFail(auth()->user()->id);

        // Update User Profile
        $user->update($request->all());

        return redirect()->route('profile', auth()->user()->username)->with('status', __('lang.updatedSuccessfully'));

    }


    /**
     * Validate Form Request.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateProfile(Request $request)
    {
        Validator::make($request->all(), [
            'name'      => 'required|string|max:100|min:2',
            'email'     => 'required|max:100|min:2|email|unique:users,email,'. auth()->user()->id .',id',
            'phone'     => 'required|max:100|min:2',
            'password'  => 'confirmed',
            'avatar'    => 'nullable',

        ])->validate();
    }

    /**
     * Generate Unique Name for each Group
     */
    private function generateGroupUniqueNumber()
    {
        $number = mt_rand(1000000000, 9999999999); // better than rand()
        // call the same function if the barcode exists already
        if ($this->checkGroupUniqueNumberExists($number)) {
            return $this->generateGroupUniqueNumber();
        }
        // otherwise, it's valid and can be used
        return $number;
    }

    /**
     * Check if tis unique name is exist in groups or not
     * @param int $number
     */
    private function checkGroupUniqueNumberExists($number)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Group::whereUniqueName($number)->exists();
    }

}
