<?php
	$file = fopen('input.txt', 'r') or die('File error');
	$line = str_split(trim(fgets($file)));

	for ($i = 0; $i < count($line) - 3; $i++) {
		for ($j = $i; $j < $i + 4; $j++) {
			for ($k = $i; $k < $i + 4; $k++) {
				if ($line[$j] == $line[$k] && $j != $k) {
					continue 3;
				}
			}
		}
		echo '4 > ' . ($i + 4);
		break;
	}

	for ($i = 0; $i < count($line) - 13; $i++) {
		for ($j = $i; $j < $i + 14; $j++) {
			for ($k = $i; $k < $i + 14; $k++) {
				if ($line[$j] == $line[$k] && $j != $k) {
					continue 3;
				}
			}
		}
		echo '<br>14 > ' . ($i + 14);
		return;
	}
	fclose($file);