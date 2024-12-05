<?php

$text = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$left = [];
$right = [];

foreach($text as $line){
	$nums = array_map('intval', explode('  ', trim($line)));
	$left[] = $nums[0];
	$right[] = $nums[1];
}

sort($left);
sort($right);

$diff = array_sum(array_map(fn($l, $r) => abs($l - $r), $left, $right));
$sim = array_sum(array_map(fn($num) => $num * (array_count_values($right)[$num] ?? 0), $left));

echo "Part 1: $diff\nPart 2: $sim\n";
