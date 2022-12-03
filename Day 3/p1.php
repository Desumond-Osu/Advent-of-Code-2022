<?php
	$file = fopen('input.txt', 'r') or die('File error');
	//ascii > A - Z is 65 - 90
	// a - z is 97 - 122

	$total = 0;
	while(!feof($file)) {
		$line = trim(fgets($file));
		$middle = strlen($line) / 2;
		$string1 = str_split(substr($line, 0, $middle));
		$string2 = str_split(substr($line, $middle));

		foreach ($string1 as $letter1) {
			if (in_array($letter1, $string2)) {
				if (ctype_lower($letter1)) {
					$total += ord($letter1) - 96;
				} else {
					$total += ord($letter1) - 38;
				}
				break;
			}
		}
	}
	echo $total;
	fclose($file);