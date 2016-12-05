<?php
namespace App\Libraries;

/**
* Class for reading rss
*/
class RssFinder
{
	
	public static function read($feed)
	{
		$xml_string = file_get_contents($feed);
		$xml_string = str_replace("dc:creator", 'author', $xml_string);
		$xml_string = str_replace('media:content', 'media', $xml_string);

		$xml = simplexml_load_string($xml_string);

		$result = (object) [];
		$result->site = (object) [
			'title'	=> (string) $xml->channel->title,
			'link' 	=> static::getDomainUrl((string) $xml->channel->link),
			'description' => (string) $xml->channel->description[0],
			'feed_url' => $feed,
			'last_synced' => (string) \Carbon\Carbon::parse((string) $xml->channel->lastBuildDate)
		];

		$result->articles = [];

		foreach ($xml->channel->item as $key => $entry) {
			$result->articles[] = (object) [
				'title' => (string) $entry->title,
				'link'  => (string) $entry->link,
				'description' => (string) $entry->description,
				'author' => (string) $entry->author,
				'pub_date' => (string) \Carbon\Carbon::parse((string) $entry->pubDate)
			];
		}
		return $result;
	}

	private static function getDomainUrl($url)
	{
		$url .= "/ssdf/sada/adsfasdf";
		preg_match("/(https:\/\/|http:\/\/)(www\.)?([a-zA-Z\-\_0-9\]+\.[a-z]+)/i", $url, $results);
		// return [$url, $results];
		return $results[0];
	}
}