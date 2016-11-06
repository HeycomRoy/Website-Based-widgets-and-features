<?php

function time_since($time)
{
	$delta = time() - $time;
	
	if ($delta < 1) {
		return 'about 1 second ago';
	} else if ($delta < 60) {
		return floor($delta).' seconds ago';
	} else if ($delta < 120) {
		return 'about 1 minute ago';
	} else if ($delta < 3600) {
		return floor($delta / 60).' minutes ago';
	} else if ($delta < 7200) {
		return 'about 1 hour ago';
	} else if ($delta < 86400) {
		return floor($delta / 3600).' hours ago';
	} else if ($delta < 172800) {
		return 'about 1 day ago';
	} else if ($delta < 2592000) {
		return floor($delta / 86400).' days ago';
	} else if ($delta < 5184000) {
		return 'about 1 month ago';
	} else if ($delta < 31104000) {
		return floor($delta / 2592000).' months ago';
	} else if ($delta < 62208000) {
		return 'about 1 year ago';
	} else {
		return floor($delta / 31104000).' years ago';
	}
}

?>