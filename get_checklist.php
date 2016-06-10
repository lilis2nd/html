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
?>