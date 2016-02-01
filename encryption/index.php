<?php
	$error = "";
	global $error;
	$username = NULL;
	$password = NULL;
	$self = htmlspecialchars($_SERVER['PHP_SELF']);
	$self = ltrim($self);
	$self = rtrim($self);
	$self = trim($self);
	
	//Trim
	function trimInput($input){
		$input = trim($input);
		$input = ltrim($input);
		$input = rtrim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}
	
	//Validate
	function validate($input, $type, $minlength, $maxlength){
		$input = trimInput($input);
		global $error;
		if(strlen($input) < $minlength){
			global $error;
			$error = $error . "Your $type is too short, minimum length is $minlength characters. ";
		}else if(strlen($input) > $maxlength){
			global $error;
			$error = $error . "Your $type is too long, maximum length is $maxlength characters. ";
		}else{
			return $input;
		}
	}
	
	//Check if the password is stupid
	function checkStupid($username, $password){
		//Let's give them benefit of the doubt.
		$stupid = false;
		
		//Check for stupidity
		if($stupid == false && $username == $password){
			$stupid = true;
			global $error;
			$error = $error . "Your username may not be the same as your password. ";
		}
		//Leaving this blank for now, may eventually add more stupid checks
	}
	
	//Encrypt Input
	function encrypt($input){
		$input = md5($input);
		$input = sha1($input);
		$hash = password_hash($input);
		if($hash != false){
			return $hash;			
		}else{
			global $error;
			$error = $error . "Password failed to encrypt. "
		}
		//Debug
		echo password_get_info($input);
	}
	
	//Validate Information
	if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["type"] == "SIGNUP"){
		if(!empty($_POST["username"]) && !empty($_POST["password"])){
			$username = $_POST["username"];
			$password = $_POST["password"];
			
			//Remove special characters and check if it meets password requirements
			$username = validate($username, "username", 4, 16);
			$password = validate($password, "password", 8, 24);
			
			//Connect to SQL Server
			require $_SERVER['ROOT_DIRECTORY'] . "/sql.php";
			
			//Query if account already exists
			$exists = false;
			$existsSQL = "SELECT username FROM account WHERE username = $username";
			$existsQuery = mysqli_query($connect, $existsSQL);
			$existsNumRows = mysqli_num_rows($existsQuery);
			if($existsNumRows > 0){
				$exists = true;
			}
			
			//
			
			if(!exists){
				//If it meets requirements, ensure it's not a stupid password
				if($error == ""){
					checkStupid($username, $password);
				}
				
				//If both validate with no errors, debug only
				if($error == ""){
					//Encrypt it!
					$encryptedPassword = encrypt($password);
					$insertSQL = "INSERT INTO account (username, password) VALUES ($username, $password)";
				}
			}else{
				global $error;
				$error = $error . "Account already exists. "
			}
		}else{
			//If one is empty
			global $error;
			$error = $error . "Please enter a Username and Password. ";
		}
	}
	
	//Adds "Error: " before the error message if there is an existing error
	if($error != ""){
		$error = "<b>ERROR:</b> " . $error;
	}
?>
<html>
	<head>
		<title>Encryption Testing</title>
		<link rel="stylesheet" type="text/css" href="stylesheets/index.css"/>
	</head>
	<body>
		<div id="content">
			<form action="<?php echo $self; ?>" method="post">
				<input type='text' name='username' placeholder='Username'><br>
				<input type='password' name='password' placeholder='Password'><br>
				<input type='hidden' value='signup'>
				<input type='submit' value='Sign Up'>
			</form>
			<div id="error"><?php echo $error; ?></div>
		</div>
	</body>
</html>