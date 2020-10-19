<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use Cache;

use App\Models\Property;


class PropertiesController extends Controller
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
        'property_translations.properties_desc'   => [ 'like', request('desc') ],
        'properties.properties_status'              => [ '=', request('status') ]
      ];

      $query = Property::join('property_translations', 'properties.id', 'property_translations.property_id')
                        ->groupBy('properties.id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $properties = $searchQuery->paginate(config('rbzgo.perPage'));

      return view('dashboard.properties.index', compact('properties'));
    }


    /**
     * Goto the form for creating a new property.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.properties.create');
    }


    /**
     * Store a newly created property.
     *
     * @param  \App\Modules\Admin\Http\Requests\PropertyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
       // dd($request->all());
        $property = Property::create($request->all());

        return redirect()->route('admin.properties.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Property $property)
    {
        $showLang = $request->showLang;
        return view('dashboard.properties.show', compact('property', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {

        return view('dashboard.properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, Property $property)
    {

        $property->update($request->all());

        return redirect()->route('admin.properties.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the property
     */
    public function destroy(Property $property)
    {
        // Delete Record
        $property->delete();

        Cache::forget('properties');

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
