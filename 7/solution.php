<?php

$text = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$t = [];
$eqs = [];
$p1 = $p2 = 0;

foreach($text as $line){
	[$v, $nums] = explode(':', $line);
	$t[] = intval(trim($v));
	$eqs[] = array_map('intval', explode(' ', trim($nums)));
}

foreach($t as $i => $v){
	$nums = $eqs[$i];
	$n = count($nums);
	$ok1 = $ok2 = false;

	// part 1
	for($j = 0; $j < pow(2, $n - 1) && !$ok1; $j++){
		$r = $nums[0];
		$tmp = $j;

		for($k = 0; $k < $n - 1; $k++){
			$r = ($tmp % 2) ? $r + $nums[$k + 1] : $r * $nums[$k + 1];
			$tmp = intdiv($tmp, 2);
		}
		$ok1 = $r === $v;
	}

	// part 2
	for($j = 0; $j < pow(3, $n - 1) && !$ok2; $j++){
		$r = $nums[0];
		$tmp = $j;

		for($k = 0; $k < $n - 1; $k++){
			switch($tmp % 3){
				case 0:
					$r += $nums[$k + 1];
					break;
				case 1:
					$r *= $nums[$k + 1];
					break;
				case 2:
					$r = intval($r . $nums[$k + 1]);
					break;
			}
			$tmp = intdiv($tmp, 3);
		}

		$ok2 = $r === $v;
	}

	if($ok1){
		$p1 += $v;
	}

	if($ok2){
		$p2 += $v;
	}
}

echo "Part 1: $p1\nPart 2: $p2\n";
