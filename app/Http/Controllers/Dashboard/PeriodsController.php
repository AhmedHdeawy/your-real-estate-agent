<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PeriodRequest;
use Cache;

use App\Models\Period;


class PeriodsController extends Controller
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
        'period_translations.periods_desc'   => [ 'like', request('desc') ],
        'periods.periods_status'              => [ '=', request('status') ]
      ];

      $query = Period::join('period_translations', 'periods.id', 'period_translations.period_id')
                        ->groupBy('periods.id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $periods = $searchQuery->paginate(config('rbzgo.perPage'));

      return view('dashboard.periods.index', compact('periods'));
    }


    /**
     * Goto the form for creating a new period.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.periods.create');
    }


    /**
     * Store a newly created period.
     *
     * @param  \App\Modules\Admin\Http\Requests\PeriodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeriodRequest $request)
    {
       // dd($request->all());
        $period = Period::create($request->all());

        return redirect()->route('admin.periods.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Period $period)
    {
        $showLang = $request->showLang;
        return view('dashboard.periods.show', compact('period', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Period $period)
    {

        return view('dashboard.periods.edit', compact('period'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(PeriodRequest $request, Period $period)
    {

        $period->update($request->all());

        return redirect()->route('admin.periods.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the period
     */
    public function destroy(Period $period)
    {
        // Delete Record
        $period->delete();

        Cache::forget('periods');

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
