<?php
	session_start();
	include_once("db.php");
	if (!isset($_SESSION['username'])) {
		header("Location:login.php");
		return;
	}

	if(isset($_POST['upload_image'])) {
		$file_name = $_FILES['image']['name'];
		$file_type = $_FILES['image']['type'];
		$file_size = $_FILES['image']['size'];
		$file_tmp_name = $_FILES['image']['tmp_name'];

		if ($file_name) {
			move_uploaded_file($file_tmp_name, "img/$file_name"); 
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="wrapper">
		<div id="logo">
			<a href="index.php"><img src="logo.png" alt="logo" class="logo"></a>
		</div>
			<nav id="banner">
				<ul>
					<li><b><a href="blog.php" class = "n">TESTIMONY</a></b></li>
					<li><b><a href="upload.php" class = "n">ALBUM</a></b></li>
					<li><b><a href="intro.php" class="n">INTRO</a></b></li>

				</ul>
			</nav> 
	</div>
	
<?php
	$directory = "img/";
	if(is_dir($directory)) {
		if($handle = opendir($directory)) {
			while(($file=readdir($handle)) != false) {
				if($file==='.' || $file==='..') continue;
				echo "<div class='divpic'><img src='img/".$file."' width='50%' alt='' align='middle'></div>";
			}
			closedir($handle);
		}
	} 
?>


	<div class = "divform">
		<form action="" method="post" enctype="multipart/form-data">
			<label class = "lb">Upload Image</label><br><br>
			<input type="file" name="image"><br><br>
			<input type="submit" value="Upload Image" name="upload_image">
		</form>
		<h2 class ="blogout"><a href ='logout.php'>Logout</a></h2>
	</div>
</body>
</html>