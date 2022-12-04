<?php
	$file = fopen('input.txt', 'r') or die('File error');

	$total = 0;
	$duplicate = 0;
	while(!feof($file)) {
		$line = trim(fgets($file));
		$range = explode(',', $line);
		compare($range[0], $range[1], $total, $duplicate);
		compare($range[1], $range[0], $total, $duplicate);
	}
	echo $total - $duplicate / 2;
	fclose($file);

	function compare($range1, $range2, &$total, &$duplicate)
	{
		$range1 = explode('-', $range1);
		$range2 = explode('-', $range2);

		if ($range1[0] <= $range2[0]) {
			if ($range1[1] >= $range2[1]) {
				if ($range1[0] == $range2[0] && $range1[1] == $range2[1]) {
					$duplicate++;
				}
				$total++;
			}
		}
	}