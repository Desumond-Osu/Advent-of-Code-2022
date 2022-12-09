<?php
	$file = fopen('input.txt', 'r') or die('File error');

	$pos = [
		[0, 0],
		[0, 0],
		[0, 0],
		[0, 0],
		[0, 0],
		[0, 0],
		[0, 0],
		[0, 0],
		[0, 0],
		[0, 0],
	];

	$dir = [
		'L' => [-1, 0],
		'R' => [1, 0],
		'U' => [0, 1],
		'D' => [0, -1]
	];

	while(!feof($file)) {
		$line = trim(fgets($file));
		$line = explode(' ', $line);

		for ($i = 0; $i < $line[1]; $i++) {
			$moveDir = [];
			for ($j = 0; $j < 9; $j++) {
				$plane = '';
				switch ($line[0]) {
					case 'L':
					case 'R':
						if ($pos[$j][0] - $dir[$line[0]][0] == $pos[$j+1][0]) {
							if ($pos[$j][1] == $pos[$j+1][1]) {
								$plane = 'straight';
							} else {
								$plane = 'diagonal';
							}
						}
						break;
					case 'U':
					case 'D':
						if ($pos[$j][1] - $dir[$line[0]][1] == $pos[$j+1][1]) {
							if ($pos[$j][0] == $pos[$j+1][0]) {
								$plane = 'straight';
							} else {
								$plane = 'diagonal';
							}
						}
						break;
				}
				$pos[$j] = array_map(function (...$move) {
				    return array_sum($move);
				}, $pos[$j], $dir[$line[0]]);

				if ($j == 8) {
					if ($plane == 'straight') {
						$pos[$j+1] = array_map(function (...$move) {
						    return array_sum($move);
						}, $pos[$j+1], $dir[$line[0]]);
					} else if ($plane == 'diagonal') {
						$pos[$j+1] = array_map(function (...$move) {
						    return array_sum($move);
						}, $pos[$j], array_map(function($x, $y) {
							return $x * $y; 
						}, $dir[$line[0]], [-1, -1]
						));
					}
				}

				if (empty($plane)) {
					continue 2;
				}

				if ($plane == 'diagonal') {
					$moveDir = $pos[$j+1];
					$pos[$j+1] = array_map(function (...$move) {
					    return array_sum($move);
					}, $pos[$j], array_map(function($x, $y) {
						return $x * $y; 
					}, $dir[$line[0]], [-1, -1]
					));
					$moveDir = array_map(function($x, $y) {
						return $x - $y; 
					}, $moveDir, $pos[$j+1]);
					break;
				}
			}
			for ($k = $j + 2; $k < 10; $k++) {
				$found = 0;
				for ($m = -1; $m < 2; $m++) {
					for ($l = -1; $l < 2; $l++) {
						if ($pos[$k][0] + $m == $pos[$k-1][0] && $pos[$k][1] + $l == $pos[$k-1][1]) {
							$found = 1;
						}
					}
				}

				if ($found == 1) {
					break;
				}

				if ($pos[$k][0] == $pos[$k-1][0]) {
					$moveDir = [0, -($pos[$k-1][1] - $pos[$k][1]) / 2];
				} else if ($pos[$k][1] == $pos[$k-1][1]) {
					$moveDir = [-($pos[$k-1][0] - $pos[$k][0]) / 2, 0];
				}
				$pos[$k] = array_map(function ($x, $y) {
				    return $x - $y;
				}, $pos[$k], $moveDir);	
			}

			$map[$pos[9][1]][$pos[9][0]] = 1;
		}
	}
	$total = 0;
	foreach ($map as $rank) {
		$total += array_sum($rank);
	}

	echo $total;

	fclose($file);
