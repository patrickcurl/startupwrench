<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\Topic;
class ResourceController extends Controller
{
    public function getIndex($slug = null)
    {
        $resource = Resource::findBySlug($slug);
        return view('resources.show', ['resource' => $resource, 'template' => 'resource']);
    }

    public function getNew()
    {
        $resource = new Resource;
        $allTopics = Topic::all()->sortBy('name');
        $topics = [];
        foreach ($allTopics as $topic) {
            $topics += [$topic->id => $topic->name];
        }
        return view('resources.new', ['topics' => $topics, 'resource' => $resource]);
    }

    public function postNew(Request $request, Resource $resource)
    {
        //
        $input = $request->all();
        $topics = $input['topics'];
        array_forget($input, 'topics');

        foreach ($input as $k => $v) {
            if ($k != "_token" && $k != "submit") {
                $resource->$k = $v;
            }
        }
        // return $resource;
        if ($resource->save()) {
            $resource->topics()->sync($topics);
        }

        // return $resource;
        // return var_dump($input);
        // Resource::create("name"=>);

        return redirect()->back();
    }

    // API CALLS
}
