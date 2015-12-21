<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ContactFormRequest;
use App\Http\Controllers\Controller;
use Mail;
use App\User;
// use App\Resource;
// use App\Topic;
class PageController extends Controller
{
	// public function getIndex($slug = null)
	// {
	// 	 $resource = Resource::findBySlug($slug);
	// 	 return view('resources.show')->with('resource', $resource);
	// }

	public function getHome(){
		return view('pages.home', ['template' => 'wide']);
	}

	public function getPage($page){
		$wide = ['contact', 'home', 'jobs'];
	
		foreach($wide as $w){

			if($w == $page){

				return view("pages.$page")->with('template', "wide");
			}
		}

		return view("pages.$page");
	}

	// public function missingMethod($page = []){
		
	// }

	public function postContact(ContactFormRequest $request){
		\Mail::send('emails.contact',
        array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'website' => $request->get('website'),
            'user_message' => $request->get('message')
        ), function($message)
    {
        $message->from('patrick@startupwrench.com');
        $message->to('patrickwcurl@gmail.com', 'Admin')->subject('StartupWrench Feedback');
    });
		return redirect('contact')->with('message', 'Thanks for contacting us!');
	}


}