<?php
	$file = fopen('input.txt', 'r') or die('File error');

	$i = 0;
	$arr = [];
	$totalMod = 1;
	while(!feof($file)) {
		$line = trim(fgets($file));

		if (empty($line)) {
			$i++;
			continue;
		}

		if (str_contains($line, 'Monkey')) { 
		    continue;
		}

		if (str_contains($line, 'Starting')) { 
			$arr[$i]['item'] = explode(', ', explode(': ', $line)[1]);
		    continue;
		}

		if (str_contains($line, 'Operation')) { 
			$arr[$i]['op'] = explode(' ', explode('old ', $line)[1]);
		    continue;
		}

		if (str_contains($line, 'Test')) { 
			$arr[$i]['test'] = explode('by ', $line)[1];
			$totalMod *= $arr[$i]['test'];
		    continue;
		}

		if (str_contains($line, 'If true')) { 
			$arr[$i]['true'] = explode('monkey ', $line)[1];
		    continue;
		}

		$arr[$i]['false'] = explode('monkey ', $line)[1];
		$arr[$i]['count'] = 0;
	}
	
	$count = array_fill(0, count($arr), 0);
	for ($round = 0; $round < 10000; $round++) {
		for ($j = 0; $j < count($arr); $j++) {
			$monkey = $arr[$j];
			for ($k = 0; $k < count($monkey['item']); $k++) {
				$count[$j]++;

				$arr[$j]['item'][0] = ($monkey['op'][1] != 'old') ? 
				eval('return ' . $arr[$j]['item'][0] . $monkey['op'][0] . $monkey['op'][1] . ';') : 
				eval('return ' . $arr[$j]['item'][0] . $monkey['op'][0] . $arr[$j]['item'][0] . ';');

				array_push($arr[$monkey[$arr[$j]['item'][0] % $monkey['test'] == 0 ? 'true' : 'false']]['item'], $arr[$j]['item'][0] % $totalMod);
				array_splice($arr[$j]['item'], 0, 1);
			}
		}
	}

	rsort($count);
	echo $count[0] * $count[1];
	
	fclose($file);
