<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Resource;
use App\Topic;
class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Resource::all();
        return view('admin.resources.index')->with('resources', $resources);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resource = new Resource;
        $allTopics = Topic::all()->sortBy('name');
        $topics = [];
        foreach($allTopics as $topic){
            $topics += [$topic->id => $topic->name];
         }

        // return var_dump($topics);
        return view('admin.resources.create', ['topics' => $topics, 'resource' => $resource]);
            // ->with('topics', $topics);
            //->with('rules', $this->rules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Resource $resource)
    {
        //
        $input = $request->all();
        $topics = $input['topics'];
        array_forget($input, 'topics');
        
        foreach($input as $k => $v){
            if($k != "_token" && $k != "submit"){
               $resource->$k = $v; 
            }


        }
        // return $resource;
        if($resource->save()){
            $resource->topics()->sync($topics);
        }

        // return $resource;
        // return var_dump($input);
        // Resource::create("name"=>);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resource = Resource::find($id);
        // return var_dump($resource);
        $allTopics = Topic::all()->sortBy('name');
        $topics = [];
        foreach($allTopics as $topic){
            $topics += [$topic->id => $topic->name];
            if($resource->topics->has($topic->id)){
            }
           
         }

        // return view('resources.edit')->with('resource', $resource);
        return view('admin.resources.edit')
            ->with('resource', $resource)
            ->with('topics', $topics);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function preview()
    {
        return \Form::preview();
    }

    public function rules(){
        return [
            'title' => 'required',
            'name' => 'required'
        ];
    }
}
