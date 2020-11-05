<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use Cache;

use App\Models\Type;


class TypesController extends Controller
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
        'type_translations.types_desc'   => [ 'like', request('desc') ],
        'types.types_status'              => [ '=', request('status') ]
      ];

      $query = Type::join('type_translations', 'types.id', 'type_translations.type_id')
                        ->groupBy('types.id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $types = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.types.index', compact('types'));
    }


    /**
     * Goto the form for creating a new type.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.types.create');
    }


    /**
     * Store a newly created type.
     *
     * @param  \App\Modules\Admin\Http\Requests\TypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request)
    {
       // dd($request->all());
        $type = Type::create($request->all());

        Cache::forget('properties_types');

        return redirect()->route('admin.types.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Type $type)
    {
        $showLang = $request->showLang;
        return view('dashboard.types.show', compact('type', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {

        return view('dashboard.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(TypeRequest $request, Type $type)
    {
        $type->update($request->all());

        Cache::forget('properties_types');

        return redirect()->route('admin.types.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the type
     */
    public function destroy(Type $type)
    {
        // Delete Record
        $type->delete();

        Cache::forget('properties_types');

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
