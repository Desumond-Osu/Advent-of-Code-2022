<?php
	$file = fopen('input.txt', 'r') or die('File error');

	$i = 0;
	$arr = [];
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
		    continue;
		}

		if (str_contains($line, 'If true')) { 
			$arr[$i]['true'] = explode('monkey ', $line)[1];
		    continue;
		}

		$arr[$i]['false'] = explode('monkey ', $line)[1];
		$arr[$i]['count'] = 0;
	}
	
	$count = [0, 0, 0, 0, 0, 0, 0, 0];
	for ($round = 0; $round < 20; $round++) {
		for ($j = 0; $j < count($arr); $j++) {
			$monkey = $arr[$j];
			for ($k = 0; $k < count($monkey['item']); $k++) {
				$count[$j]++;

				switch ($monkey['op'][0]) {
					case '*': $arr[$j]['item'][0] *= ($monkey['op'][1] != 'old') ? $monkey['op'][1] : $arr[$j]['item'][0]; break;
					case '/': $arr[$j]['item'][0] /= ($monkey['op'][1] != 'old') ? $monkey['op'][1] : $arr[$j]['item'][0]; break;
					case '+': $arr[$j]['item'][0] += ($monkey['op'][1] != 'old') ? $monkey['op'][1] : $arr[$j]['item'][0]; break;
					case '-': $arr[$j]['item'][0] -= ($monkey['op'][1] != 'old') ? $monkey['op'][1] : $arr[$j]['item'][0]; break;
				}

				$arr[$j]['item'][0] /= 3;
				$arr[$j]['item'][0] = (int) floor($arr[$j]['item'][0]);
				// echo var_export($arr[$j]['item']);
				if ($arr[$j]['item'][0] % $monkey['test'] == 0) {
					array_push($arr[$monkey['true']]['item'], $arr[$j]['item'][0]);
					array_splice($arr[$j]['item'], 0, 1);
				} else {
					array_push($arr[$monkey['false']]['item'], $arr[$j]['item'][0]);
					array_splice($arr[$j]['item'], 0, 1);
				} 
			}
		}
	}
	
	rsort($count);
	echo $count[0] * $count[1];
	
	fclose($file);
