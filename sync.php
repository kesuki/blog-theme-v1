<?php
/*
Theme Name: theme
Version: 4
File Name: sync.php
*/
?>
<?php
	$doc = new DOMDocument();
	$doc->load('http://kesuki.sitemix.jp/twip/o/cccching/statuses/home_timeline.xml');
	//$doc->load('http://localhost/~ching/home_timeline.xml');
	$arrFeeds = array();
	
	$wor = '';
	$hey = '1';	
	foreach ($doc->getElementsByTagName('status') as $node) {
		$name=$node->getElementsByTagName('name')->item(0)->nodeValue;
		$temp=$node->getElementsByTagName('text')->item(0)->nodeValue;
		$doc=$node->getElementsByTagName('description')->item(0)->nodeValue;
		$img=$node->getElementsByTagName('profile_image_url')->item(0)->nodeValue;
		$created_at=$node->getElementsByTagName('created_at')->item(0)->nodeValue;
		$created_at_time=mb_strimwidth($created_at,0,19);
		if ($hey == '1') {
			$wor = $wor .'<span>';
			$hey = '2';
		} else {
			$wor = $wor .'<span style="display:none">';
		}
		$wor = $wor .'<p class="image-pre"><img src="'. $img. '">'. $name .'<br>'. $created_at_time .'</p>';
		$wor = $wor .'<p class="right" target="_blank" title="Twitter">Twitter</p>';
		$wor = $wor .'<div class="clear"></div>';
		$wor = $wor .'<a class="tweet" title="Click to see next tweet">'. $temp . '</a>';
		$wor = $wor .'<a class="preview" >'. '简介：' . $doc . '</a>';
		$wor = $wor .'</span>';
	}
	
	if (strlen($wor) > 100) {
	
		$fp=fopen("mak.php",'w');
		fwrite($fp,$wor);
		fclose($fp);
		echo "done";
	} else {
	
		$fp=fopen("error_log",'w');
		fwrite($fp,"none");
		fclose($fp);
		echo "clear";
	}
?>