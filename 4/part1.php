<?php

$text = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$r = 0;
$h = count($text);
$w = strlen($text[0]);

for($y = 0; $y < $h; $y++){
	for($x = 0; $x < $w; $x++){
		foreach([[0, 1], [1, 0], [1, 1], [-1, 1], [0, -1], [-1, 0], [-1, -1], [1, -1]] as [$d1, $d2]){
			$f = true;
			for($i = 0; $i < 4; $i++){
				$n1 = $x + $d2 * $i;
				$n2 = $y + $d1 * $i;
				if($n1 < 0 || $n1 >= $w || $n2 < 0 || $n2 >= $h || $text[$n2][$n1] !== "XMAS"[$i]){
					$f = false;
					break;
				}
			}
			$r += $f;
		}
	}
}

echo $r;
