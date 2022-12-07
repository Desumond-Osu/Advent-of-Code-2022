<?php
	$file = fopen('input.txt', 'r') or die('File error');

	$array = [
		'1' => ['N', 'B', 'D', 'T', 'V', 'G', 'Z', 'J'],
		'2' => ['S', 'R', 'M', 'D', 'W', 'P', 'F'],
		'3' => ['V', 'C', 'R', 'S', 'Z'],
		'4' => ['R', 'T', 'J', 'Z', 'P', 'H', 'G'],
		'5' => ['T', 'C', 'J', 'N', 'D', 'Z', 'Q', 'F'],
		'6' => ['N', 'V', 'P', 'W', 'G', 'S', 'F', 'M'],
		'7' => ['G', 'C', 'V', 'B', 'P', 'Q'],
		'8' => ['Z', 'B', 'P', 'N'],
		'9' => ['W', 'P', 'J'] 
	];

	while(!feof($file)) {
		$line = trim(fgets($file));
		$move[0] = explode(' from ', explode('move ', $line)[1])[0];
		$move[1] = explode(' to ', explode(' from ', explode('move ', $line)[1])[1])[0];
		$move[2] = explode(' to ', explode(' from ', explode('move ', $line)[1])[1])[1];

		//$array[$move[1]]; > $array[$move[2]];
		for ($i = 0; $i < $move[0]; $i++) {
			$last = key(array_slice($array[$move[1]], -1, 1, true));
			array_push($array[$move[2]], $array[$move[1]][$last]);
			unset($array[$move[1]][$last]);
		}
	}
	foreach ($array as $box) {
		echo $box[key(array_slice($box, -1, 1, true))];
	}

	fclose($file);