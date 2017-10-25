<?php
	if(!empty($_GET["word"]) &&  !empty($_GET["pos"])){
		$string = file_get_contents("result.json");
		$result = json_decode($string, true);
		if(!isset($result[$_GET["word"]]))
			$result[$_GET["word"]] = array();
		if(!isset($result[$_GET["word"]][$_GET["pos"]]))
		$result[$_GET["word"]][$_GET["pos"]] = 0;
		echo $result[$_GET["word"]][$_GET["pos"]] = $result[$_GET["word"]][$_GET["pos"]]  +1;
		$fp = fopen('result.json', 'w');
		fwrite($fp, json_encode($result));
		fclose($fp);
	}

?>
