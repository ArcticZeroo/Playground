<?php 
//error_reporting(0);
function sqlConnect($database){
	$servername="localhost";
	$username="root";
	$password="password";
	$database="$database";
	$connectionStatus = false;
					
	//Connect
	$connect = new mysqli($servername, $username, $password, $database);

	//Check Connection
	if (mysqli_connect_errno()) {
		echo "<b>ERROR:</b> Failed to connect to MySQL Server.";
	}
	else{
		$connectionStatus = true;
	}
}?>