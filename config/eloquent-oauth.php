<?php

return [
	'table' => 'oauth_identities',
	'providers' => [
		'facebook' => [
			'client_id' => '1083480738331568',
			'client_secret' => '2bff41cdc077cc5cf4e02dde9a9cc3a3',
			'redirect_uri' => 'http://start.dev/facebook/login',
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
