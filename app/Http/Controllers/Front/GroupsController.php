<?php

namespace App\Http\Controllers\Front;

use App\Events\RequestJoin;
use App\User;
use Validator;
use Faker\Generator;

use App\Models\Group;
use App\Models\State;
use App\Models\Country;
use App\Models\GroupMember;
use App\Models\GroupRequest;
use Illuminate\Http\Request;
use App\Models\GroupQuestion;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class GroupsController extends Controller
{

    /**
     * Show User groups.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $groups = Auth::user()->inGroups()->withCount('users', 'posts')->get();

        return view('front.groups.index', compact('groups'));
    }

    /**
     * Show User groups.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search()
    {
        $countries = Country::active()->get();

        return view('front.groups.search', compact('countries'));
    }


    /**
     * Get the result for search.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function searchResults(Request $request)
    {
        $query = Group::latest();

        if ($request->lat && $request->lng) {
            $latitude = $request->lat;
            $longitude = $request->lng;

            $query = $query->select(
                DB::raw('
                *, ( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( lat ) ) ) ) AS distance
                ')
            )->having('distance', '<', 50)
                ->orderBy('distance');
        }

        if ($request->text) {

            $query = $query->where('name', 'like', '%' . $request->text . '%')
                ->orWhere('address', 'like', '%' . $request->text . '%')
                ->orWhere('city', 'like', '%' . $request->text . '%')
                ->orWhere('country_id', 'like', '%' . $request->text . '%')
                ->orWhere('state_id', 'like', '%' . $request->text . '%');
        }

        // $groups = $groupsByLatLng->merge($groupsByText);
        $groups = $query->with('questions')
            ->withCount('users')
            ->availableForUser()
            ->get();

        return response()->json($groups, 200);
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
        $posts = $group->posts()->latest()->paginate(config('rbzgo')['groupPostsPerPage']);

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
        $posts = $group->posts()->latest()->paginate(config('rbzgo')['groupPostsPerPage']);

        return response()->json($posts, 200);
    }


    /**
     * Create New Group.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {

        $countries = Country::active()->get();

        return view('front.groups.create', compact('countries'));
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
            'location'  =>  'required',
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
            if ($question) {
                $group->questions()->create(['title'  =>  $question]);
            }
        }

        return redirect()->route('groups.show', ['name' => $group->unique_name]);
    }


    /**
     * Requets Join to the group.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function requestJoin(Request $request)
    {
        // Get the group
        $group = Group::find($request->groupId);

        $groupRequest = $group->requests()->create([
            'user_id'   =>  Auth::id()
        ]);

        $answers = $request->answers;

        foreach ($answers as $answer) {
            if ($answer['answer']) {
                $groupRequest->userAnswers()->create([
                    'title' =>  $answer['title'],
                    'answer' =>  $answer['answer'],
                ]);
            }
        }

        // Fire Event
        broadcast(new RequestJoin($group->user_id));

        return response()->json(true, 200);
    }

    /**
     * Get User Group Requests Join.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function groupsJoinRequests(Request $request)
    {
        $groupsRequest = GroupRequest::whereIn('group_id', auth()->user()->myGroups->pluck('id'))->with(['user:id,name,avatar', 'group:id,name,image', 'userAnswers'])->get();

        return view('front.groups.requests', compact('groupsRequest'));
    }


    /**
     * Handle Request Join Accept or Denied.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function handelJoinRequests(Request $request)
    {

        if ($request->status == 'accept') {

            // Get the group, user and group members
            $group = Group::find($request->group_id);
            $user = User::find($request->user_id);
            $groupUsers = $group->users->pluck('id')->toArray();

            // Add this user to group members
            $group->users()->attach($request->user_id, ['role' => 'member']);

            // Add Group Members to this User Friends
            $recentFriends = $user->friends()->pluck('id')->toArray();

            // Filter Friends to ignore exist friend
            $newFriends = array_filter($groupUsers, function ($arr) use ($recentFriends) {
                return !in_array($arr, $recentFriends);
            });

            // attach new friends to this user
            $user->firendsOfMine()->attach($newFriends);

            // Finally,  Remove Request
            GroupRequest::where('group_id', $request->group_id)->where('user_id', $request->user_id)->first()->delete();

            return back()->with('msg_success', __('lang.acceptedSuccessfully'));
        } else {

            GroupRequest::where('group_id', $request->group_id)->where('user_id', $request->user_id)->first()->delete();

            return back()->with('msg_danger', __('lang.deniedSuccessfully'));
        }
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

        // if this user owner the group
        if ($group->user_id == Auth::id()) {
            return back()->with('msg_danger', __('lang.youCannotLeaveYourGroup'));
        }

        // First Delete User membership
        GroupMember::where('group_id', $group->id)->where('user_id', Auth::id())->delete();

        // Then, Remove this group firends from the user friends

        // Get Groups that the User exist in it except this Group
        $groupsUserExceptThisGroup = auth()->user()->inGroups()->where('groups.id', '!=', $group->id)->with('users')->get();

        // Get All Users in these groups
        $allMembersInUserGroups = [];
        foreach ($groupsUserExceptThisGroup as $groupUsers) {
            $allMembersInUserGroups = array_merge($allMembersInUserGroups, $groupUsers->users->pluck('id')->toArray());
        }
        // Ignore Duplicated Users
        $allMembersInUserGroups = array_unique($allMembersInUserGroups);

        // Get User Friends
        $leavingGroupUsers = $group->users->pluck('id')->toArray();

        // Filter User Friends, to delete this (leave request ) group users that isn't exist in another user group
        $wellDeleted = array_filter($leavingGroupUsers, function ($arr) use ($allMembersInUserGroups) {
            return !in_array($arr, $allMembersInUserGroups);
        });

        // Delete Group Members from User Friends
        auth()->user()->firendsOfMine()->detach($wellDeleted);

        return redirect()->route('groups.index');
    }

    /**
     * Create New Group.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function fetchStatesByCountry(Request $request, $countryId)
    {
        $states = State::where('country_id', $countryId)->active()->get();

        return response()->json($states);
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
