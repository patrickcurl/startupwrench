<?php
namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use App\Models\Resource;
class Topic extends BaseModel implements SluggableInterface
{
    use SluggableTrait;
    //
    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug'
    ];

    protected $rules = [
        'name' => 'required|regex:/^[\pL\s]+$/u|unique:topics,name'
    ];

    public function resources()
    {
        return $this->belongsToMany(Resource::class, 'resource_topics');
    }

    public static function create(array $attributes = [])
    {
        $model = new static($attributes);
        $model->save();
        return $model;
    }

}
