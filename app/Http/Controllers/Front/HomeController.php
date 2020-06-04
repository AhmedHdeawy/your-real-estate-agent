<?php

namespace App\Http\Controllers\Front;

use App\User;
use Validator;
use App\Models\Info;

use App\Models\Setting;
use App\Models\ContactUs;
use Illuminate\Http\Request;
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
        dd(geoip()->getClientIP(), geoip()->getLocation(geoip()->getClientIP()), geoip()->getLocation('196.153.208.216'));
        // dd(geoip()->getLocation(\Request::ip()));
        dd(geoip()->getLocation('196.153.208.216'));
        return view('front.home');
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
