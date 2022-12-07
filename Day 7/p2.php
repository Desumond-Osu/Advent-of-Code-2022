<?php
	$file = fopen('input.txt', 'r') or die('File error');

	$tree = [
		'/' => [

		]
	];
	$path = [];
	$total = 0;

	while(!feof($file)) {
		$line = trim(fgets($file));
		if ($line[0] == '$') {
			$line = substr($line, 2);
			if ($line[0] == 'c') { //cd
				$line = substr($line, 3);
				if ($line[0] != '.') {
					array_push($path, $line);
				} else {
					array_pop($path);
				}
			}
		}
		else if (is_numeric(explode(' ', $line)[0])) {
			setRecursive($tree, $path, explode(' ', $line)[0]);
		}
	}
	$total_list = [];
	loopRecursive2($tree, $total, $total_list);
	$to_be_deleted = 30000000 - (70000000 - $total_list[0]);
	sort($total_list);

	foreach ($total_list as $total => $value) {
		if ($value >= $to_be_deleted) {
			echo $value;
			break;
		}
	}

	fclose($file);

	function setRecursive(&$array, $path, $value)
	{
		$key = array_shift($path);
		if (empty($path)) {
			if (empty($array[$key]['value'])) {
				$array[$key]['value'] = 0;
			}
			$array[$key]['value'] += $value;
		} else {
			if (!isset($array[$key]) || !is_array($array[$key])) {
				$array[$key] = [];
			}
			setRecursive($array[$key], $path, $value);
		}
	}

	function loopRecursive(&$array, &$total)
	{
		foreach ($array as $child) {
			if (is_numeric($child)) {
				$total += $child;
			} else {
				loopRecursive($child, $total);
			}
		}
	}

	function loopRecursive2(&$array, &$total, &$total_list)
	{
		loopRecursive($array, $total);
		array_push($total_list, $total);
		$total = 0;

		foreach ($array as $child) {
			if (is_array($child)) {
				loopRecursive2($child, $total, $total_list);
			}
		}
	}