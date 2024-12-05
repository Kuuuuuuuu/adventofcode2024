<?php

$text = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$r1 = $r2 = 0;

function valid(array $nums) : bool{
	for($i = 1; $i < count($nums); $i++){
		$diff = $nums[$i] - $nums[$i - 1];
		if(!$diff || abs($diff) > 3 || ($diff > 0) !== ($nums[1] > $nums[0])){
			return false;
		}
	}
	return count($nums) > 1;
}

foreach($text as $line){
	$nums = array_map('intval', explode(' ', $line));

	if(valid($nums)){
		$r1++;
		$r2++;
	}else{
		foreach($nums as $i => $num){
			if(valid(array_merge(array_slice($nums, 0, $i), array_slice($nums, $i + 1)))){
				$r2++;
				break;
			}
		}
	}
}

echo "Part 1: $r1\nPart 2: $r2\n";
