<?php

namespace App\Http\Controllers\Front;

use App\User;
use Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    /**
     * Show the Profile page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile(Request $request)
    {
        $groups = Auth::user()->inGroups()->withCount('users', 'posts')->get();

        return view('front.userProfile', compact('groups'));
    }


    /**
     * Show the user Profile page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userProfile(Request $request)
    {
        $user = User::whereUsername($request->username)->first();

        $groups = $user->inGroups()->withCount('users', 'posts')->get();

        if ($user->is(Auth::user())) {
            return view('front.profile', compact('groups'));
        }

        return view('front.userProfile', compact('groups'));
    }


    /**
     * Post the Profile Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        // Validate Form
        $this->validateProfile($request);

        $user = User::findOrFail(auth()->user()->id);

        // Update User Profile
        $user->update($request->all());

        if ($request->password) {
            Auth::logout();
            return redirect()->route('login');
        }

        return redirect()->route('profile')->with('status', __('lang.updatedSuccessfully'));
    }


    /**
     * Validate Form Request.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateProfile(Request $request)
    {
        Validator::make($request->all(), [
            'name'      => 'required|string|max:100|min:2',
            'email'     => 'required|max:100|min:2|email|unique:users,email,' . auth()->user()->id . ',id',
            'phone'     => 'required|max:100|min:2||unique:users,phone,' . auth()->user()->id . ',id',
            'password'  => 'confirmed',
            'avatar'    => 'nullable',

        ])->validate();
    }
}
