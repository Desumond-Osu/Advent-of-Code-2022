<?php
	$file = fopen('input.txt', 'r') or die('File error');

	$i = 0;
	while(!feof($file)) {
		$line[$i++] = str_split(trim(fgets($file)));
	}

	$totalList = [];
	$buffer = [];
	$top = 1;
	$bottom = 1;
	$left = 1;
	$right = 1;

	for ($i = 0; $i < 99; $i++) {
		for ($j = 0; $j < 99; $j++) {
			for ($k = $i; $k >= 0; $k--) {
				if ($i == 0) {
					$top = 0;
					break;
				} else if ($i == 1) {
					break;
				}

				if ($k == 1 || $k == 0) {
					break;
				}
				array_push($buffer, $line[$k - 1][$j]);
				if (max($buffer) < $line[$k - 2][$j]) {
					$top++;
				}
			}
			$buffer = [];
			for ($k = $i; $k < 99; $k++) {
				if ($i == 98) {
					$bottom = 0;
					break;
				} else if ($i == 97) {
					break;
				}

				if ($k == 98 || $k == 97) {
					break;
				}
				array_push($buffer, $line[$k + 1][$j]);
				if (max($buffer) < $line[$k + 2][$j]) {
					$bottom++;
				}
			}
			$buffer = [];
			for ($l = $j; $l >= 0; $l--) {
				if ($j == 0) {
					$left = 0;
					break;
				} else if ($j == 1) {
					break;
				}

				if ($l == 1 || $l == 0) {
					break;
				}
				array_push($buffer, $line[$i][$l - 1]);
				if (max($buffer) < $line[$i][$l - 2]) {
					$left++;
				}
			}
			$buffer = [];
			for ($l = $j; $l < 99; $l++) {
				if ($j == 98) {
					$right = 0;
					break;
				} else if ($j == 97) {
					break;
				}

				if ($l == 98 || $l == 97) {
					break;
				}
				array_push($buffer, $line[$i][$l + 1]);
				if (max($buffer) < $line[$i][$l + 2]) {
					$right++;
				}
			}
			$buffer = [];
			$total = $top * $bottom * $left * $right;
			echo $i . ' ' . $j;
			echo
			return;
			array_push($totalList, $total);
			$top = 1;
			$bottom = 1;
			$left = 1;
			$right = 1;
		}
	}

	rsort($totalList);
	echo var_export($totalList[0]);
	fclose($file);
