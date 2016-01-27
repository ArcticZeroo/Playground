<?php
	global $self;
	$content = $_SERVER['DOCUMENT_ROOT'] . "/sandbox/layouts/page/$self.html";
	echo file_get_contents($content);
?>