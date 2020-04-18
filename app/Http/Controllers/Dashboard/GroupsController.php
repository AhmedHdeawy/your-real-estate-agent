<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group;

class GroupsController extends Controller
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
        'groups.name'   => [ 'like', request('name') ],
        'groups.description'   => [ 'like', request('desc') ],
        'groups.status'              => [ '=', request('status') ]
      ];

      $query = Group::latest();

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $groups = $searchQuery->paginate(config('loqyana.perPage'));

      return view('dashboard.groups.index', compact('groups'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Group $group)
    {
        return view('dashboard.groups.show', compact('group'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\GroupRequest  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $this->validate($request, [
            'status'    =>  'required|in:0,1'
        ]);

        $group->status = $request->status;
        $group->save();

        return redirect()->route('admin.groups.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the group
     */
    public function destroy(Group $group)
    {
        // Get Image name
        $image = $group->image;

        // Delete Record
        $group->delete();

        // Delete Image
        $this->deleteFile('groups/', $image);


      return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
