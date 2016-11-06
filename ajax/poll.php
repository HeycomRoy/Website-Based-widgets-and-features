<?php
function processVote()
{	
	global $yes, $no;
	$vote = $_GET['q'];
	$filename = "pollResult.txt";
	$content = file($filename); 		//  gets contents of file and returns an array 
	$voteArray = explode("||", $content[0]);
	$yes = $voteArray[0];
	$no =  $voteArray[1];
	if ($vote == 0) {
		$yes++;
	}
	if ($vote == 1) {
		$no++;
	}
	$insertvote = $yes."||".$no;
	$fp = fopen($filename,"w");
	fputs($fp, $insertvote);
	fclose($fp);
}

function displayResult()
{
	global $yes, $no;
	$percentYes = round($yes / ($yes + $no), 2) * 100;
	$percentNo = round($no / ($yes + $no), 2) * 100;
	$html = '<h2>Result:</h2>'."\n";
	$html .= '<table>'."\n";
	$html .= '<tr><td>Yes: </td><td><img src="poll.gif" width="'.$percentYes.'" height="20"> '.$percentYes.'%</td></tr>'."\n";
	$html .= '<tr><td>No: </td><td><img src="poll.gif" width="'.$percentNo.'" height="20"> '.$percentNo.'%</td></tr>'."\n";
	$html .= '</table>'."\n";
	echo $html;
}

processVote();
displayResult();

?>