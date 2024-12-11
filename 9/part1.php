<?php

$lines = file_get_contents('input.txt');
$nums = str_split(trim($lines));
$disk = [];

foreach($nums as $i => $n){
	$disk = array_merge($disk, array_fill(0, $n, $i % 2 ? null : $i / 2));
}

$h = $nums[0];
while($h < count($disk)){
	if($disk[$h]){
		$h++;
	}elseif($v = array_pop($disk)){
		$disk[$h] = $v;
	}
}

$r = array_sum(array_map(fn($i, $v) => $i * $v, array_keys($disk), $disk));

echo "Part 1: $r\n";