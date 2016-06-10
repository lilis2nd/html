<?php
$os = $_REQUEST['os'];
$model = $_REQUEST['model'];
if (substr($os, 0, 1) == "[") {
	$os = "\\" . $os;
}
$dir = $os.'/'.$model;
$route = dirname(__FILE__) . '/' . $dir . '/';
$files = glob($route . "*.xlsx");

if (count(glob("$dir/*.{xlsx}", GLOB_BRACE)) === 0) {
	echo "<option>체크리스트가 없습니다.</option>\r\n";
} else {
	foreach ($files as $key => $filename) {
		$filename = explode('/', $filename);
		$filename = $filename[6];
		echo "<option value='$filename'>".$filename."</option>\r\n";
	}
}


// foreach (glob($dir."/*.xlsx") as $files) {
// 	$filename = basename($files);
// 	echo $filename."\r\n";
// }

// $files = glob($_SERVER['DOCUMENT_ROOT'].'/'.$dir.'/*.xlsx');
// $files = glob('/\[Marshmallow\]/G903M/*.xlsx');
echo "<pre>\r\n";
print_r(glob("$dir/*.{xlsx}", GLOB_BRACE));
var_dump($route);
var_dump($files);
var_dump($_SERVER['DOCUMENT_ROOT']);
var_dump($os);
var_dump($model);
var_dump($dir);
echo "</pre>\r\n";

// if (!$checks)
// 	echo "";
// else {
// 	echo "<select name='cl' id='cl' class='form-control'><option>".join('</option><option>', $checks).'</option></select>';
// }
?>