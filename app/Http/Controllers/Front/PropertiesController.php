<?php

namespace App\Http\Controllers\Front;

use Image;
use Validator;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Amenitie;
use App\Models\Category;
use App\Models\Completing;
use App\Models\Period;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class PropertiesController extends Controller
{
    /**
     * Show the create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $categories = Cache::rememberForever('properties_categories', function () {
            return Category::all();
        });


        $types = Cache::rememberForever('properties_types', function () {
            return Type::all();
        });

        $amenities = Cache::rememberForever('properties_amenities', function () {
            return Amenitie::all();
        });

        $completings = Cache::rememberForever('properties_completings', function () {
            return Completing::all();
        });

        $periods = Cache::rememberForever('properties_periods', function () {
            return Period::all();
        });


        return view('front.create', compact('categories', 'types', 'amenities', 'completings', 'periods'));
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
