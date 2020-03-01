<?php
include "connect.php";
?>
<html>


<?php
if(isset($_FILES['file_name']['tmp_name']))
{
	$title = $_POST['title'];
	$artist = $_POST['artist'];
	$file = $_FILES['file_name']["tmp_name"];
	$filename = $_FILES['file_name']['name'];
	$folder = "songs/".$filename;
	$path = "http://192.168.64.2/leaks/songs/".$filename;
	$path = preg_replace('/\s+/', '%20', $path);
	
	if(move_uploaded_file($file, $folder))
	{		
		$sql = "SELECT * FROM Artist WHERE name = '$artist'";
		$result = mysqli_query($con,$sql);
		$qResult = mysqli_num_rows($result);
		
		if($qResult == 0)
		{
			$sql = "INSERT INTO Artist (name, hometown) VALUES ('$artist', 'UNKNOWN')";
			mysqli_query($con,$sql);
		}
		
		
		$sql = "INSERT INTO Song (title, s_id, path, artist) VALUES ('$title', DEFAULT, '$path','$artist')";
		
		if($result = mysqli_query($con,$sql)){
			echo"<h1 align='center'>\"$title\" uploaded</h1>";
		}
	}
	else {
		echo"<h1 align='center'>\"$title\" not uploaded</h1>";
	}
	
}


?>

<div align="center" >
<h3><a href = "mainpage.php">RETURN</a><h3>
</div>
</html>
