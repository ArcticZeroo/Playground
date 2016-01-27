<html>
	<head>
		<title>Nuclear Throne Version Repository</title>
		<script src="main.js"></script>
		<link rel="stylesheet" type="text/css" href="content.css"/>
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="icon" href="images/favicon.ico"/>
		<meta name="theme-color" content="#2196F3"></meta>
	</head>
	<body>
		<div id="header">
			<div id="title">Nuclear Throne Version Repository</div>
			<div id="subtitle"><a href="http://store.steampowered.com/app/242680/" target="_blank"><img src="images/steamicon.png" width="40" height="40"/></a></div>
		</div>
		<div id="versions">
			<?php
				error_reporting(0);
				$servername="localhost";
				$username="root";
				$password="password";
				$database="throne";
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
				
				//Checks if connected to prevent random unfinished elements from appearing
				if($connectionStatus){
					//Query
					$sql = "SELECT * FROM versions ORDER BY id desc";
					$result = mysqli_query($connect, $sql);
					$numrows = mysqli_num_rows($result);
					//Create Table if the database has rows
					if($numrows > 0){
						//Echo the table & headers
						echo "<table cellpadding='4' id='entry'>
								<tr>
									<th></th>
									<th></th>
										<th>Date</th>
									<th>Name</th>
									<th>Download</th>
									<th>Notes</th>
								</tr>";
						//Creates rows for each entry
						while($row = mysqli_fetch_array($result)) {
							//Creates icon for row
							if($row["image"] == NULL){
								$image = "icons/patience.png";
							}
							else{
								if($row["type"] != NULL){
									$extension = "." . $row["type"];
								}else{
									$extension = ".png";
								}
								$image = "icons/" . $row["image"] . $extension;
							}
							//Creates download url
							if($row["downloadUrl"] != NULL){
								$downloadUrl = "/builds/" . $row["downloadUrl"] . ".zip";
							}
							else{
								$downloadUrl = "/builds/" . $row["version"] . ".zip";
							}
							echo "<tr id='".$row['version']."'>
									<td class='version-number'>".$row["version"]."</td>
									<td id='icon'><img src='$image' width='50' /></td>
									<td>".$row["date"]."</td>
									<td>".$row["name"]."</td>
									<td><a class='material-icons' href='$downloadUrl'>file_download</a></td>
									<td>".$row["notes"]."</td>
								</tr>";
						}
						//Closes table
						echo "</table>";
					}
					//Echos if the database has no entries
					else{
						echo "No rows found in database";
					}
					//Close connection
					mysqli_close();
				}
			?>
		</div>
	</body>
</html>