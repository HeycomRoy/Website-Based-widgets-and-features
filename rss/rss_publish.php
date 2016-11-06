<?php
	$posts = array(
		array(
			"title"=>"GeekZone",
			"link"=>"http://feeds.feedburner.com/geekzone",
			"description"=>"GeekZone: IT, mobility, wireless and handheld news"),
		array(
			"title"=>"Technozone",
			"link"=>"http://feeds.feedburner.com/technozone",
			"description"=>"A network of feeds from IT news and technology bloggers"),
		array(
			"title"=>"Yahoo! Movies",
			"link"=>"http://rss.ent.yahoo.com/movies/thisweek.xml",
			"description"=>"GeekZone: IT, mobility, wireless and handheld news"));	
	/* echo '<pre>';
	print_r($posts);
	echo '</pre>'; */

	$doc = new DOMDocument('1.0', 'UTF-8');
	$rss = $doc->createElement('rss');
	$rss->setAttribute('version','2.0');
	$doc->appendChild($rss);
	
	$channel = $doc->createElement('channel');
	$channelTitle = $doc->createElement('title','Sample RSS 2.0 Feeds');
	$channelLink = $doc->createElement('link','http://example.com');
	$channelDesc = $doc->createElement('description','Sample RSS 2.0 Feeds');
	$channel->appendChild($channelTitle);
	$channel->appendChild($channelLink);
	$channel->appendChild($channelDesc);
	$rss->appendChild($channel);
	
	foreach($posts as $post) {
		$item = $doc->createElement('item');
		$itemTitle = $doc->createElement('title',$post['title']);
		$itemLink = $doc->createElement('link',$post['link']);
		$itemDesc = $doc->createElement('description',$post['description']);
		$item->appendChild($itemTitle);
		$item->appendChild($itemLink);
		$item->appendChild($itemDesc);
		$channel->appendChild($item);
	}
	$doc->formatOutput = true;
	$str = $doc->saveXML();
	header('Content-type:text/xml');   //  tells browser that document rendered is xml
	echo $str;
	
	$file = fopen("rss.xml", "w");
	fwrite($file, $str);
	fclose($file);
	
?>