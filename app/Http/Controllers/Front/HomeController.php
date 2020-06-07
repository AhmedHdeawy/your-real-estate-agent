<?php

namespace App\Http\Controllers\Front;

use App\User;
use Validator;
use App\Models\Info;

use App\Models\Group;
use App\Models\Setting;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nearestGroups = $this->fetchNearestGroups();

        return view('front.home', compact('nearestGroups'));
    }

    /**
     * Fetch Nearest Groups for the visitor in 100km
     */
    private function fetchNearestGroups()
    {
        // $visitorDetails = geoip()->getLocation('41.233.37.222');
        $visitorDetails = geoip()->getLocation(geoip()->getClientIP());
        $latitude = $visitorDetails->latitude;
        $longitude = $visitorDetails->longitude;

        $nearestGroups = [];
        if ($latitude && $longitude) {
            $nearestGroups = Group::select(
                DB::raw('
                    *, ( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( lat ) ) ) ) AS distance
                    ')
            )->having('distance', '<', 100)
                ->orderBy('distance')
                ->limit(8)
                ->with('questions')
                ->withCount('users')
                ->get();
        }

        return $nearestGroups;
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
