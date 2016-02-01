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
			$error = "Your username may not be the same as your password.";
		}
		//Leaving this blank for now, may eventually add more stupid checks
	}
	
	//Validate Information
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(!empty($_POST["username"]) && !empty($_POST["password"])){
			$username = $_POST["username"];
			$password = $_POST["password"];
			
			//Remove special characters and check if it meets password requirements
			$username = validate($username, "username", 4, 16);
			$password = validate($password, "password", 8, 24);
			
			//If it meets requirements, ensure it's not a stupid password
			if($error == ""){
				checkStupid($username, $password);
			}
			
			//If both validate with no errors, debug only
			if($error == ""){
				echo "Validated password: " . $password;
				echo "Validated username: " . $username;
			}
			//Hash it
			$password = md5($password);
			echo $password . "<br>";
			$password = sha1($password);
			echo $password . "<br>";
		}else{
			//If one is empty
			global $error;
			$error = $error . "Please enter a Username and Password. ";
		}
	}
	
	//Adds "Error: " before the error message if there is an existing error
	if($error != ""){
		$error = "Error: " . $error;
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
				<input type='submit' value='Submit'>
			</form>
			<div id="error"><?php echo $error; ?></div>
		</div>
	</body>
</html>