<html>
	<head>
		<title>Encryption Testing</title>
		<link rel="stylesheet" type="text/css" href="stylesheets/index.css"/>
	</head>
	<body>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<input type='text' name='username' placeholder='Username'><br>
			<input type='password' name='password' placeholder='Password'><br>
			<input type='submit' value='Submit'>
		</form>
		<div id="error"><?php echo $error ?></div>
	</body>
</html>