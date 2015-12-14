<?php
namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Topic extends BaseModel implements SluggableInterface
{
	use SluggableTrait;
    //
	protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
  ];

  protected $rules = [
  	'name' => 'required|regex:/^[\pL\s]+$/u|unique:topics,name'
  ];

  

	
  public function resources(){
  	return $this->belongsToMany('App\Resource');
  }

  
 	// public function resourceCount(){
  //   return 
  // }

  public static function create(array $attributes = [])
    {
        $model = new static($attributes);
        $model->save();
        return $model;
    }



  // edit create to be more of a find or create function. 
  // public static function create(array $attributes = [])
  // {
  // 	// check if row with "name" already exists.
  // 	$count = \DB::table('topics')->where('name','=', $attributes['name'])->count();
  //   		if(!($count >= 1) ){
  //   			// if it does, then we return that model instead of creating duplicate.
  //   			$model = Topic::where('name', '=', $attributes['name'])->first();
    			
  //   		} else {
  //   			// else we create a new model
  //   			$model = new static($attributes);
  //         $model->save();
	        
  //   		}

  //       return $model;
  // }






}