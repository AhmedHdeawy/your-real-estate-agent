<?php

namespace App\Http\Controllers\Front;

use Image;
use Validator;
use App\Models\Blog;
use App\Models\Type;
use App\Models\Period;
use App\Models\Amenitie;
use App\Models\Category;
use App\Models\Property;
use App\Models\ContactUs;
use App\Models\Completing;
use App\Models\Furnishing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{


    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $properties = Property::active()->whereHas('images')->limit(20)->get();
        $blogs = Blog::active()->latest()->limit(3)->get();

        return view('front.home', compact('properties', 'blogs'));
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function blogs(Request $request)
    {
        $blogs = Blog::active()->latest()->limit(3)->paginate();

        return view('front.blogs', compact('blogs'));
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function blog(Request $request, $id)
    {
        $blog = Blog::findOrFail($id)->active()->first();

        return view('front.blog', compact('blog'));
    }

    /**
     * Search.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $query = Property::latest();

        if($request->has('category')) {
            $query = $query->where('category_id', $request->category);
        }

        if($request->has('type')) {
            $query = $query->orWhere('type_id', $request->type);
        }

        if($request->has('period')) {
            $query = $query->orWhere('period_id', $request->period);
        }

        if ($request->has('furnishing')) {
            $query = $query->orWhere('furnishing_id', $request->furnishing);
        }

        if ($request->has('no_of_rooms')) {
            $query = $query->orWhere('no_of_rooms', $request->no_of_rooms);
        }

        if ($request->has('min_price')) {
            $query = $query->orWhere('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query = $query->orWhere('price', '<=', $request->max_price);
        }

        if ($request->has('text')) {
            $query = $query->orWhere('address', 'LIKE', '%'. $request->text . '%');
        }

        if ($request->has('amenities')) {
            $query = $query->whereHas('amenities', function (Builder $q) use($request) {
                $q->whereIn('amenities.id', $request->amenities);
            });
        }

        $properties = $query->get();
dd($properties);
        return view('front.search-result', compact('properties'));
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
