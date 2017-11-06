<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ContactFormRequest;
use App\Http\Controllers\Controller;
use Mail;
use App\Models\User;
use App\Models\Resource;
use App\Models\Topic;
class PageController extends Controller
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

    public function getHome()
    {
        $data = $this->data;
        $data['template'] = 'wide';
        return view('pages.home', $data);
    }

    public function getPage($page)
    {
        $wide = ['contact', 'home', 'jobs'];
        $data = $this->data;
        foreach ($wide as $w) {
            if ($w == $page) {
                $data['template'] = 'wide';
                return view("pages.$page", $data);
            }
            unset($data['template']);
        }

        return view("pages.$page", $data);
    }

    // public function missingMethod($page = []){

    // }

    public function postContact(ContactFormRequest $request)
    {
        \Mail::send('emails.contact',
            [
                'name'         => $request->get('name'),
                'email'        => $request->get('email'),
                'website'      => $request->get('website'),
                'user_message' => $request->get('message')
            ], function ($message) {
                $message->from('patrick@startupwrench.com');
                $message->to('patrickwcurl@gmail.com', 'Admin')
                        ->subject('StartupWrench Feedback');
            });
        return redirect('contact')->with('message', 'Thanks for contacting us!');
    }
}
