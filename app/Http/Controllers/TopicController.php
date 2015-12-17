<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Resource;
use App\Topic;
class TopicController extends Controller
{
	public function getTopic($slug)
	{
		$topic = Topic::findBySlug($slug);
		return view('topics.show')->with('topic', $topic);
	}
}