<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Resource;
use App\Topic;
use App\User;

class AdminController extends Controller
{
	public function showPage(Request $request){
		$route = $request->route();
    $name = '';
    $content = '';
    $config = $request->get('config', []);
    if (is_array($config)) {
        foreach ($config as $k => $v) {
            config(["laravel_dashboard.{$k}" => $v]);
        }
    }
    if (!$route || !\File::exists($file = base_path('/resources/views/admin/pages/' . str_replace('.', '/',
                $route->getName()) . ".blade.php"))
    ) {
        app('laravel_dashboard')->setPageTitle('Laravel Dashboard Demo');
    } else {
        app('laravel_dashboard')->setPageTitle(trans('titles.' . $route->getName()));
        $name = trans('titles.' . $route->getName());
        return view('admin.pages.name');
        $content = app('markdown')->convertToHtml(\File::get($file));
    }
    return view('admin.index', ['name' => $name, 'content' => $content]);
	}

	public function getPage(){
		// $route = $request->route();
		// $name = $route->getName();
		$page = \Request::route()->getName();
		$topics = Topic::all();
		$resources = Resource::all();
		$data = ["topics" => $topics, "resources" => $resources];
		// return $data["topics"];
		if($page){
			return view("admin.$page", $data);
		} else {
			return redirect('/admin', $data);
		}
		
	}

	public function getResources(){
		$resources = Resource::paginate(40);
		if (\Request::ajax()){
			return \Response::json(view('admin.ajax.resources', compact('resources'))->render());
		}
		return view('admin.resources', compact('resources'));
	}

	public function getResourceLinks(){
		$resources = Resource::paginate(40);
		if (\Request::ajax()){
			return \Response::json(view('admin.ajax.resource-links', compact('resources'))->render());
		}
		return view('admin.resource-links', compact('resources'));
	}

	public function postResourceLinks(){
		$query = \Input::get('query');
		$resources = Resource::where("name","like", "%$query%")->paginate(40);
		return view('admin.resource-links', compact('resources'));
	}

	public function postResources(){
		$id = \Input::get('pk');
		$name = \Input::get('name');
		$value = \Input::get('value');
		$resource = Resource::find($id);
		
		if($resource->setVal($name, $value)){
			return \Response::json(['status' => 1]);
		} else {
			return \Response::json(['status' => 0]);
		}
		// $topic = App\Topic::find(\Input::get('pk'));
       // $topic->name = Input::get('value');
       // if($topic->save()){
       //  return Response::json(['status' => 1, 'name' => $topic->name]);
       // } else {
       //  return Response::json(['status' => 0]);
       // }
	}
}