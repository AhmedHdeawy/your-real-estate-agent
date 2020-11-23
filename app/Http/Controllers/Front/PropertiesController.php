<?php

namespace App\Http\Controllers\Front;

use Image;
use Validator;
use App\Models\Type;
use App\Models\Period;
use App\Models\Amenitie;
use App\Models\Category;
use App\Models\Property;
use App\Models\Completing;
use Illuminate\Http\Request;
use App\Mail\SendMailToAgent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

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

        return redirect()->route('property.upload_images')->with('status', __('lang.contactUsDone'));
    }

    /**
     * Open to Upload Images
     *
     * @return \Illuminate\Http\Response
     */
    public function showProperty(Property $property)
    {
        // $relatedProperties = Property::limit(3)->get();

        $latitude = $property->lat;
        $longitude = $property->lng;

        $relatedProperties = Property::active()->select(
            DB::raw('
                *, ( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( lat ) ) ) ) AS distance
                ')
            )->having('distance', '<', 10)
            ->orderBy('distance')
            ->where('id', '!=', $property->id)
            ->get();

        return view('front.propertyDetails', compact('property', 'relatedProperties'));
    }

    /**
     * Open to Upload Images
     *
     * @return \Illuminate\Http\Response
     */
    public function openUploadImages(Property $property)
    {
        return view('front.upload-images', compact('property'));
    }

    /**
     * Open to Upload Images
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadImages(Request $request)
    {
        // Get Property
        $property = Property::find($request->property_id);
        foreach($request->images as $key => $image) {

            // Generate Image Name
            $file = $image;
            $name =  $file->getClientOriginalName();
            $name = uniqid('Property_Club_') . $key . time() . '_' . $name;
            $path = 'properties/' . $property->id;

            // Store Image
            Storage::disk('gcs')->putFileAs($path, $file, $name);

            // Save Image
            $property->images()->create(['image' =>  $path. '/' . $name]);
        }

        return response()->json(true, 200);
    }

    /**
     * Send Email to Agent
     */
    public function sendMailToAgent(Request $request)
    {
        $this->validate($request, [
            'property_id'  =>  'required|numeric',
            'name'  =>  'required',
            'email' =>  'required|email',
            'phone' =>  'required',
            'message' =>  'required',
        ]);

        $property = Property::findOrFail($request->property_id);
        $data = [
            'name'  =>  $request->name,
            'phone'  =>  $request->phone,
            'email'  =>  $request->email,
            'message'  =>  $request->message,
        ];

        Mail::to($property->agent_email)->send(new SendMailToAgent($property, $data));

        return back();
    }

    /**
     * Send Email to Agent
     */
    public function addToFavorites(Request $request)
    {
        $this->validate($request, [
            'property_id'  =>  'required|numeric',
        ]);

        $user = auth()->user();

        $oldFavorites = $user->favorites->pluck('id')->toArray();
        if (in_array($request->property_id, $oldFavorites)) {
            // Remove this property from favorites
            $user->favorites()->detach($request->property_id);
        } else {
            // Add this property to favorites
            $user->favorites()->attach($request->property_id);
        }


        return response()->json(null, 200);
    }

    /**
     * Validate Form Request.
     *
     * @return \Illuminate\Http\Response
     */
    protected function validatePropertyRequest(Request $request)
    {
        Validator::make($request->all(), [
            'category_id'       => 'required|numeric',
            'type_id'           => 'required|numeric',
            'completing_id'     => 'nullable|numeric',
            'amenities'         => 'required|array|min:1',
            'period_id'         => 'nullable|numeric',
            'ar.title'          => 'required|string',
            'en.title'          => 'required|string',
            'price'             => 'required|numeric',
            'no_of_rooms'       => 'nullable|numeric',
            'no_of_maidrooms'   => 'nullable|numeric',
            'no_of_bathrooms'   => 'nullable|numeric',
            'height'            => 'nullable|numeric',
            'width'             => 'nullable|numeric',
            'description'       => 'required|string',
            'agent_name'        => 'required|string',
            'agent_phone'       => 'required|string',
            'agent_email'       => 'required|email',
        ])->validate();
    }

}
