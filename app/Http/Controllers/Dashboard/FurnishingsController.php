<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FurnishingRequest;
use Cache;

use App\Models\Furnishing;


class FurnishingsController extends Controller
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
        'furnishing_translations.furnishings_desc'   => [ 'like', request('desc') ],
        'furnishings.furnishings_status'              => [ '=', request('status') ]
      ];

      $query = Furnishing::join('furnishing_translations', 'furnishings.id', 'furnishing_translations.furnishing_id')
                        ->groupBy('furnishings.id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $furnishings = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.furnishings.index', compact('furnishings'));
    }


    /**
     * Goto the form for creating a new furnishing.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.furnishings.create');
    }


    /**
     * Store a newly created furnishing.
     *
     * @param  \App\Modules\Admin\Http\Requests\FurnishingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FurnishingRequest $request)
    {
       // dd($request->all());
        $furnishing = Furnishing::create($request->all());

        return redirect()->route('admin.furnishings.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Furnishing  $furnishing
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Furnishing $furnishing)
    {
        $showLang = $request->showLang;
        return view('dashboard.furnishings.show', compact('furnishing', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Furnishing $furnishing)
    {

        return view('dashboard.furnishings.edit', compact('furnishing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(FurnishingRequest $request, Furnishing $furnishing)
    {

        $furnishing->update($request->all());

        return redirect()->route('admin.furnishings.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the furnishing
     */
    public function destroy(Furnishing $furnishing)
    {
        // Delete Record
        $furnishing->delete();

        Cache::forget('furnishings');

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
