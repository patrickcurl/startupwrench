<?php
namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Spatie\Browsershot\Browsershot;

use \Image;
use \Screenshot;

class Resource extends BaseModel implements SluggableInterface, StaplerableInterface
{
	use SluggableTrait;
	use EloquentTrait;
  use AlgoliaEloquentTrait;
  
	protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];

  protected $rules = [
    'name' => 'required|unique:resources,name'
  ];

  public $algoliaSettings = [
        'attributesToIndex' => [
            'id', 
            'name',
            'description',
            'representation',
            'content'
        ],
        'customRanking' => [
            'desc(popularity)', 
            'asc(name)',
        ],
    ];



  public function topics(){
  	return $this->belongsToMany('App\Topic');
  }

  // public function __construct(array $attributes = array()) {
  //       $this->hasAttachedFile('logo', [
  //           'styles' => [
  //               'medium' => '400x300',
  //               'thumb' => '100x100'
  //           ]
  //       ]);

  //       parent::__construct($attributes);
  //   }

  // protected $guarded = ['_token', 'submit'];
  protected $fillable = ['title', 'excerpt', 'description', 'logo', 'featured_image', 'email', 'website', 'name', 'slug'];

  public function get_logo(){
  	if($this->logo_url){
  			$img = Image::make($this->logo_url)->resize(300,200);
  			return $img->save("uploads/logos/{$this->slug}-logo-300-200.png");
  	}
  }

  public function selectedTopics(){
  	$selected = [];
  	foreach($this->topics as $topic){
  		$selected[] += $topic->id;
  	}
  	return $selected;
  }

  // public function categories(){
  // 	$c = Topic::where('name', '=' $this->categories)
  // 	return $c;
  // 	$this->topics->attach($c->id);
  // }
  

  public function phantom($url = ""){
    if($url == null){$url = $this->url;}
    $filepath = "public/uploads/sites/{$this->slug}.png";
    try{
        
        $c = new \Anam\PhantomMagick\Converter();
        $c->height(700);
        $c->quality(90);
        
        if($c->source($url)->toPng()->save($filepath) == null){ 
          return true;
        }
        if(self::contains($c->source($url)->toPng()->save($filepath), "failed")){
          return false;
        }
        
    } catch(Exception $e) 
    {
      return $e;
    }

    return false;
  }
 

  public function setFeaturedImage(){
    $filepath = "public/uploads/sites/{$this->slug}.png";
    if(!file_exists($filepath) || $this->featured_image == null || $this->featured_image == "image-not-available.png"){
      // Try to get a new site image using phantomJS if it doesn't already have one.
      // Regardless of whether a placeholder has been set.    
      try { 
        // If phantom is a success update db, and save. 
        if($this->phantom() == true){
          $this->featured_image = "{$this->slug}.png";
          $this->save();
          return true;
        }
        // if phantom failed set to the placeholder image.
        $this->featured_image = "image-not-available.png";
        $this->save();
        return "Could not fetch, using placeholder instead.";
        
      } catch(Exception $e) {
        return $e;
      }
    }
    // if the file exists, assume something else went wrong and db wasn't updated properly, so lets update that. 
    if(file_exists($filepath) && $this->featured_image != "{$this->slug}.png"){
      $this->featured_image = "{$this->slug}.png";
      $this->save();
      return "Updated image in db, file exists.";
    }
    // nothing to do file exists and is in db properly. 
    return "File already exists";
  }




  public function resize_image($file, $w = 1280, $h = 1024){
    $img = Image::make($file);
    $img->resize($w,$h);
    $img->save($file);
  }


  public function grab_logo($logo_url)
  { 
    $file = basename($logo_url);
    if (!file_exists("public/uploads/logos/$file")){
      
      try 
      {
        // $this->logo_file_name = $file;
        // create the image and save locally. 
        $img = Image::make($logo_url);
        if($img->save("public/uploads/logos/{$file}")){
          $this->logo_file_name = $file;
          $this->save();
          return true;
        }

      } catch(\Exception $e){
        return 'GrabLogo Exception: ' + $e->getMessage();
      } 
    }

    if($this->logo_file_name != $file){
      $this->logo_file_name = $file;
      $this->save();
      return true;
    }

  }

  


// Mutators
  public function getUrlAttribute(){
    $domain = $this->format_domain($this->domain);
    $url = strtolower($this->getUrl($this->domain));
    if($this->is_url($url)){
      return $url;
    }

    return false;
    
  }

  public function setCategoriesAttribute($value){
    // $t = App\Topic::where('name', '=', $value)->first();
    // $this->topics()->attach($t);
    return $value;
  }

  public function setUrlAttribute($value){
    // $t = App\Topic::where('name', '=', $value)->first();
    // $this->topics()->attach($t);
    return $this->domain = $value;
  }

  public function setLogoAttribute($value){
    return $this->logo = $value;
  }


  public function format_domain($domain){
    $not_allowed = ["http://", "https://"];
    foreach($not_allowed as $n)
    {
      if(strpos($domain,$n) === 0)
      {
        return str_replace($n,'', $domain);
      }
    }
    return $domain;
  }

  public function setVal($name, $value){
    try{
      $this->{$name} = $value;
      return $this->save();
    } catch(Exception $e){
      return $e;
    }

    return "hmmm";
  }

  
  public function sync_cats($cat)
  {
    $this->topics()->sync([Topic::where('name','=', $cat)->first()->id]);
  }

  
    // public function save(array $options = array())
    // {
    //     // $this->grab_bs();

    //     parent::save($options);
    //     self::addAllToIndex();
    //     return true;

    // }

 


}
