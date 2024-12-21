<?php
$text = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$map = array_map('str_split', $text);

$rows = count($map);
$cols = count($map[0]);
$r1 = $r2 = 0;

$dirs = [[-1, 0], [1, 0], [0, -1], [0, 1]];

foreach($map as $row => $l){
	foreach($l as $col => $v){
		if($v != '0'){
			continue;
		}

		// Part 1
		$visited = array_fill(0, $rows, array_fill(0, $cols, false));
		$visited[$row][$col] = true;
		$q = [[$row, $col]];
		$rN = 0;

		for($i = 0; $i < count($q); $i++){
			foreach($dirs as [$dr, $dc]){
				$nr = $q[$i][0] + $dr;
				$nc = $q[$i][1] + $dc;

				if(
					$nr < 0 ||
					$nr >= $rows ||
					$nc < 0 ||
					$nc >= $cols ||
					$visited[$nr][$nc] ||
					$map[$nr][$nc] != $map[$q[$i][0]][$q[$i][1]] + 1
				){
					continue;
				}

				$visited[$nr][$nc] = true;
				$q[] = [$nr, $nc];
				$rN += ($map[$nr][$nc] == 9);
			}
		}
		$r1 += $rN;

		// Part 2
		$sA = [[$row, $col, []]];
		$dP = 0;

		while($sA){
			[$r, $c, $path] = array_pop($sA);
			if($map[$r][$c] == 9){
				$dP++;
				continue;
			}

			foreach($dirs as [$dr, $dc]){
				$nr = $r + $dr;
				$nc = $c + $dc;
				$key = "$r,$c->$nr,$nc";

				if(
					$nr < 0 ||
					$nr >= $rows ||
					$nc < 0 ||
					$nc >= $cols ||
					$map[$nr][$nc] != $map[$r][$c] + 1 ||
					in_array($key, $path)
				){
					continue;
				}

				$sA[] = [$nr, $nc, [...$path, $key]];
			}
		}
		$r2 += $dP;
	}
}

echo "Part 1: $r1\nPart 2: $r2\n";