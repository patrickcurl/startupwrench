<?php

return [
	'table' => 'oauth_identities',
	'providers' => [
		'facebook' => [
			'client_id' => env("FB_CLIENT_ID"),
			'client_secret' => env("FB_CLIENT_SECRET"),
			'redirect_uri' => env("FB_REDIRECT_LOGIN"),
			'scope' => [],
		],
		'google' => [
			'client_id' => '12345678',
			'client_secret' => 'y0ur53cr374ppk3y',
			'redirect_uri' => 'https://example.com/your/google/redirect',
			'scope' => [],
		],
		'github' => [
			'client_id' => '12345678',
			'client_secret' => 'y0ur53cr374ppk3y',
			'redirect_uri' => 'https://example.com/your/github/redirect',
			'scope' => [],
		],
		'linkedin' => [
			'client_id' => '12345678',
			'client_secret' => 'y0ur53cr374ppk3y',
			'redirect_uri' => 'https://example.com/your/linkedin/redirect',
			'scope' => [],
		],
		// 'instagram' => [
		// 	'client_id' => '12345678',
		// 	'client_secret' => 'y0ur53cr374ppk3y',
		// 	'redirect_uri' => 'https://example.com/your/instagram/redirect',
		// 	'scope' => [],
		// ],
		// 'soundcloud' => [
		// 	'client_id' => '12345678',
		// 	'client_secret' => 'y0ur53cr374ppk3y',
		// 	'redirect_uri' => 'https://example.com/your/soundcloud/redirect',
		// 	'scope' => [],
		// ],
	],
];
