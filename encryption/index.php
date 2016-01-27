<?php
	$error = "";
	$username = "";
	$password = "";
	$self = htmlspecialchars($_SERVER['PHP_SELF']);
	$self = ltrim($self);
	$self = rtrim($self);
	$self = trim($self);
	
	//Validate
	function validate($input, $type, $maxlength, $minlength){
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		if($input.length() <= $minlength){
			$error = "Your $type is too short. Minimum length is $minlength characters.";
		}else if($input.length() >= $maxlength){
			$error = "Your $type is too long. Maximum length is $maxlength characters.";
		}else{
			return $input;
			//DEBUG
			$error = "$type works, validated $type: " . $input;
		}
	}
	
	//GET
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$username = $_POST["username"];
		$password = $_POST["password"];
		validate($username, "username", 8, 24);
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
			<div id="error"><?php if($error != ""){echo $error;} ?></div>
		</div>
	</body>
</html>