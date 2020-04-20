<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;


class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home');
    }
}
