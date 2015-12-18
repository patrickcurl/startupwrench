<?php
namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
// use Codesleeve\Stapler\ORM\StaplerableInterface;
use App\Contracts\Reviewable;
use App\Traits\Reviewable as ReviewableTrait;
// use Codesleeve\Stapler\ORM\EloquentTrait;
// use Spatie\Browsershot\Browsershot;
// use Elasticquent\ElasticquentTrait;
use Sofa\Eloquence\Eloquence;
use \Image;

class Resource extends BaseModel implements SluggableInterface, Reviewable
{
  use Eloquence;
	use SluggableTrait;
  // use ElasticquentTrait;
	// use EloquentTrait;
  use ReviewableTrait;


  
	protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];


  
  protected $rules = [
    'name' => 'required|unique:resources,name'
  ];

  protected $searchableColumns = ['name', 'representation', 'description', 'content'];

  public function topics(){
  	return $this->belongsToMany('App\Topic');
  }

 


  // protected $guarded = ['_token', 'submit'];
  protected $fillable = ['title', 'excerpt', 'description', 'logo', 'featured_image', 'email', 'website', 'name', 'slug'];

  

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

  public function getFeaturedImageAttribute($value){
    if($value && $value != ""){
      return $value;
    }
    $filepath = "../public/uploads/sites/{$this->slug}.png";
    
    if(file_exists($filepath)){
       return "{$this->slug}.png";
      
    } else {
      return  "image-not-available.png";
    }

    

  }

  public function getFeaturedImage(){
    if($this->featured_image && $this->featured_image != ""){
      return $this->featured_image;
    }
    $filepath = "public/uploads/sites/{$this->slug}.png";
    if(file_exists($filepath)){
      return "{$this->slug}.png";
      // return $filepath;
    } else {
      return  "image-not-available.png";
    }

    

  }


  public function get_logo(){
    if($this->logo){
        $img = Image::make($this->logo_url)->resize(300,200);
        return $img->save("uploads/logos/{$this->slug}.png");
    }
  }

  public function setLogoAttribute($value){
    if(isset($value) && $value){
      $img = Image::make($value)->resize(300,200);
      $this->attributes['logo'] = "{$this->slug}.png";
      return $img->save("public/uploads/logos/{$this->slug}.png");
    }
     return false;
  }

  public function resize_image($file, $w = 1280, $h = 1024){
    $img = Image::make($file);
    $img->resize($w,$h);
    $img->save($file);
  }

  public function renameLogo(){
    $path = "uploads/logos/";
    $original = "public/uploads/logos/{$this->logo}";
    $new = "public/uploads/logos/{$this->slug}.png";
    // return 
    $img = Image::make($original);
    $img->save($new);
    $this->logo = $this->slug . ".png";
    $this->save();
    unlink($original);
    // if($this->logo && fileexists($path . $this->logo)){
    //   return rename($path.$this->logo, $path.$this->slug.'png');
    // }
    //return $img->save($path . $this->slug . ".png");
  }




  // public function grab_logo($logo_url)
  // { 

  //   $img = Image::make('')
  //   //$file = basename($logo_url);
  //   if (!file_exists("../public/uploads/logos/{$this->slug}")){
      
  //     try 
  //     {
  //       // $this->logo_file_name = $file;
  //       // create the image and save locally. 
  //       $img = Image::make($logo_url);
  //       if($img->save("public/uploads/logos/{$this->slug}")){
  //         $this->logo_file_name = $file;
  //         $this->save();
  //         return true;
  //       }

  //     } catch(\Exception $e){
  //       return 'GrabLogo Exception: ' + $e->getMessage();
  //     } 
  //   }

  //   if($this->logo_file_name != $file){
  //     $this->logo_file_name = $file;
  //     $this->save();
  //     return true;
  //   }

  // }

  


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

  // public function setLogoAttribute($value){
  //   return $this->logo = $value;
  // }


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
  //     // self::reIndex();
  //     // $this->addToIndex();
  //     return true;

  // }

  public static function getFeatured($count){
    // $featured_resources = \App\Resource::whereNotNull('afflink')->orderByRaw("RAND()")->take(5);
    $featured = self::whereNotNull('afflink')->get()->random($count);
    return $featured;
  }

  // search using : eloquence search package.
  public static function searchQuery($q){
    return self::search($q, ['name' => 10, 'representation' => 7, 'description' => 6, 'content' => 5])->get();
  }


  // search using mysql + full text index. 
  public static function mySearch($q){
    $q = $q . "*";
    // return $q;
    $resources = self::whereRaw("MATCH(name, content, description, representation) AGAINST (? IN BOOLEAN MODE)", [$q])->get();
    // $resources = "MATCH(title,body) AGAINST(? IN BOOLEAN MODE)", [$q])->get();
    return $resources;
  }

  // public function next()
  //   {
  //       return $this->where('id', '>', $this->id)->orderBy('id','asc')->first();
  //   }
    
  public function next(){
    //return self::last()->id;
    if($this->id == self::all()->last()->id){

      return self::where('approved', '=', 1)->orderBy('id','asc')->first();
    } else {
      return self::where('approved', '=', 1)->where('id','>',$this->id)->orderBy('id','asc')->first();
    }
    return false;
  }

  public function previous(){
    if($this->id == self::first()->id){
      return self::where('approved', '=', 1)->orderBy('id','desc')->first();
    } else {
      return self::where('approved', '=', 1)->where('id','<',$this->id)->orderBy('id','desc')->first();
    }
    return false;
  }


    // public function previous()
    // {
    //     if($this->first()->id == $this->id){
    //         // $prev = $this->last();
    //     } else {
    //        //  $prev = self::where('id', '<', $this->id)->orderBy('id','desc')->first();
    //     }

    //     // return $prev;
        

  // }

  public function getUrl($type){
    
    if($type === "out"){
      $url = "/out/{$this->slug}";
    }
    if($type === "internal"){
      $url = "/resource/{$this->slug}";
    }

    if($type === "logo"){
      $url = "/uploads/logos/{$this->logo}";
    }

    if($type === "featured_image"){
      $url = "/uploads/sites/{$this->featured_image}";
    }

    
    if($type === "facebook"){
      if(isset($this->facebook) && $this->facebook){
        $url = $this->facebook;
      }
    }
    if($type === "twitter"){
      if(isset($this->twitter) && $this->twitter){
        $url = $this->twitter;
      }
    }

    if(isset($url) && $url){
      return $url;
    }

    return false;
  }
 


}
