<?php

namespace App\Providers;

use App\Http\View\Composers\CategoryTreeComposer;
use App\Http\View\Composers\UserCartComposer;
use App\Http\View\Composers\UserWishlistComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('site::partials.navigations.category_navigation', CategoryTreeComposer::class);
        View::composer('site::partials.header', UserCartComposer::class);
        View::composer('site::partials.header', UserWishlistComposer::class);
    }
}
