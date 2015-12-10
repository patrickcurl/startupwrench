#!/usr/bin/ruby
gem 'mechanize'
gem 'httparty'
require 'httparty'
require 'mechanize'
require 'open-uri'
require 'uri'
require 'pry'

# page = HTTParty.get('https://newyork.craigslist.org/search/pets?s=0')



mechanize = Mechanize.new

# page = mechanize.get('http://startupstash.com/company-sitemap.xml')
links = Array.new
links = IO.readlines 'links.txt'
# puts links
mechanize.user_agent_alias = 'Mac Safari'
count = 0
links.each do |l| 
	page = mechanize.get(l)
	# puts page.title

	site = {
		'name' => page.at('.company-page-title > h1').text.strip,
		'categories' => page.at('.company-page-categories > a').text.strip,
		'representation' => page.at('.company-page-representation').text.strip,
		'description' => page.at('.company-page-description').text.strip,
		'content' => page.at('.company-page-body').text.strip.gsub("\n", "<br />"),
		'url' => page.at('.button-default').text.strip.downcase,
		'facebook' => URI.extract(page.at('.facebook').to_s).first,
 		'twitter' => URI.extract(page.at('.twitter').to_s).first,
		'logo' => URI.extract(page.at('.wp-post-image').to_s).first
 	}
 	open('sites.txt', 'a') do |f| 
 		f << site
 	end
 	count = count+1
 	puts count
 end


# Test case

# page = mechanize.get(links.first)
# 	# puts page.title

# 	site = {
# 		'name' => page.at('.company-page-title > h1').text.strip,
# 		'categories' => page.at('.company-page-categories > a').text.strip,
# 		'representation' => page.at('.company-page-representation').text.strip,
# 		'description' => page.at('.company-page-description').text.strip,
# 		'content' => page.at('.company-page-body').text.strip.gsub("\n", "<br />"),
# 		'url' => page.at('.button-default').text.strip.downcase,
# 		'facebook' => URI.extract(page.at('.facebook').to_s).first,
# 		'twitter' => URI.extract(page.at('.twitter').to_s).first,		
# 		'logo' => URI.extract(page.at('.wp-post-image').to_s).first
# 	}
# 	puts site




# Pry.start(binding)