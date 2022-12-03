<?php
	$file = fopen('input.txt', 'r') or die('File error');
	//A > Rock, B > Paper, C > Scissors
	//X > Lose, Y > Draw, Z > Win

	//1 > Rock, 2 > Paper, 3 > Scissors
	//0 > Lost, 3 > Draw, 6 > Won

	$point = 0;
	$map = [
		'A X' => 3,
		'A Z' => 2,
		'A Y' => 1,
		'B Z' => 3,
		'B Y' => 2,
		'B X' => 1,
		'C Y' => 3,
		'C X' => 2,
		'C Z' => 1,
	];

	$result = [
		'X' => 0,
		'Y' => 3,
		'Z' => 6,
	];

	while(!feof($file)) {
		$line = fgets($file);
		$point += $map[trim($line)] + $result[$line[2]];
	}
	echo $point;
	fclose($file);