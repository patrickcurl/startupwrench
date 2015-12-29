<?php 

return [
	'route' => 'jobs',
	'path' => '/jobs',
	'categories' => ['Accounting', 'Developer', 'Engineering', 'Software', 'Marketing', 'Networking', 'Startup', 'Technology', 'Tech Support'],
	'layout' => 'layouts.jobs', // Layout that job listings should extend
	'indeed' => [
		'enabled' => true,
		'id' => env('INDEED_KEY', 'putkeyhere'), // put publisher id here. 
	],
	'simplyhired' => [
		'enabled' => false,
		'auth' => env('SH_AUTH_KEY', 'putkeyhere'), // SimplyHired Auth Key
		'id' => env('SH_PUB_ID', 'putkeyhere'), // SimplyHired PubID
	],
	'dice' => [
		'enabled' => true,
	]
];