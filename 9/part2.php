<?php

$text = file_get_contents('input.txt');
$nums = str_split(trim($text));
$disk = $files = [];

foreach($nums as $i => $n){
	$disk = array_merge($disk, array_fill(0, $n, $i % 2 ? null : $i / 2));
	if($i % 2 == 0 && $n > 0){
		$files[$i / 2] = ['id' => $i / 2, 'size' => $n];
	}
}

krsort($files);

foreach($files as $f){
	$pos = array_search($f['id'], $disk);
	if($pos === false){
		continue;
	}

	for($p = 0; $p < $pos; $p++){
		if(array_sum(array_slice($disk, $p, $f['size'])) === 0){
			for($i = 0; $i < $f['size']; $i++){
				$disk[$pos + $i] = null;
				$disk[$p + $i] = $f['id'];
			}
			break;
		}
	}
}

$r = array_sum(array_map(fn($i, $v) => $i * $v, array_keys($disk), $disk));

echo "Part 2: $r";