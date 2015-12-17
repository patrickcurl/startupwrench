<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Resource;
use App\Topic;
class SitemapController extends Controller
{

	public function getSitemap(){
		$sitemap = \App::make("sitemap");
    $sitemap->setCache('laravel.sitemap-index', 3600);
    $sitemap->addSitemap(url('/sitemap-pages'));
    $sitemap->addSitemap(url('/sitemap-topics'));
    $sitemap->addSitemap(url('/sitemap-resources'));

    return $sitemap->render('sitemapindex');
	}

	public function getSitemapResources(){
		$sitemap_resources = \App::make("sitemap");
		// set cache
	  $sitemap_resources->setCache('laravel.sitemap-resources', 3600);

    // add items
    $resources = \DB::table('resources')->orderBy('created_at', 'desc')->get();

    foreach ($resources as $resource)
    {
      $sitemap_resources->add($resource->slug, $resource->updated_at, '.9', 'daily');
    }

    // show sitemap
    return $sitemap_resources->render('xml');
	}

	public function getSitemapTopics()
	{
		// create sitemap
    $sitemap_topics = \App::make("sitemap");

    // set cache
    $sitemap_topics->setCache('laravel.sitemap-topics', 3600);

    // add items
    $topics = \DB::table('topics')->orderBy('created_at', 'desc')->get();

    foreach ($topics as $topic)
    {
        $sitemap_topics->add($topic->slug, $topic->updated_at, '.9', 'daily');
    }

    // show sitemap
    return $sitemap_topics->render('xml');
	}

	public function getSitemapPages()
	{
		$sitemap = \App::make("sitemap");
    $sitemap->setCache('laravel.sitemap-pages', 3600);
    if (!$sitemap->isCached())
    {
        $sitemap->add(url('/'), \Carbon\Carbon::now(), '1.0', 'weekly');
    }

    return $sitemap->render('xml');
	}


}