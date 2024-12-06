<?php

$text = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$row = $k = $r1 = [];
$r2 = 0;
$a = null;

foreach($text as $i => $line){
	foreach(str_split($line) as $j => $c){
		$pos = "$i,$j";
		$row[$pos] = $c;
		if($c === '^'){
			$a = $pos;
		}elseif($c === '#'){
			$k[$pos] = true;
		}
	}
}

$z = $a;
$dz = [-1, 0];

while(isset($row[$z])){
	$r1[$z] = true;
	[$x, $y] = array_map('intval', explode(',', $z));
	[$dx, $dy] = $dz;
	$next = ($x + $dx) . ',' . ($y + $dy);
	$dz = isset($k[$next]) ? [$dy, -$dx] : $dz;
	$z = isset($k[$next]) ? $z : $next;
}

foreach(array_keys($r1) as $x){
	$nW = $k + [$x => true];
	$z = $a;
	$dz = [-1, 0];
	$visited = [];

	while(isset($row[$z])){
		[$dx, $dy] = $dz;
		$tag = "$z|$dx,$dy";
		if(isset($visited[$tag])){
			$r2++;
			break;
		}
		$visited[$tag] = true;
		[$x, $y] = array_map('intval', explode(',', $z));
		$next = ($x + $dx) . ',' . ($y + $dy);
		$dz = isset($nW[$next]) ? [$dy, -$dx] : $dz;
		$z = isset($nW[$next]) ? $z : $next;
	}
}

echo "Part 1: " . count($r1) . "\nPart 2: $r2\n";