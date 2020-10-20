<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompletingRequest;
use Cache;

use App\Models\Completing;


class CompletingsController extends Controller
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
        'completing_translations.completings_desc'   => [ 'like', request('desc') ],
        'completings.completings_status'              => [ '=', request('status') ]
      ];

      $query = Completing::join('completing_translations', 'completings.id', 'completing_translations.completing_id')
                        ->groupBy('completings.id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $completings = $searchQuery->paginate(config('rbzgo.perPage'));

      return view('dashboard.completings.index', compact('completings'));
    }


    /**
     * Goto the form for creating a new completing.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.completings.create');
    }


    /**
     * Store a newly created completing.
     *
     * @param  \App\Modules\Admin\Http\Requests\CompletingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompletingRequest $request)
    {
       // dd($request->all());
        $completing = Completing::create($request->all());

        return redirect()->route('admin.completings.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Completing  $completing
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Completing $completing)
    {
        $showLang = $request->showLang;
        return view('dashboard.completings.show', compact('completing', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Completing $completing)
    {

        return view('dashboard.completings.edit', compact('completing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(CompletingRequest $request, Completing $completing)
    {

        $completing->update($request->all());

        return redirect()->route('admin.completings.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the completing
     */
    public function destroy(Completing $completing)
    {
        // Delete Record
        $completing->delete();

        Cache::forget('completings');

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
