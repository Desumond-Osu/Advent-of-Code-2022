<?php
	if ($file = fopen("input.txt", "r")) {
		$sum = [];
		$value = 0;
		while(!feof($file)) {
		    $line = fgets($file);
		    if (is_numeric($line)) {
		    	$value += $line;
		    } else {
		    	array_push($sum, $value);
	    		$value = 0;
		    }
		}
		rsort($sum);
		echo 'Top 1 > ' . $sum[0];
		echo "<br/>";
		echo 'Top 3 > ' . $sum[0] + $sum[1] + $sum[2];
		fclose($file);
	}