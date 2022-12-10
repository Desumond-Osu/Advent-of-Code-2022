<?php
	$file = fopen('input.txt', 'r') or die('File error');

	$counter = 0;
	$total = 1;
	$totalList = [];

	while(!feof($file)) {
		$line = trim(fgets($file));
		$line = explode(' ', $line);
		$counter++;
		if ($line[0] == 'noop') {
			if (in_array($counter, [20, 60, 100, 140, 180, 220])) {
				array_push($totalList, $total * $counter);
			}
			continue;
		}

		for ($i = 0; $i < 2; $i++) {
			if (in_array($counter, [20, 60, 100, 140, 180, 220])) {
				array_push($totalList, $total * $counter);
			}

			if ($i == 1) {
				$total += $line[1];
			} else {
				$counter++;
			}
		}
	}

	echo array_sum($totalList);

	fclose($file);
