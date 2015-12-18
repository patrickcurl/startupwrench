<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Topic;
use App\Resource;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $latest = Resource::where('approved','=', true)->orderBy('created_at', 'desc')->take(42)->get();
        $topics = Topic::all()->sortBy('name');
        $wide = false;
        $featured_resources = Resource::getFeatured(5);
        $sidebar_ads['adsense'] = "<script type='text/javascript'>google_ad_client = 'ca-pub-4190828597999315'\; google_ad_slot = '8479557582'; google_ad_width = 336; google_ad_height = 280;</script><!-- startupwrench-sidebar-top --><script type='text/javascript' src='//pagead2.googlesyndication.com/pagead/show_ads.js'></script>";

        $sidebar_ads['inmotion'] = "<a href='" . url('/go/inmotion') ."'><img src='" . url('/uploads/ih_wordpress-336x280.gif'). "' class='img-responsive'></a>";

        // $side_ads_safe = [$inmotion];
        // $side_ads_all = [$adsense, $inmotion];

        view()->share('latest', $latest);
        view()->share('topics', $topics);
        view()->share('sidebar_ads', $sidebar_ads);
        view()->share('featured_resources', $featured_resources);

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
