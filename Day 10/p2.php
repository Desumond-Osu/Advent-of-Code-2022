<?php
	$file = fopen('input.txt', 'r') or die('File error');

	$counter = 0;
	$pointer = 1;

	while(!feof($file)) {
		$line = trim(fgets($file));
		$line = explode(' ', $line);
		$counter++;
		if ($line[0] == 'noop') {
			draw($counter, $pointer);
			continue;
		}

		for ($i = 0; $i < 2; $i++) {
			draw($counter, $pointer);
			if ($i == 1) {
				$pointer += $line[1];
			} else {
				$counter++;
			}
		}
	}

	fclose($file);

	function draw($counter, $pointer)
	{
		for ($i = 0; $i < 10; $i++) {
			if ($counter > 40) {
				$counter -=40;
			}
		}

		if (in_array($counter, [$pointer, $pointer + 1, $pointer + 2])) {
			echo '#';
		} else {
			echo '.';
		}

		if ($counter == 40) {
			echo '<br>';
		}
	}