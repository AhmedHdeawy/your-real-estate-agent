<?php

namespace App\Http\Controllers\Front;

use Image;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Amenitie;
use App\Models\Category;
use App\Models\Completing;
use App\Models\Period;
use App\Models\Property;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
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
     * Store New Property
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Form
        $this->validatePropertyRequest($request);

        $property = Property::create(array_merge(['user_id' =>  auth()->id()], $request->all()));

        $property->amenities()->sync($request->amenities);

        return redirect()->route('property.create')->with('status', __('lang.contactUsDone'));
    }

    /**
     * Validate Form Request.
     *
     * @return \Illuminate\Http\Response
     */
    protected function validatePropertyRequest(Request $request)
    {
        Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'type_id' => 'required|numeric',
            'completing_id' => 'nullable|numeric',
            'amenities' => 'required|array|min:1',
            'period_id' => 'nullable|numeric',
            'ar.title' => 'required|string',
            'en.title' => 'required|string',
            'price' => 'required|numeric',
            'no_of_rooms' => 'nullable|numeric',
            'no_of_maidrooms' => 'nullable|numeric',
            'no_of_bathrooms' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'description' => 'required|string',
            'agent_name' => 'required|string',
            'agent_phone' => 'required|string',
            'agent_email' => 'required|email',
        ])->validate();
    }

}
