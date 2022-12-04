<?php
	$file = fopen('input.txt', 'r') or die('File error');

	$total = 0;
	while(!feof($file)) {
		$line = trim(fgets($file));
		$range = explode(',', $line);
		$range1 = explode('-', $range[0]);
		$range2 = explode('-', $range[1]);

		if ($range1[0] >= $range2[0] && $range1[0] <= $range2[1]) {
			$total++;
		} else if ($range1[1] >= $range2[0] && $range1[1] <= $range2[1]) {
			$total++;
		} else if ($range2[0] >= $range1[0] && $range2[0] <= $range1[1]) {
			$total++;
		} else if ($range2[1] >= $range1[0] && $range2[1] <= $range1[1]) {
			$total++;
		}
	}
	echo $total;
	fclose($file);