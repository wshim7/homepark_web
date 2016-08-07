<?php
	session_start();
	include_once("db.php");

	if (!isset($_SESSION['username'])) {
		header("Location:login.php");
		return;
	}

	if (!isset($_GET['pid'])) {
		header("Location: blog.php");
	}

	$pid = $_GET['pid'];

	if(isset($_POST['update'])) {
		$title = strip_tags($_POST['title']);
		$content = strip_tags($_POST['content']);

		$title = mysqli_real_escape_string($db, $title);
		$content = mysqli_real_escape_string($db, $content);
		$date = date('l jS \of F Y h:i:s A');
		$sql = "UPDATE posts SET title='$title', content = '$content', date= '$date' WHERE id='$pid'";

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
	<title>Blog - EDIT</title>
</head>
<body>
	<?php
		$sql_get = "SELECT * FROM posts WHERE id=$pid LIMIT 1";
		$res = mysqli_query($db, $sql_get);

		if(mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
				$title = $row['title'];
				$content = $row['content'];
				echo "<form action='edit_post.php?pid=$pid' method='post' enctype='multipart/form-data'>";
				echo "<input placeholder='Title' type='text' name='title' value='$title' autofocus size='48'><br /><br />";
				echo "<textarea placeholder='Content' name='content' rows='20' cols='50'>$content</textarea><br/>";
			}
		}
	?>
		<input type="submit" name="update" value="Update">
	</form>
</body>
</html>