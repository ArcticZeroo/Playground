<?php
	$error = "";
	global $error;
	$username = NULL;
	$password = NULL;
	$self = htmlspecialchars($_SERVER['PHP_SELF']);
	$self = ltrim($self);
	$self = rtrim($self);
	$self = trim($self);
	
	//Validate
	function validate($input, $type, $minlength, $maxlength){
		global $error;
		if($input != ""){
			$input = trim($input);
			$input = stripslashes($input);
			$input = htmlspecialchars($input);
			if(strlen($input) < $minlength){
				global $error;
				$error = $error . "Your $type is too short, minimum length is $minlength characters. ";
			}else if(strlen($input) > $maxlength){
				global $error;
				$error = $error . "Your $type is too long, maximum length is $maxlength characters. ";
			}else{
				return $input;
			}
		}else{
				global $error;
				$error = "Please enter a Username and Password. ";
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
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$username = validate($username, "username", 4, 16);
		$password = validate($password, "password", 8, 24);
		
		if($error == ""){
			checkStupid($username, $password);
		}
		
		//If both validate with no errors, debug only
		if($error == ""){
			echo "Validated password: " . $password;
			echo "Validated username: " . $username;
		}
	}
	
	//Adds "Error:" if there is an existing error
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