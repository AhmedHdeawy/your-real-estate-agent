<?php

namespace App\Http\Controllers\Front;

use Image;
use Validator;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class PropertiesController extends Controller
{
    /**
     * Show the create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('front.create');
    }

    /**
     * Post the ContactUs Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return redirect()->route('property.create')->with('status', __('lang.contactUsDone'));
    }

}
