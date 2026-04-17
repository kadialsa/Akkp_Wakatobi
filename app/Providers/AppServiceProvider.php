<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Prodi;
use App\Models\Akreditasi;
use Illuminate\Support\Facades\View;
use App\Models\ContactMessage;
use App\Models\HeaderSetting;
use Illuminate\Support\Facades\Schema;

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
        try {
            if (Schema::hasTable('prodis')) {
                View::composer('*', function ($view) {
                    $view->with('navbarProdis', Prodi::orderBy('name')->get());
                });
            }

            if (Schema::hasTable('akreditasis')) {
                View::composer('*', function ($view) {
                    $view->with('akreditasi', Akreditasi::latest()->get());
                });
            }

            if (Schema::hasTable('contact_messages')) {
                View::composer('*', function ($view) {
                    $unreadMessages = ContactMessage::where('is_read', false)->count();
                    $view->with('unreadMessages', $unreadMessages);
                });

                View::composer('layout.admin', function ($view) {
                    $unreadMessages = ContactMessage::where('is_read', 0)->count();
                    $view->with('unreadMessages', $unreadMessages);
                });
            }

            if (Schema::hasTable('header_settings')) {
                $header = HeaderSetting::first();
                view()->share('header', $header);
            }
        } catch (\Exception $e) {
            // supaya tidak crash kalau DB mati
        }
    }
}
