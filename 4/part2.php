<?php

$text = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$r = 0;
$h = count($text);
$w = strlen($text[0]);

for($y = 0; $y <= $h - 3; $y++){
	for($x = 0; $x <= $w - 3; $x++){
		if($text[$y + 1][$x + 1] === 'A'){
			if(
				(
					($text[$y][$x] === 'M' && $text[$y + 2][$x + 2] === 'S') ||
					($text[$y][$x] === 'S' && $text[$y + 2][$x + 2] === 'M')
				) &&
				(
					($text[$y][$x + 2] === 'M' && $text[$y + 2][$x] === 'S') ||
					($text[$y][$x + 2] === 'S' && $text[$y + 2][$x] === 'M')
				)
			){
				$r++;
			}
		}
	}
}

echo $r;
