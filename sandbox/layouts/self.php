<?php
	$urlLoc = $_SERVER['DOCUMENT_ROOT'] . "/sandbox/layouts/sidebarUrl.txt";
	$urlNameLoc = $_SERVER['DOCUMENT_ROOT'] . "/sandbox/layouts/sidebarUrlName.txt";
	$sidebarUrl = fopen($urlLoc, "r");
	$sidebarUrlName = fopen($urlNameLoc, "r");
	while(!feof($sidebarUrl) && !feof($sidebarUrlName)){
		$urlLine = fgets($sidebarUrl);
		$urlLine = (string)$urlLine;
		$urlLine = rtrim($urlLine);
		$urlLine = ltrim($urlLine);
		$urlLine = trim($urlLine);
		$urlCompare = $urlLine . "index.php";
		$urlNameLine = fgets($sidebarUrlName);
		$urlNameLine = (string)$urlNameLine;
		if($urlCompare == $_SERVER["PHP_SELF"]){
			global $self;
			$self = $urlNameLine;
		}
	}
	$self = ltrim($self);
	$self = rtrim($self);
	$self = trim($self);
	fclose($sidebarUrl);
	fclose($sidebarUrlName);
?>