<?php
	session_start();
	if (!isset($_SESSION['id'])) {
		header("Location: login.php");
	}
	include_once("db.php");
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
		require_once("nbbc/nbbc.php");
		$bbcode = new BBCode;

		$sql = "SELECT * FROM posts ORDER BY id DESC";
		$results = mysqli_query($db, $sql) or die(mysqli_error());
		$posts = "";
		if (mysqli_num_rows($results) > 0) {
			while ($row = mysqli_fetch_assoc($results)) {
				$id = $row['id'];
				$title = $row['title'];
				$content = $row['content'];
				$date = $row['date'];
				//$admin = "<div><a href='del_post.php?pid=$id'>Delete</a>&nbsp;<a href='edit_post.php?pid=$id'>Edit</a></div>";
				$output = $bbcode->Parse($content);
				$posts .= "<div class='divblog'><br><h3>$title</h3><p class='date'>$date<p><br/><p class='blog'>$output</p><hr/></div>";

			}
			echo $posts;
		} else {
			echo "<p align='center'>There are no posts to display!</p>";
		}

		if (isset($_SESSION['admin']) && $_SESSION['admin'] ==1) {
			echo "<div class='divblog'><h2><a href ='admin.php'>Admin</a></h2><h2><a href='logout.php'>logout</a></h2></div>";
		}
		if (!isset($_SESSION['username'])) {
			echo "<a href ='login.php'>Login</a>";
		}
		if (isset($_SESSION['username']) && !isset($_SESSION['admin'])) {
			echo "<div class='divblog'><h2><a href ='post.php'>Post</a></h2><h2><a href='logout.php'>logout</a></h2></div>";
		}
	?>
</body>
</html>