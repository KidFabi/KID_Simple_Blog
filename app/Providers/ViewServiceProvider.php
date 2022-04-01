<?php

namespace App\Providers;

use App\View\Composers\CategoryComposer;
use App\View\Composers\PostComposer;
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
        View::composer(['web.manager.posts.create', 'web.manager.posts.edit'], CategoryComposer::class);
        View::composer(['web.static.home'], PostComposer::class);
    }
}
