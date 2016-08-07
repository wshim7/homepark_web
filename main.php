<?php
	$cookie_name = "loggedin";
	if(isset($_COOKIE[$cookie_name])) {
		$cookie_value = $_COOKIE[$cookie_name];
		echo "Welcome to your personal area $cookie_value!";
		echo '<a href="logout.php">Logout</a>';
	} else {
		echo "You are not logged in";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>homepark community</title>
</head>
<body>

</body>
</html>