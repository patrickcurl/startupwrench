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
    return view('pages.home')->with('topics', $topics)->with('wide', true);
});
Route::get('/', 'PageController@getHome');
Route::post('contact', 'PageController@postContact');
Route::get('topic/{slug}', 'TopicController@getTopic');
Route::controller('topic', 'TopicController');
Route::get('topic/{slug}', 'TopicController@getTopic');
// Route::get('/page/{page}', 'PageController@getPage');
Route::controller('page', 'PageController');

Route::get('login', function(){
    return view('users.login');
});

Route::group(['prefix' => 'api'], function(){
    Route::get('resource/search/{q}', function($q, $page=null){
        // $q = Input::get('query');
        $search = App\Resource::search($q, ['name' => 10, 'representation' => 7, 'description' => 6, 'content' => 5])->paginate(10);

        return $search;
        
        $r = \Response::json($search);
        return $r;

    });

    Route::get('test', function(){
        return 'testing';
    }); 
});

Route::post('login', 'Auth\AuthController@postLogin');

// Route::get('register', 'Auth\AuthController@getRegister');
Route::get('register', function(){
  return view('users.register');
});

Route::post('register', 'Auth\AuthController@postRegister');
Route::get('logout', 'Auth\AuthController@getLogout');

// Route::get('resource/new', function(){
//     return view('resources.new');
// });

// Route::group(['middleware'=>'dashboard'], function(){

// })
// Route::get('/admin', ['middleware' => ['auth', 'dashboard'], function(){
// 	return view('admin');
// }]);
// Route::get('/admin/{page}', 'AdminController@getPage');
Route::group(['middleware' => ['auth', 'dashboard', 'role:admin']], function(){
    // Route::get('/admin', function(){
    //     return view('admin');
    // });
    Route::get('/admin', ['as' => 'home', 'uses' => 'AdminController@showPage']);
    Route::get('/admin/topics', ['as' => 'topics', 'uses' => 'AdminController@getPage']);
    Route::post('/admin/topics', 'AdminController@postTopics');
    Route::get('/admin/resources', ['as' => 'res.edit', 'uses' => 'AdminController@getResources']);
    Route::get('/admin/resource-links', ['as' => 'res.links', 'uses' => 'AdminController@getResourceLinks']);
    Route::post('/admin/resource-links', 'AdminController@postResourceLinks');
    Route::post('/admin/resources', 'AdminController@postResources');
    
    Route::get('/admin/{page}', 'AdminController@getPage');
    //Route::get('/admin/{$page}', 'AdminController@getPage');
    Route::get('/configurations', ['as' => 'config', 'uses' => 'AdminController@showPage']);
    
   
    
    
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('/resource/new', 'ResourceController@getNew');
    Route::post('/resource/new', 'ResourceController@postNew');
});

Route::controller('users', 'UserController');

// Route::get('/topic/{slug}', 'TopicController@getTopic');
Route::get('resource/{slug}', 'ResourceController@getIndex');
Route::get('resources/{slug}', 'ResourceController@getIndex');
Route::controller('resource', 'ResourceController');



Route::get('/go/{slug}', function($slug){
    switch($slug){
        case "inmotion":
        return redirect("https://secure1.inmotionhosting.com/cgi-bin/gby/clickthru.cgi?id=patrickcurl&page=3");
    }
});

Route::get('/out/{slug}', function($slug){
    $resource = App\Resource::findBySlug($slug);
    if($resource->afflink){
        $url = $resource->afflink;
    } else {
       $url = $resource->domain; 
    }
    $resource->clicks += 1;
    $resource->save();
    return redirect($url);
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
Route::get('sitemap', 'SitemapController@getSitemap');
Route::get('sitemap-resources', 'SitemapController@getSitemapResources');
Route::get('sitemap-topics', 'SitemapController@getSitemapTopics');
Route::get('sitemap-pages', 'SitemapController@getSitemapPages');
Route::any('{catchall}', 'PageController@getPage');