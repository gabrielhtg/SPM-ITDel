<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Announcement;
use App\Models\News;

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
            $newAnnouncement = Announcement::latest()->take(5)->get();
            $guestNews = News::latest()->take(6)->get();
            $guestBigNews = News::latest()->first();
            // dd($guestBigNews);

            $view->with('newAnnouncement', $newAnnouncement);
            $view->with('guestNews', $guestNews);
            $view->with('guestBigNews', $guestBigNews);
        });
    }
}
