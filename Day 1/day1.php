<?php
	if ($file = fopen("input.txt", "r")) {
		$top = 0;
		$value = 0;
		while(!feof($file)) {
		    $line = fgets($file);
		    if (is_numeric($line)) {
		    	$value += $line;
		    } else {
		    	if ($value > $top) {
		    		$top = $value;
		    	}
	    		$value = 0;
		    }
		}
		echo $top;
		fclose($file);
	}