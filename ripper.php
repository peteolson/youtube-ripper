<?php
/* Youtube audio ripper. */

$cmmd="youtube-dl --extract-audio --audio-format mp3 -o '%(title)s.%(ext)s' ";

$fileQueue = "queue.txt";
$fileRipped = "ripped.txt";

$arryQueue = file($fileQueue);
$arryRipped = file($fileRipped);

$diff_result=array_diff($arryQueue, $arryRipped);

if ($diff_result) {
	echo "\nTo be ripped:\n";
	foreach ($diff_result as $value) {
		echo $value;
	}
} else {
	echo "\nThere are no unique files to be ripped\n";
}
if ($diff_result) {
	foreach ($diff_result as $value) {
		echo "Ripping->".$value;
		exec($cmmd.$value);
		file_put_contents($fileRipped, $value, FILE_APPEND | LOCK_EX);
	}
}

	
?>
