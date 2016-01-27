<?php
	global $self;
	$headfile = $_SERVER['DOCUMENT_ROOT'] . "/sandbox/layouts/head.html";
	$self = ltrim($self);
	$self = rtrim($self);
	$self = trim($self);
	echo file_get_contents($headfile);
	echo "<link type='text/css' rel='stylesheet' href='/sandbox/stylesheets/$self.css'/>";
	echo "<script src='/sandbox/scripts/" . $self . ".js'></script>";
	echo "</head>";
?>