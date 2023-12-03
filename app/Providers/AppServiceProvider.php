<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Company;
use App\Models\Province;
use App\Models\Section;

use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $setting = Setting::where('status', '1')->first();
        $sections = Section::all();
        $categories = Category::all();
        $companies = Company::all();
        $provinces = Province::all();

        
        View::share(['provinces'=>$provinces,'setting' => $setting,'sections'=>$sections,'categories'=>$categories,'companies'=>$companies]);
    }
}
