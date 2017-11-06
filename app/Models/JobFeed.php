<?php
namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use JobBrander\Jobs\Client\Providers\Indeed;
use JobBrander\Jobs\Client\Providers\Dice;
class JobFeed extends Model implements SluggableInterface
{
    use SluggableTrait;
    //
    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug'
    ];

    // protected $diceClient = new Dice();
    protected function diceClient()
    {
        return new Dice();
    }

    protected function indeedClient()
    {
        return new Indeed([
            'publisher' => env('INDEED_KEY'),
            'v'         => 2,
            'highlight' => 0
        ]);
    }

    // public function getIndeedClientAttribute(){
    //   $indeed = new Indeed([
    //   'publisher' => env('INDEED_KEY'),
    //   'v' => 2,
    //   'highlight' => 0,
    //   ]);
    //   return $indeed;
    // }
    // protected $simplyHiredClient = new Simplyhired([

    //   ]);

    public function indeed($keyword = "", $location = "", $sortBy = "relevance", $radius = '100')
    {

        $jobs = $this->indeedClient()
                     ->setKeyword('software developer')
                     // Query. By default terms are ANDed. To see what is possible, use the [advanced search page](http://www.indeed.com/advanced_search) to perform a search and then check the url for the q value.
                     ->setFormat('json')
                     // Format. Which output format of the API you wish to use. The options are "xml" and "json". If omitted or invalid, the json format is used.
                     ->setCity('Chicago')
                     // City.
                     ->setState('IL') // State.
                     ->setLocation('Chicago, IL') // Location. Use a postal code or a "city, state/province/region" combination. Will overwrite any changes made using setCity and setState
                     ->setSort('date') // Sort by relevance or date. Default is relevance.
                     ->setRadius('100') // Distance from search location ("as the crow flies"). Default is 25.
                     ->setSiteType('jobsite') // Site type. To show only jobs from job boards use "jobsite". For jobs from direct employer websites use "employer".
                     ->setJobType('fulltime') // Job type. Allowed values: "fulltime", "parttime", "contract", "internship", "temporary".
                     ->setPage(2) // Start results at this result number, beginning with 0. Default is 0.
                     ->setCount(200) // Maximum number of results returned per query. Default is 10
                     ->setDaysBack(10) // Number of days back to search.
                     ->filterDuplicates(false) // Filter duplicate results. 0 turns off duplicate job filtering. Default is 1.
                     ->includeLatLong(true) // If latlong=1, returns latitude and longitude information for each job result. Default is 0.
                     ->setCountry('us') // Search within country specified. Default is us.
                     ->setChannel('channel-one') // Channel Name: Group API requests to a specific channel
                     // ->setUserIp($_SERVER['REMOTE_ADDR'])            // The IP number of the end-user to whom the job results will be displayed.
                     // ->setUserAgent($_SERVER['HTTP_USER_AGENT'])     // The User-Agent (browser) of the end-user to whom the job results will be displayed.
                     ->getJobs();

        return $jobs;

    }

// public function simplyHired(){

// }

    public function dice()
    {
        return $this->diceClient()->setKeyword('project manager')->setCount(200)->getJobs();
    }

    public function jobs()
    {
        $d = $this->dice()->toArray();
        $i = $this->indeed()->toArray();
        $jobs = array_merge($d, $i);
        return $jobs;
    }
}
