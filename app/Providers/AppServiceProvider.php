<?php

namespace App\Providers;

use App\Models\AllSetting;
use App\Models\Category;
use App\Models\WebsiteInfo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        #share menu categories for all pages
        $categories   = Category::with('productCount')->where('root', 0)->where('status', 'active')->get();
        View::share('menucategories', $categories);
        $info   = WebsiteInfo::first();
        View::share('websiteInfo', $info);
        $settingall   = AllSetting::first();
        View::share('setting', $settingall);

        #Share Breadcrumbs for all page //its a diglactic/laravel-breadcrumbs package
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
    }
}