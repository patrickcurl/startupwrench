<?php namespace JobBrander\Jobs\Client\Providers;

use GuzzleHttp\Client as HttpClient;
use JobBrander\Jobs\Client\AttributeTrait;
use JobBrander\Jobs\Client\Collection;

/**
 * @method string getKeyword()
 * */
abstract class AbstractProvider
{
    use AttributeTrait;

    /**
     * City
     *
     * @var string
     */
    protected $city = null;

    /**
     * Http client
     *
     * @var HttpClient
     */
    private $client;

    /**
     * Count
     *
     * @var integer
     */
    protected $count = 10;

    /**
     * Keyword
     *
     * @var string
     */
    protected $keyword = null;

    /**
     * Page
     *
     * @var integer
     */
    protected $page = 1;

    /**
     * State
     *
     * @var string
     */
    protected $state = null;

    /**
     * Create new client
     *
     * @param array $parameters
     */
    public function __construct($parameters = [])
    {
        array_walk($parameters, function ($value, $key) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        });

        $this->setClient(new HttpClient);
    }

    /**
     * Returns the standardized job object
     *
     * @param array|object $payload
     *
     * @return \JobBrander\Jobs\Client\Job
     */
    abstract public function createJobObject($payload);

    /**
     * Get format
     *
     * @return  string Currently only 'json' and 'xml' supported
     */
    abstract public function getFormat();

    /**
     * Get source attribution
     *
     * @return string
     */
    public function getSource()
    {
        return $this->getShortName();
    }

    /**
     * Get http client options based on current client
     *
     * @return array
     */
    public function getHttpClientOptions()
    {
        $options = [];
        if (strtolower($this->getVerb()) != 'get') {
            $options['body'] = $this->getParameters();
        }

        return $options;
    }

    /**
     * Makes the api call and returns a collection of job objects
     *
     * @return  JobBrander\Jobs\Client\Collection
     */
    public function getJobs()
    {
        $client = $this->client;
        $verb = strtolower($this->getVerb());
        $url = $this->getUrl();
        $options = $this->getHttpClientOptions();

        $response = $client->{$verb}($url, $options);

        $body = (string) $response->getBody();

        $payload = $this->parseAsFormat($body, $this->getFormat());

        $listings = is_array($payload) ? $this->getRawListings($payload) : [];

        return $this->getJobsCollectionFromListings($listings);
    }

    /**
     * Create and get collection of jobs from given listings
     *
     * @param  array $listings
     *
     * @return Collection
     */
    protected function getJobsCollectionFromListings(array $listings = array())
    {
        $collection = new Collection;

        array_map(function ($item) use ($collection) {
            $job = $this->createJobObject($item);
            $job->setQuery($this->getKeyword())
                ->setSource($this->getSource());
            $collection->add($job);
        }, $listings);

        return $collection;
    }

    /**
     * Get listings path
     *
     * @return  string
     */
    abstract public function getListingsPath();

    /**
     * Get parameters
     *
     * @return  array
     */
    public function getParameters()
    {
        return [];
    }

    /**
     * Get raw listings from payload
     *
     * @param  array $payload
     *
     * @return array
     */
    protected function getRawListings(array $payload = array())
    {
        $path = $this->getListingsPath();

        if (!empty($path)) {
            $index = explode('.', $path);

            return (array) self::getValue($index, $payload);
        }

        return (array) $payload;
    }

    /**
     * Get short name of a given or current class
     *
     * @param  object $object Optional object
     *
     * @return string
     */
    private function getShortName($object = null)
    {
        if (is_null($object)) {
            $object = $this;
        }

        $ref = new \ReflectionClass(get_class($object));

        return $ref->getShortName();
    }

    /**
     * Get url
     *
     * @return  string
     */
    abstract public function getUrl();

    /**
     * Navigate through a payload array looking for a particular index
     *
     * @param array $index The index sequence we are navigating down
     * @param array $value The portion of the config array to process
     *
     * @return mixed
     */
    protected static function getValue($index, $value)
    {
        $current_index = self::getValueCurrentIndex($index);

        if (isset($value[$current_index])) {
            $index_array = self::isArrayNotEmpty($index);
            $value_array = self::isArrayNotEmpty($value[$current_index]);

            if ($index_array && $value_array) {
                return self::getValue($index, $value[$current_index]);
            } else {
                return $value[$current_index];
            }
        } else {
            throw new \OutOfRangeException("Attempt to access missing variable: $current_index");
        }
    }

    /**
     * Get value current index
     *
     * @param  mixed $index
     *
     * @return array|null
     */
    private static function getValueCurrentIndex(&$index)
    {
        return is_array($index) && count($index) ? array_shift($index) : null;
    }

    /**
     * Get http verb to use when making request
     *
     * @return  string
     */
    abstract public function getVerb();

    /**
     * Checks if given value is an array and that it has contents
     *
     * @param  mixed $array
     *
     * @return boolean
     */
    private static function isArrayNotEmpty($array)
    {
        return is_array($array) && count($array);
    }

    /**
     * Parse job attributes against defaults
     *
     * @param  array $attributes
     * @param  array $defaults
     *
     * @return array
     */
    public static function parseAttributeDefaults(array $attributes, array $defaults = array())
    {
        array_map(function ($attribute) use (&$attributes) {
            if (!isset($attributes[$attribute])) {
                $attributes[$attribute] = null;
            }
        }, $defaults);

        return $attributes;
    }

    /**
     * Attempt to parse string as given format
     *
     * @param  string  $string
     * @param  string  $format
     *
     * @return array
     */
    private function parseAsFormat($string, $format)
    {
        $method = 'parseAs'.ucfirst(strtolower($format));

        if (method_exists($this, $method)) {
            return $this->$method($string);
        }

        return [];
    }

    /**
     * Attempt to parse as Json
     *
     * @param  string $string
     *
     * @return array
     */
    private function parseAsJson($string)
    {
        try {
            $json = json_decode($string, true);

            if (json_last_error() != JSON_ERROR_NONE) {
                throw new \Exception;
            }

            return $json;
        } catch (\Exception $e) {
            // Ignore malformed json.
        }

        return [];
    }

    /**
     * Attempt to parse as XML
     *
     * @param  string $string
     *
     * @return array
     */
    private function parseAsXml($string)
    {
        try {
            return json_decode(
                json_encode(
                    simplexml_load_string(
                        $string,
                        null,
                        LIBXML_NOCDATA
                    )
                ),
                true
            );
        } catch (\Exception $e) {
            // Ignore malformed xml.
        }

        return [];
    }

    /**
     * Parse location string into components.
     *
     * @param string $location
     * @return  array
     **/
    public static function parseLocation($location, $separator = ', ')
    {
        return explode($separator, $location);
    }

    /**
     * Sets http client
     *
     * @param HttpClient $client
     *
     * @return  AbstractClient
     */
    public function setClient(HttpClient $client)
    {
        $this->client = $client;

        return $this;
    }
}
