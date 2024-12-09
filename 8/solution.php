<?php

$text = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$grid = array_map('str_split', $text);
$ants = $n1 = $n2 = [];

foreach($grid as $i => $r){
	foreach($r as $j => $c){
		if($c !== '.' && $c !== '#'){
			$ants[$c][] = [$i, $j];
		}
	}
}

foreach($ants as $pos){
	$c = count($pos);
	for($i = 0; $i < $c; $i++){
		[$x1, $y1] = $pos[$i];

		for($j = 0; $j < $c; $j++){
			if($i === $j){
				continue;
			}

			[$x2, $y2] = $pos[$j];

			// Part 1
			$rX = 2 * $x2 - $x1;
			$rY = 2 * $y2 - $y1;
			if($rX >= 0 && $rX < count($grid) && $rY >= 0 && $rY < count($grid[0])){
				$n1["$rX,$rY"] = true;
			}

			// Part 2
			$dx = $x2 - $x1;
			$dy = $y2 - $y1;
			$x = $x2;
			$y = $y2;
			while($x >= 0 && $x < count($grid) && $y >= 0 && $y < count($grid[0])){
				$n2["$x,$y"] = true;
				$x += $dx;
				$y += $dy;
			}
		}
	}
}

echo "Part 1: " . count($n1) . "\nPart 2: " . count($n2) . "\n";
