<?php 
Route::get(Config::get('joblistings.route'), 'JobListingsController@getJobs');
