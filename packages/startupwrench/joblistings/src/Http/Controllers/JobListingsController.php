<?php 
namespace StartupWrench\JobListings\Http\Controllers;

use App\Http\Controllers\Controller;
use JobBrander\Jobs\Client\Providers\Indeed;
use JobBrander\Jobs\Client\Providers\Dice;
class JobListingsController extends Controller {

	public function getJobs(){
		// Defaults
		$data = [
			'keyword' => 'developer',
			'location' => 'Chicago, IL',
			'city' => 'Chicago',
			'state' => 'IL',
			'sort' => 'relevance',
			'radius' => '100',
			'page' => 0,
			'count' => 200,
			'days' => 20
		];
		$indeed = $this->indeed($data)->all();
		$dice = $this->dice($data)->all();
		
		$jobs = [];
		foreach($indeed as $i){
		 	$jobs[] = [
		 		'company' => $i->company,
		 		'date' => $i->datePosted,
		 		'description' => $i->description,
		 		'location' => $i->location,
		 		'source' => "Indeed",
		 		'name' => $i->name,
		 		'url' => $i->url
		 	];
		}
		foreach($dice as $d){
			$jobs[] = [
			'company' => $d->company,
		 		'date' => $d->datePosted,
		 		'description' => $d->description,
		 		'location' => $d->location,
		 		'source' => "Dice",
		 		'name' => $d->name,
		 		'url' => $d->url
			];
		}
		$name = 'date';
		$jobs = collect($jobs)->sortByDesc('date');
		// return var_dump($collection->toArray());
   	

		return view('joblistings::index', ['indeed' => $indeed, 'jobs' => $jobs, 'dice' => $dice]	);
	}

	
	private function dice($data){
		$client = new Dice();

		$jobs = $client
	    // API parameters
	    ->setDirect()    //  (optional) if the value of this parameter is "1" then jobs returned will be direct hire
	    ->setAreacode()    //  (optional) specify the jobs area code
	    ->setCountry()    //  (optional) specify the jobs ISO 3166 country code
	    ->setState($data['state'])    //  (optional) specify the jobs United States Post Office state code
	    ->setSkill()    //  (optional) specify search text for the jobs skill property
	    ->setCity($data['city'])    //  (optional) specify the jobs United States Post Office ZipCode as the center of 40 mile radius
	    ->setText()    //  (optional) specify search text for the jobs entire body
	    ->setIp()    //  (optional) specify an IP address that will be used to look up a geocode which will be used in the search
	    ->setAge()    //  (optional) specify a posting age (a.k.a. days back)
	    ->setDiceid()    //  (optional) specify a Dice customer ID to find only jobs from that company
	    ->setPage()    //  (optional) specify a page number of the results to be displayed (1 based)
	    ->setPgcnt()    //  (optional) specify the number of results per page
	    ->setSort()    //  (optional) specify a sort paremeter; sort=1 sorts by posted age, sort=2 sorts by job title, sort=3 sorts by company, sort=4 sorts by location
	    ->setSd()    //  (optional) sort direction; sd=a sort order is ASCENDING sd=d sort order is DESCENDING
	    // JobBrander parameters
	    ->setKeyword($data['keyword']) // The search text/keywords for the jobs entire body
	    ->setCount(200)         // Specify the number of results per page
	    ->getJobs();
	    return $jobs;
	}

	private function indeed($data){
		$client = new Indeed([
			'publisher' => \Config::get('joblistings.indeed.id'),
			'v'			=> 2,
			'highlight' => 0,
				]);

		$jobs = $client
    ->setKeyword($data['keyword'])                 // Query. By default terms are ANDed. To see what is possible, use the [advanced search page](http://www.indeed.com/advanced_search) to perform a search and then check the url for the q value.
    ->setFormat('json')                             // Format. Which output format of the API you wish to use. The options are "xml" and "json". If omitted or invalid, the json format is used.
    // ->setCity('Chicago')                            // City.
    // ->setState('IL')                                // State.
    ->setLocation($data['location'])                    // Location. Use a postal code or a "city, state/province/region" combination. Will overwrite any changes made using setCity and setState
    ->setSort($data['sort'])                               // Sort by relevance or date. Default is relevance.
    ->setRadius($data['radius'])                              // Distance from search location ("as the crow flies"). Default is 25.
    // ->setSiteType('jobsite')                        // Site type. To show only jobs from job boards use "jobsite". For jobs from direct employer websites use "employer".
    // ->setJobType('fulltime')                        // Job type. Allowed values: "fulltime", "parttime", "contract", "internship", "temporary".
    ->setPage($data['page'])                                    // Start results at this result number, beginning with 0. Default is 0.
    ->setCount($data['count'])                                 // Maximum number of results returned per query. Default is 10
    ->setDaysBack($data['days'])                               // Number of days back to search.
    // ->filterDuplicates(false)                       // Filter duplicate results. 0 turns off duplicate job filtering. Default is 1.
    // ->includeLatLong(true)                          // If latlong=1, returns latitude and longitude information for each job result. Default is 0.
    // ->setCountry('us')                              // Search within country specified. Default is us.
    // ->setChannel('channel-one')                     // Channel Name: Group API requests to a specific channel
    // ->setUserIp($_SERVER['REMOTE_ADDR'])            // The IP number of the end-user to whom the job results will be displayed.
    // ->setUserAgent($_SERVER['HTTP_USER_AGENT'])     // The User-Agent (browser) of the end-user to whom the job results will be displayed.
    ->getJobs();

    return $jobs;

	}

}