<?php
	$mysqli2 = new mysqli("localhost", "root","","arquivo4");
	$mysqli2->set_charset('utf8');

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
?>
