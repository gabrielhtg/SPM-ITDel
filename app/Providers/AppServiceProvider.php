<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Announcement;
use App\Models\News;
use App\Models\Dashboard;
use App\Models\HeroDashboard;

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
            $guestNews = News::latest()->take(1)->get();
            $guestHero = HeroDashboard::latest()->take(1)->get();
            $guestIntroduction = Dashboard::latest()->take(1)->get();
            $guestBigNews = News::latest()->first();

            $view->with('newAnnouncement', $newAnnouncement);
            $view->with('guestNews', $guestNews);
            $view->with('guestHero', $guestHero);
            $view->with('guestBigNews', $guestBigNews);
            $view->with('guestIntroduction', $guestIntroduction);
        });
    }
}
