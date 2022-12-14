<?php
	$file = fopen('input.txt', 'r') or die('File error');
	//A > Rock, B > Paper, C > Scissors
	//X > Rock, Y > Paper, Z > Scissors

	//1 > Rock, 2 > Paper, 3 > Scissors
	//0 > Lost, 3 > Draw, 6 > Won

	$point = 0;
	$map = [
		'A X' => 3,
		'B Y' => 3,
		'C Z' => 3,
		'A Y' => 6,
		'B Z' => 6,
		'C X' => 6,
		'A Z' => 0,
		'B X' => 0,
		'C Y' => 0,
	];

	$shape = [
		'X' => 1,
		'Y' => 2,
		'Z' => 3,
	];

	while(!feof($file)) {
		$line = fgets($file);
		$point += $map[trim($line)] + $shape[$line[2]];
	}
	echo $point;
	fclose($file);