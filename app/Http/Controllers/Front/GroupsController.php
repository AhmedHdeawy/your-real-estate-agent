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

        broadcast(new RequestJoin($group->user_id, $group));

        return response()->json(true, 200);
    }

    /**
     * Get User Group Requests Join.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function groupsJoinRequests(Request $request)
    {
        $groupsRequest = auth()->user()->myGroups()->with('requests')->get();

        return view('front.groups.requests', compact('groupsRequest'));
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
