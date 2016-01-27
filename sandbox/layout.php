<?php
	$filename = basename(__FILE__, '.php');
	$self  = '';
	//Gets Self
		require($_SERVER['DOCUMENT_ROOT'] . "/sandbox/layouts/self.php");
	//Open HTML
	echo "<html>";
	//Head
		require($_SERVER['DOCUMENT_ROOT'] . "/sandbox/layouts/head.php");
	//Body
		echo "<body>";
	//Hamburger Menu
		require($_SERVER['DOCUMENT_ROOT'] . "/sandbox/layouts/hamburger.php");
		echo "<div id='screenCover'></div>";
	//Header
		require($_SERVER['DOCUMENT_ROOT'] . "/sandbox/layouts/header.php");
	//Content
		require($_SERVER['DOCUMENT_ROOT'] . "/sandbox/layouts/content.php");
	//Close HTML
		echo "</html>";
?>