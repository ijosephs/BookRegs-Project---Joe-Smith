<?php
/**
 * Description of BookRagsLib
 *
 * Joe Smith
 * 
   
 */
class RSSFeed {
    function __construct(){
    $xml ="http://www.tuaw.com/rss.xml";
    //$xml="http://www.ijosephs.com/feed/";
      $xmlObject = new HandleRSS();
      $xmlObject->displayRSS($xml);
     
   
    }
}

class HandleRSS{
    function displayRSS($xml){
        
        
	$rss = new DOMDocument();
	$rss->load($xml);
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
	$this->placeRss($feed);
        
       
    }
    function placeRss($feed){
        $maxlimit=sizeof($feed);
        $limit = 9;
        if($limit >$maxlimit+1){
            $limit=$maxlimit;
        }
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
		$link = $feed[$x]['link'];
		$description = $feed[$x]['desc'];
                $short_description = substr($description, 0, 525);
		$date = date('l F d, Y', strtotime($feed[$x]['date']));
                $count = $x+1;
                switch ($x){
                    case 0:
                        $column = 1;
                        echo "<div id='div1' class='ltcol'>";
                        echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
                        echo '<small><em>Posted on '.$date.'</em></small></p>';
                        echo '<p>'.$count.'::'.$short_description.'</p>';
                        break;
                    case 3:
                    case 6:
                        $column = 1;
                        echo "</div><div id='div1' class='ltcol'>";
                        echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
                        echo '<small><em>Posted on '.$date.'</em></small></p>';
                        echo '<p>'.$count.'::'.$short_description.'</p>';
                        break;
                    case 1:
                    case 4:
                    case 7:
                        $column = 2;
                        echo "</div><div id='div2' class='ctcol'>";
                        echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
                        echo '<small><em>Posted on '.$date.'</em></small></p>';
                        echo '<p>'.$count.'::'.$short_description.'</p>';
                        break;
                    case 2:
                    case 5:
                    case 8:
                        $column = 3;
                        echo "</div><div id='div3' class='rtcol'>";
                        echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
                        echo '<small><em>Posted on '.$date.'</em></small></p>';
                        echo '<p>'.$count.'::'.$short_description.'</p>';
                        break;
                     
                }
	}
     
    }
    
}
