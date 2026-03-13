<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Prodi;
use App\Models\Akreditasi;
use Illuminate\Support\Facades\View;
use App\Models\ContactMessage;
use App\Models\HeaderSetting;

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
        View::composer('*', function ($view) {
            $view->with('navbarProdis', Prodi::orderBy('name')->get());
        });

        View::composer('*', function ($view) {
            $view->with('akreditasi', Akreditasi::latest()->get());
        });


        View::composer('*', function ($view) {
            $unreadMessages = ContactMessage::where('is_read', false)->count();
            $view->with('unreadMessages', $unreadMessages);
        });

        View::composer('layout.admin', function ($view) {

            $unreadMessages = ContactMessage::where('is_read', 0)->count();

            $view->with('unreadMessages', $unreadMessages);
        });

        $header = HeaderSetting::first();

        view()->share('header', $header);
    }
}
