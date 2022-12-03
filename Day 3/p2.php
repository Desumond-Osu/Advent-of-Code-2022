<?php
	$file = fopen('input.txt', 'r') or die('File error');
	//ascii > A - Z is 65 - 90
	// a - z is 97 - 122

	$total = 0;
	while(!feof($file)) {
		$line = str_split(trim(fgets($file)));
		$line2 = str_split(trim(fgets($file)));
		$line3 = str_split(trim(fgets($file)));

		foreach ($line as $letter1) {
			if (in_array($letter1, $line2) && in_array($letter1, $line3)) {
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