<?php
	$file = fopen('input.txt', 'r') or die('File error');

	$posH = [0, 0]; //x y
	$posT = [0, 0]; //x y

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
			$move = 0;
			switch ($line[0]) {
				case 'L':
				case 'R':
					if ($posH[0] - $dir[$line[0]][0] == $posT[0]) {
						$move = 1;
					}
					break;
				case 'U':
				case 'D':
					if ($posH[1] - $dir[$line[0]][1] == $posT[1]) {
						$move = 1;
					}
			}

			$posH = array_map(function (...$move) {
			    return array_sum($move);
			}, $posH, $dir[$line[0]]);

			if ($move == 1) {
				$posT = array_map(function (...$move) {
				    return array_sum($move);
				}, $posH, array_map(function($x, $y) { //move behind
					return $x * $y; 
				}, $dir[$line[0]], [-1, -1]
				));
			}
			$map[$posT[1]][$posT[0]] = 1;
		}
	}
	$total = 0;
	foreach ($map as $rank) {
		$total += array_sum($rank);
	}

	echo $total;

	fclose($file);
