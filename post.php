<?php
	session_start();
	include_once("db.php");
	if (!isset($_SESSION['username'])) {
		header("Location:login.php");
		return;
	}

	if(isset($_POST['post'])) {
		$title = strip_tags($_POST['title']);
		$content = strip_tags($_POST['content']);

		$title = mysqli_real_escape_string($db, $title);
		$content = mysqli_real_escape_string($db, $content);
		$date = date('l jS \of F Y h:i:s A');
		$sql = "INSERT into posts (title, content, date) VALUES ('$title', '$content', '$date')";

		if ($title == "" || $content =="") {
			echo "Please complete your post!";
			return;
		}
		mysqli_query($db, $sql);
		header("Location: blog.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Blog - Post</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class = "post">
		<form action="post.php" method="post" enctype="multipart/form-data">
			<input placeholder="Title" type="text" name="title" autofocus size="95"><br /><br />
			<textarea placeholder="Content" name="content" rows="20" cols="80"></textarea><br/>
			<input type="submit" name="post" value="Post">
		</form>
	</div>
</body>
</html>