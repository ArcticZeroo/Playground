<?php
	$titlesLoc = $_SERVER['DOCUMENT_ROOT'] . "/sandbox/layouts/sidebarTitles.txt";
	$urlLoc = $_SERVER['DOCUMENT_ROOT'] . "/sandbox/layouts/sidebarUrl.txt";
	$urlNameLoc = $_SERVER['DOCUMENT_ROOT'] . "/sandbox/layouts/sidebarUrlName.txt";
	$sidebarTitles = fopen($titlesLoc, "r");
	$sidebarUrl = fopen($urlLoc, "r");
	$sidebarUrlName = fopen($urlNameLoc, "r");
	echo 
	"<div id='hamburgerMenu'>
		<div id='hamburgerContent'>
			<div id='hamburgerTop'>All Experiments</div>
			<hr>
			<div id='hamburgerBot'><ul>";
				while(! feof($sidebarTitles) && !feof($sidebarUrl) && !feof($sidebarUrlName)){
					$titleLine = fgets($sidebarTitles);
					$titleLine = (string)$titleLine;
					$urlLine = fgets($sidebarUrl);
					$urlLine = (string)$urlLine;
					$urlLine = rtrim($urlLine);
					$urlCompare = $urlLine . "index.php";
					$urlNameLine = fgets($sidebarUrlName);
					$urlNameLine = (string)$urlNameLine;
					if($urlCompare == $_SERVER["PHP_SELF"]){
						echo "<li class='selected'><a>$titleLine</a></li>";
					}
					else{
						echo "<li><a href='$urlLine'>$titleLine</a></li>";
					}
					/*echo "<li>" . $urlCompare . ", " . $_SERVER["PHP_SELF"] . "</li>";*/
				}
					echo "</ul>";
					fclose($sidebarTitles);
					fclose($sidebarUrl);
					fclose($sidebarUrlName);
	echo 		"</ul>
			</div>
		</div>
	</div>";
?>