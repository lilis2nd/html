<?php
	$dir = $_REQUEST['parent'] . '/' . $_REQUEST['dir'];
	if (substr($dir, 0, 1) == "/") {
		$dir = substr($dir, 1);
	}

	if (substr($dir, 0, 1) == "[") {
		$dir = "\\" . $dir;
	}

	foreach (glob($dir."/*", GLOB_ONLYDIR) as $dir) {
		$dirname = basename($dir);
		echo "<option value=\"$dirname\">".$dirname."</option>\r\n";
	}
?>