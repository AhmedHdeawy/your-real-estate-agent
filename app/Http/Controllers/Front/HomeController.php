<?php

namespace App\Http\Controllers\Front;

use Image;
use Validator;
use App\Models\Post;
use App\Models\Group;

use App\Models\Story;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Johntaa\Arabic\I18N_Arabic;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Johntaa\Arabic\Arabic\I18N_Arabic_Identifier;

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

        // Get Stories that has Items and each item has valid date
        $stories = Story::with(['items' => function ($query) {
            $query->where('created_at', '>=', now()->subDay());
        }, 'user'])
            ->whereHas('items', function (Builder $query) {
                $query->where('created_at', '>=', now()->subDay());
            })
            ->whereIn('user_id', $userFreindsIDs)
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

        if ($request->storyText) {

            // Validate Text
            Validator::make($request->all(), [
                'storyText' => 'required|string|max:120',
            ])->validate();

            $name = $this->saveTextStory($request->storyText);

            $story = Story::with(['items' => function ($query) {
                            $query->where('created_at', '>=', now()->subDay());
                        }, 'user'])
                        ->whereHas('items', function (Builder $query) {
                            $query->where('created_at', '>=', now()->subDay());
                        })
                        ->where('user_id', auth()->id())
                        ->first();

            if (!$story) {
                $story = Story::create(['user_id'   =>  auth()->id()]);
            }

            // Create Item
            $story->items()->create([
                'length'    =>  3,
                'type'      =>  'photo',
                'media'     =>  $name,
            ]);
        }

        if ($request->storyMedia) {

            // Validate Media
            Validator::make($request->all(), [
                'storyMedia' => 'required|max:5000',
            ])->validate();

            $file = $this->saveMediaStory($request);

            $name = $file['name'];
            $type = $file['type'];

            $story = Story::with(['items' => function ($query) {
                        $query->where('created_at', '>=', now()->subDay());
                    }, 'user'])
                    ->whereHas('items', function (Builder $query) {
                        $query->where('created_at', '>=', now()->subDay());
                    })
                    ->where('user_id', auth()->id())
                    ->first();


            // Create Story if not exist
            if (!$story) {
                $story = Story::create(['user_id'   =>  auth()->id()]);
            }

            // Create Items
            $story->items()->create([
                'length'    =>  $type == 'photo' ? 4 : 0,
                'type'      =>  $type,
                'media'     =>  $name,
            ]);
        }
        // return redirect()->route('home')->with('status', __('lang.contactUsDone'));

        return response()->json(['story'   => $story->load('items', 'user')]);
    }

    /**
     * Convert Story Text to Image and Save it
     */
    private function saveTextStory($text)
    {
        $Arabic = new I18N_Arabic('Glyphs');

        $text = $Arabic->utf8Glyphs($text);

        $imageName = time() . str_random(8) . '_rbzgo' . '_stories.jpg';

        Image::canvas(500, 500, '#635D92')
            ->text($text, 250, 100, function ($font) {
                $font->file(public_path('vendors/fonts/arial/ARIAL.TTF'));
                $font->size(25);
                $font->color('#ffffff');
                $font->align('center');
                $font->valign('middle');
            })
            ->save('uploads/stories/' . $imageName);

        return $imageName;
    }

    /**
     * Save Story Media.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    private function saveMediaStory(Request $request)
    {

        if ($request->file('storyMedia')->isValid()) {

            $file = $request->file('storyMedia');

            $name =  $file->getClientOriginalName();
            $name = time() . str_random(8) . '_rbzgo_' . $name;

            $type = $this->getFileType($file);

            $file->move(public_path("/uploads/stories/"), $name);

            return ['name' => $name, 'type'    =>  $type];
        }
    }

    /**
     * Get File type.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private function getFileType($file)
    {
        $type = explode('/', $file->getClientMimeType())[0];

        if ($type == 'image') {
            return 'photo';
        }

        return $type;
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
