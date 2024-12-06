<?php

$text = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$r = $u = [];
$r1 = $r2 = 0;

foreach($text as $line){
	str_contains($line, '|')
		? $r[] = array_map('intval', explode('|', $line))
		: $u[] = array_map('intval', explode(',', $line));
}

foreach($u as $upd){
	$pos = array_flip($upd);
	$valid = true;

	foreach($r as [$x, $y]){
		if(isset($pos[$x], $pos[$y]) && $pos[$x] > $pos[$y]){
			$valid = false;
			break;
		}
	}

	if($valid){
		$r1 += $upd[(int) (count($upd) / 2)];
	}else{
		$f = [];
		foreach($upd as $item){
			$work = true;
			foreach($r as [$x, $y]){
				if($item === $y && in_array($x, $f, true)){
					$work = false;
					break;
				}
			}
			if($work){
				$f[] = $item;
			}
		}
		$r2 += $f[(int) (count($f) / 2)];
	}
}


echo "Part 1: $r1\nPart 2: $r2\n";
