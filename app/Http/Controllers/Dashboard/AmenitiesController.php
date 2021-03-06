<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AmenitieRequest;
use Cache;

use App\Models\Amenitie;


class AmenitiesController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $request->flash();

      $inputsArray = [
        'amenitie_translations.amenities_desc'   => [ 'like', request('desc') ],
        'amenities.amenities_status'              => [ '=', request('status') ]
      ];

      $query = Amenitie::join('amenitie_translations', 'amenities.id', 'amenitie_translations.amenitie_id')
                        ->groupBy('amenities.id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $amenities = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.amenities.index', compact('amenities'));
    }


    /**
     * Goto the form for creating a new amenitie.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.amenities.create');
    }


    /**
     * Store a newly created amenitie.
     *
     * @param  \App\Modules\Admin\Http\Requests\AmenitieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AmenitieRequest $request)
    {
       // dd($request->all());
        $amenitie = Amenitie::create($request->all());

        Cache::forget('properties_amenities');

        return redirect()->route('admin.amenities.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Amenitie  $amenitie
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Amenitie $amenity)
    {
        $showLang = $request->showLang;
        return view('dashboard.amenities.show', compact('amenity', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Amenitie $amenity)
    {
        return view('dashboard.amenities.edit', compact('amenity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AmenitieRequest $request, Amenitie $amenity)
    {
        $amenity->update($request->all());

        Cache::forget('properties_amenities');

        return redirect()->route('admin.amenities.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the amenitie
     */
    public function destroy(Amenitie $amenity)
    {
        // Delete Record
        $amenity->delete();

        Cache::forget('properties_amenities');

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
