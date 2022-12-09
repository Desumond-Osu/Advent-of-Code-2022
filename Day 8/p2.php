<?php
	$file = fopen('input.txt', 'r') or die('File error');

	$i = 0;
	while(!feof($file)) {
		$line[$i++] = str_split(trim(fgets($file)));
	}

	$totalList = [];
	$buffer = [];
	$counter = 0;
	$top = 0;
	$bottom = 0;
	$left = 0;
	$right = 0;

	for ($i = 0; $i < 99; $i++) {
		for ($j = 0; $j < 99; $j++) {
			$currTree = $line[$i][$j];
			for ($k = $i - 1; $k >= 0; $k--) {
				if ($i == 0) {
					$top = 0;
					break;
				}

				$counter++;

				if ($k == 0) {
					$top = $counter;
					break;
				}

				
				if ($currTree <= $line[$k][$j]) {
					$top = $counter;
					break;
				}
			}
			$counter = 0;
			for ($k = $i + 1; $k < 99; $k++) {
				if ($i == 98) {
					$bottom = 0;
					break;
				}

				$counter++;

				if ($k == 98) {
					$bottom = $counter;
					break;
				}

				
				if ($currTree <= $line[$k][$j]) {
					$bottom = $counter;
					break;
				}
			}
			$counter = 0;
			for ($l = $j - 1; $l >= 0; $l--) {
				if ($j == 0) {
					$left = 0;
					break;
				}

				$counter++;

				if ($l == 0) {
					$left = $counter;
					break;
				}
				
				if ($currTree <= $line[$i][$l]) {
					$left = $counter;
					break;
				}
			}
			$counter = 0;
			for ($l = $j + 1; $l < 99; $l++) {
				if ($j == 98) {
					$right = 0;
					break;
				}

				$counter++;

				if ($l == 98) {
					$right = $counter;
					break;
				}
				
				if ($currTree <= $line[$i][$l]) {
					$right = $counter;
					break;
				}
			}
			$counter = 0;
			$total = $top * $bottom * $left * $right;
			array_push($totalList, $total);
			// echo '(' . $i . ',' . $j . ')' . ' => ' . $total . ' => ' . $top . ',' . $bottom . ',' . $left . ',' . $right . '<br>';
			$top = 0;
			$bottom = 0;
			$left = 0;
			$right = 0;
		}
	}

	echo max($totalList);
	fclose($file);
