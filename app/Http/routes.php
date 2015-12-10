<?php
use SocialNorm\Exceptions\ApplicationRejectedException;
use SocialNorm\Exceptions\InvalidAuthorizationCodeException;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	  $topics = App\Topic::all()->sortBy('name');
    return view('home')->with('topics', $topics);
});

Route::get('/admin', ['middleware' => 'auth', function(){
	return view('admin');
}]);

Route::controller('users', 'UserController');

// Route::group(['prefix' => 'users'], function(){
// 	Route::get('/login', function(){
// 		return "Auth.login";
// 	});

// 	Route::get('/setup', function(){

// 	});
// });

Route::get('/topic/{slug}', function($slug){
	// return $slug;
	$topic = App\Topic::findBySlug($slug);
	return view('topic')->with('topic', $topic);
});

Route::get('/resource/{slug}', function($slug){
    $resource = App\Resource::findBySlug($slug);
    return view('resource')->with('resource', $resource);
});

Route::get('/test', function(){
	return Auth::user();
});

// Route::get('/preview', 'ResourceController@preview');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
	Route::get('/', function(){
		return view('admin.index');
	});
  Route::post('resource/create', 'ResourceController@store');
	Route::resource('resource', 'ResourceController');

});

Route::get('facebook/authorize', function() {
    return SocialAuth::authorize('facebook');
});

Route::get('facebook/login', function() {
    try {
        SocialAuth::login('facebook', function($user, $details){
        	$user->email = $details->email;
        	$user->save();
        });
    } catch (ApplicationRejectedException $e) {
        // User rejected application
    } catch (InvalidAuthorizationCodeException $e) {
        // Authorization was attempted with invalid
        // code,likely forgery attempt
    }


    // Current user is now available via Auth facade
    $user = Auth::user();

    // if(!$user->password || $user->email){
    // 	return redirect('/setup_account')->with('user', $user);
    // }

    return redirect('/admin');
});

