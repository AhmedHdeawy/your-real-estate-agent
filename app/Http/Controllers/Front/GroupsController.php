<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Group;
use App\Models\GroupMember;
use App\Models\GroupQuestion;
use App\Models\GroupRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class GroupsController extends Controller
{

    /**
     * Show User groups.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $groups = Auth::user()->inGroups()->withCount('users')->get();

        return view('front.groups.index', compact('groups'));
    }

    /**
     * Show User groups.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search()
    {
        $groups = Auth::user()->inGroups()->withCount('users')->get();

        return view('front.groups.index', compact('groups'));
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request)
    {

        $group = Group::whereUniqueName($request->group_permlink)
            ->with(['requests', 'members'])
            ->first();

        // Load Group Posts
        $posts = $group->posts()->latest()->paginate(2);

        return view('front.groups.show', compact('group', 'posts'));
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
        $posts = $group->posts()->latest()->paginate(2);

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
            'questions'  =>  'required|array|min:1|max:10',
        ]);

        $request['user_id'] = Auth::id();

        // Save Group in DB
        $group = Group::create($request->all());

        // Save Unique Name for the group
        $uniqueName = $this->generateGroupUniqueNumber();
        $group->unique_name = $uniqueName;
        $group->save();

        // Create the Owner of the group
        $group->users()->attach(Auth::id(), ['role' => 'owner']);

        // Insert the group questions
        foreach ($request->questions as $question) {
            $group->questions()->create(['title'  =>  $question]);
        }

        return redirect()->route('groups.show', ['name' => $group->unique_name]);
    }


    /**
     * Show User groups.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function leave(Request $request)
    {
        // Get the group
        $group = Group::whereUniqueName($request->group_permlink)->first();

        // Get membership and delete it
        GroupMember::where('group_id', $group->id)->where('user_id', Auth::id())->delete();

        return redirect()->route('groups.index');
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
