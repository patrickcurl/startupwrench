<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\Topic;
class TopicController extends Controller
{
    public function __construct()
    {
        $this->data = [
            'latest'             => Resource::where('approved', '=', true)->orderBy('created_at', 'desc')->take(42)->get(),
            'topics'             => Topic::all()->sortBy('name'),
            'wide'               => false,
            'featured_resources' => Resource::getFeatured(5),
            'sidebar_ads'        => [
                'adsense'  => "<script type='text/javascript'>google_ad_client = 'ca-pub-4190828597999315'\; google_ad_slot = '8479557582'; google_ad_width = 336; google_ad_height = 280;</script><!-- startupwrench-sidebar-top --><script type='text/javascript' src='//pagead2.googlesyndication.com/pagead/show_ads.js'></script>",
                'inmotion' => "<a href='" . url('/go/inmotion') . "'><img src='" . url('/uploads/ih_wordpress-336x280.gif') . "' class='img-responsive'></a>"
            ]
        ];
    }

    public function getTopic($slug)
    {
        $topic = Topic::findBySlug($slug);
        $data = $this->data;
        $data['topic'] = $topic;
        return view('topics.show', $data);
    }
}
