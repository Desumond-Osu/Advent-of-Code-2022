<?php
	$file = fopen('input.txt', 'r') or die('File error');

	$i = 0;
	$buffer = [];
	while(!feof($file)) {
		$line[$i++] = str_split(trim(fgets($file)));
	}

	$base = 97 * 4 + 4;

	for ($j = 1; $j < 98; $j++) {
		for ($k = 1; $k < 98; $k++) {
			array_push($buffer, $line[$k - 1][$j]);
			if (max($buffer) < $line[$k][$j]) {
				$mark[$k][$j] = 1;
			}
		}
		$buffer = [];
	}

	for ($j = 1; $j < 98; $j++) {
		for ($k = 1; $k < 98; $k++) {
			array_push($buffer, $line[$j][$k - 1]);
			if (max($buffer) < $line[$j][$k]) {
				$mark[$j][$k] = 1;
			}
		}
		$buffer = [];
	}

	for ($j = 1; $j < 98; $j++) {
		for ($k = 1; $k < 98; $k++) {
			array_push($buffer, $line[98 - $k + 1][$j]);
			if (max($buffer) < $line[98 - $k][$j]) {
				$mark[98 - $k][$j] = 1;
			}
		}
		$buffer = [];
	}

	for ($j = 1; $j < 98; $j++) {
		for ($k = 1; $k < 98; $k++) {
			array_push($buffer, $line[$j][98 - $k + 1]);
			if (max($buffer) < $line[$j][98 - $k]) {
				$mark[$j][98 - $k] = 1;
			}
		}
		$buffer = [];
	}

	$total = 0;
	foreach ($mark as $rows) {
		$total += count($rows);
	}

	echo var_export($total + $base, 1);

	fclose($file);
