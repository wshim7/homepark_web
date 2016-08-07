<?php
	session_start();

	if(isset($_POST['login'])) {
		include("db.php");
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);

		$username = stripslashes($username);
		$password = stripslashes($password);

		$username = mysqli_real_escape_string($db, $username);
		$password = mysqli_real_escape_string($db, $password);

		$password = md5($password);

		$sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
		$query = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($query);
		$id = $row['id'];
		$db_password = $row['password'];
		$admin = $row['admin'];

		if ($password == $db_password) {
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $id;
			if($admin ==1) {
				$_SESSION['admin'] = 1;
			}
			header("Location: index.php");
		} else {
			echo "You didn't enter the correct credentials";
		}
	}
  if(isset($_POST['register'])) {
    include_once("db.php");
    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    $firstname = strip_tags($_POST['firstname']);
    $lastname = strip_tags($_POST['lastname']);

    $username = stripslashes($username);
    $password = stripslashes($password);
    $firstname = stripslashes($firstname);
    $lastname = stripslashes($lastname);

    $username = mysqli_real_escape_string($db, $username);
    $password = mysqli_real_escape_string($db, $password);
    $firstname = mysqli_real_escape_string($db, $firstname);
    $lastname = mysqli_real_escape_string($db, $lastname);

    $password = md5($password);

    $sql_store = "INSERT into users (username, password, firstname, lastname) VALUES ('$username','$password','$firstname','$lastname')";
    $sql_fetch_username = "SELECT username FROM users WHERE username = '$username'";
    

    $query_username = mysqli_query($db, $sql_fetch_username);


    if (mysqli_num_rows($query_username)) {
      echo "There is already a user with that username";
      return;
    } 
    if ($username=="") {
      echo "Please insert username";
      return;
    }
    if ($password =="") {
      echo "Please insert password";
      return;
    } 

    mysqli_query($db, $sql_store);
    header("Location: login.php");
  }
?>



<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Sign-Up/Login Form</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="css/normalize.css">

    
        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body>

    <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Sign Up for Free</h1>
          
          <form action="login.php" method="post">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" required name = "firstname" autocomplete="off" />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text" required name = "lastname" autocomplete="off"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Username<span class="req">*</span>
            </label>
            <input type="text" required name = "username" autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password" required name = "password" autocomplete="off"/>
          </div>
          
          <button type="submit" class="button button-block" name="register">Register</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="login.php" method="post">
          
            <div class="field-wrap">
            <label>
              Username<span class="req">*</span>
            </label>
            <input type="text" required name = "username" autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" required name = "password" autocomplete="off"/>
          </div>
          
          <button class="button button-block" type="submit" name="login">Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

    
    
    
  </body>
</html>
