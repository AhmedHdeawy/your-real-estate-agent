<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use Cache;

use App\Models\Status;


class StatusController extends Controller
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
        'status_translations.status_desc'   => [ 'like', request('desc') ],
        'status.status_status'              => [ '=', request('status') ]
      ];

      $query = Status::join('status_translations', 'status.id', 'status_translations.status_id')
                        ->groupBy('status.id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $status = $searchQuery->paginate(config('rbzgo.perPage'));

      return view('dashboard.status.index', compact('status'));
    }


    /**
     * Goto the form for creating a new status.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.status.create');
    }


    /**
     * Store a newly created status.
     *
     * @param  \App\Modules\Admin\Http\Requests\StatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusRequest $request)
    {
       // dd($request->all());
        $status = Status::create($request->all());

        return redirect()->route('admin.status.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Status $status)
    {
        $showLang = $request->showLang;
        return view('dashboard.status.show', compact('status', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {

        return view('dashboard.status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(StatusRequest $request, Status $status)
    {

        $status->update($request->all());

        return redirect()->route('admin.status.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the status
     */
    public function destroy(Status $status)
    {
        // Delete Record
        $status->delete();

        Cache::forget('status');

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
