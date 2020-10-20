<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
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

        $propertiesStatus = $this->getPropertiesStatus();

        $newProperties = $this->getPropertiesInLastTwoWeeks();

        return view('dashboard.dashboard.home', compact('newProperties', 'propertiesStatus'));
    }

    /**
     * Get Orders in Last Week.
     *
     * @return \Illuminate\Http\Response
     */
    private function getPropertiesStatus()
    {
        $propertiesStatus['stopped']     = Property::where('status', '0')->count();
        $propertiesStatus['active']      = Property::where('status', '1')->count();

        $propertiesStatus['stopped']     = 23;
        $propertiesStatus['active']      = 12;

        return $propertiesStatus;
    }

    /**
     * Get Properties in Last Two Weeks.
     *
     * @return \Illuminate\Http\Response
     */
    private function getPropertiesInLastTwoWeeks()
    {
        // Loop through last week days
        for ($i = 0; $i <= 13; $i++) {

            // Get Day for Search
            $day = date('Y-m-d', strtotime('-' . $i . ' day'));

            // Filter Properties per Today
            $propertiesInDay[$day] = Property::whereDate('created_at', $day)->orderBy('id', 'desc')->count();
        }

        return $propertiesInDay;
    }

}
