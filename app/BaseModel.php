<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Factory;
//use \Validator;
class BaseModel extends Model
{

    protected $rules = array();


    protected $errors;

    public function validate($data)
    {
        // make a new validator object
        $v = \Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->errors();
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

    // Check if valid url
    public function is_url($url){
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            return false;
        }
        return true;
    }

    // Check if url redirects, screenshots fail sometimes if using http on https or vice versa. 

    public function getUrl($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_exec($ch);
        $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);
        return $url;
    }

       

    protected static function contains($needle, $haystack)
    {
        return strpos($haystack, $needle) !== false;
    }


    // Validator::extend('alpha_spaces', function($attribute, $value, $parameters)
    // {
    //     return preg_match('/^[\pL\s]+$/u', $value);
    // });

    // \Validator::extend('alpha_spaces', function($attribute, $value, $parameters)
    // {
    //     return preg_match('/^[\pL\s]+$/u', $value);
    // });
// }


}