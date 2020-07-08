<?php

namespace App\Http\Controllers\Front;

use Validator;
use Image;
use Johntaa\Arabic\I18N_Arabic;

use App\Models\Group;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Story;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (auth()->check()) {
            return $this->homeForAuthedUser($request);
        }

        return $this->homeForNonAuthedUser();
    }

    /**
     * Show the application home for authed User
     *
     * * @return \Illuminate\Contracts\Support\Renderable
     */
    private function homeForAuthedUser(Request $request)
    {
        $posts = $this->homePosts($request);

        $userFreindsIDs = auth()->user()->friends()->pluck('id')->toArray();
        $userFreindsIDs[] = auth()->id();

        $stories = Story::with('items', 'user')
            ->whereHas('items')
            ->whereIn('user_id', $userFreindsIDs)
            ->where('created_at', '>=', now()->subHours(24))
            ->get();

        return view('front.timeline', compact('posts', 'stories'));
    }

    /**
     * Show the application home for Non authed User
     *
     * * @return \Illuminate\Contracts\Support\Renderable
     */
    private function homeForNonAuthedUser()
    {
        return view('front.home');
    }

    /**
     * Get Posts from groups that this user belong to it
     * @param \Illuminate\Http\Request $request
     *
     * @return Collection
     */
    public function homePosts(Request $request)
    {
        $userGroupsIDs = Auth::user()->inGroups->pluck('id')->toArray();

        $posts = Post::whereIn('group_id', $userGroupsIDs)->latest()->paginate(config('rbzgo')['homePostsPerPage']);

        return $posts;
    }

    /**
     * Fetch Nearest Groups for the visitor in 100km
     * @param \Illuminate\Http\Request $request
     *
     * @return Collection
     */
    public function fetchNearestGroups(Request $request)
    {
        $latitude = $request->lat;
        $longitude = $request->lng;

        $nearestGroups = [];
        if ($latitude && $longitude) {
            $nearestGroups = Group::select(
                DB::raw('
                    *, ( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( lat ) ) ) ) AS distance
                    ')
            )->having('distance', '<', 50)
                ->orderBy('distance')
                ->limit(8)
                ->with('questions')
                ->withCount('users')
                ->availableForUser()
                ->get();
        }

        return $nearestGroups;
    }

    /**
     * Store Story.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeStory(Request $request)
    {
        return response()->json(['x_x' => 'Hi again']);
        dd($request->storyText);
        // Validate Form
        $this->validateContactUs($request);

        Story::create($request->all());

        return redirect()->route('contactus')->with('status', __('lang.contactUsDone'));
    }


    /**
     * Show User Notifications
     *
     * * @return \Illuminate\Contracts\Support\Renderable
     */
    public function notifications()
    {
        return view('front.notifications', [
            'notifications' =>  tap(auth()->user()->notifications)->markAsRead()
        ]);
    }


    /**
     * Show the about page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        return view('front.about');
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
}
