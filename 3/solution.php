<?php

$text = file_get_contents('input.txt');

$r1 = $r2 = 0;
$p = true;

preg_match_all("/(mul\((\d+),(\d+)\)|do\(\)|don't\(\))/", $text, $m);

foreach($m[0] as $r){
	if($r === "don't()"){
		$p = false;
	}elseif($r === "do()"){
		$p = true;
	}else{
		preg_match("/mul\((\d+),(\d+)\)/", $r, $nums);
		$v = $nums[1] * $nums[2];
		$r1 += $v;
		if($p){
			$r2 += $v;
		}
	}
}

echo "Part 1: $r1\nPart 2: $r2\n";
