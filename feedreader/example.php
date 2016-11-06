<?php

require 'FeedReader.php';
require 'includes.php';

$stream = stream_context_create(array(
	'http' => array(
		'header' => 'Proxy-Authorization: Basic '.base64_encode('username:password'),
		'proxy' => 'tcp://10.60.10.2:3128',
		'request_fulluri' => true
	)
));

$config = array(
	'feed' => 'http://twitter.com/status/user_timeline/brad.xml',
	'cache_dir' => 'cache',
	'cache_time' => 900, // 15 minutes
	'stream' => $stream
);

$reader = new FeedReader($config);
$twitter = $reader->getXML();

$config['feed'] = 'http://ws.audioscrobbler.com/2.0/?method=user.getartisttracks&user=rj&artist=metallica&api_key=b25b959554ed76058ac220b7b2e0a026';

$reader = new FeedReader($config);
$lastfm = $reader->getXML();

?>
<!DOCTYPE html>
<html>
<head>
	<title>FeedReader</title>
	<meta charset="utf-8">
	<style>
		body {
			font: 12px/1.5 'Lucida Grande', Verdana, sans-serif;
		}
		
		ul {
			margin: 0 0 1.5em;
			padding: 0;
			list-style: none;
		}
		
		li {
			clear: both;
		}
		
		.meta {
			font-size: 11px;
			color: #666;
		}
		
		img {
			float: left;
			margin: 0 10px 5px 0;
		}
	</style>
</head>
<body>
	<h2>Twitter</h2>
	<ul>
		<?php for ($i = 0; $i < 5; $i++): ?>
		<li>
			<p><?php echo $twitter->status[$i]->text; ?><br>
			<span class="meta"><?php echo time_since(strtotime($twitter->status[$i]->created_at)); ?></span></p>
		</li>
		<?php endfor; ?>
	</ul>
	<h2>Last.fm</h2>
	<ul>
		<?php for ($i = 0; $i < 5; $i++): ?>
		<li>
			<img src="<?php echo $lastfm->artisttracks->track[$i]->image[1]; ?>" width="60" height="60">
			<p><strong><?php echo $lastfm->artisttracks->track[$i]->name; ?></strong><br>
			<?php echo $lastfm->artisttracks->track[$i]->artist; ?><br>
			<span class="meta"><?php echo time_since(strtotime($lastfm->artisttracks->track[$i]->date)); ?></span></p>
		</li>
		<?php endfor; ?>
	</ul>
</body>
</html>