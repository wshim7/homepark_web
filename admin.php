<?php
	session_start();

	include_once("db.php");

	if(!isset($_SESSION['admin']) && $_SESSION['admin'] != 1) {
		header("Location: login.php");
		return;
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
	<div class="divblog"></div>
	<?php

		$sql = "SELECT * FROM posts ORDER BY id DESC";
		$results = mysqli_query($db, $sql) or die(mysqli_error());
		$posts = "";
		if (mysqli_num_rows($results) > 0) {
			while ($row = mysqli_fetch_assoc($results)) {
				$id = $row['id'];
				$title = $row['title'];
				$date = $row['date'];
				$admin = "<div class='panel'><a href='del_post.php?pid=$id'>Delete</a>&nbsp;<a href='edit_post.php?pid=$id'>Edit</a></div>";
				$posts .= "<div class='divblog'><h3>$title</a></h3><p class='date'>$date</p>$admin<hr /></div>";

			}
			echo $posts;
		} else {
			echo "There are no posts to display!";
		}
		echo "<div class='divblog'><h2><a href ='post.php'>post</a><br><a href='logout.php'>logout</a></h2></div>"
	?>

</body>
</html>