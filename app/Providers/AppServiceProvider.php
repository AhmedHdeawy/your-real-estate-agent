<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request;

use App\Models\Language;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // // Get Langs from DB
        // $languages = Language::active()->get();

        // // check for Commands and Seeding
        // if ($languages->isEmpty()) {
        //     return true;
        // }

        // // Get locale code and Convert them Array
        // $localesLangs = $languages->pluck('locale')->toArray();

        // // Get First Lang
        // $defaultFromDB = $localesLangs[0];

        // // Get Locale from URL
        // $defaultFromUrl = request()->segment(1);

        // // check if App locale Exist in DB
        // if (in_array($defaultFromUrl, $localesLangs)) {
        //     app()->setlocale($defaultFromUrl);

        // } else {

        //     app()->setlocale($defaultFromDB);
        // }

        // // Get Segemnt (3) for used it in Admin Panel
        // $segment = Request::segment(3);

        // // Get Locale Now
        // $localeLang = app()->getLocale();

        // $localeLangInverse = app()->getLocale() == 'ar' ? 'en' : 'ar';

        // $currentLangDir = $languages->firstWhere('locale', $localeLang)->dir;

        // view()->share(compact('languages', 'segment', 'currentLangDir', 'localeLang', 'localeLangInverse'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
