<?php
include "connect.php";
?>
<html>
<head>
	<link rel="stylesheet" href="style.css">
</head>

<style>
body,h1,h2,h3,h4,h5,table {font-family: "Raleway", sans-serif}
h1 {font-size: 40;}
</style>


<div class="hero-image">
	<div class="hero-text">
		<?php echo"<h1 align='center'>PLAYLISTS</h1>"; ?>
		<p><a style="color: white; text-decoration: none;" href="mainpage.php">LIBRARY</a>
		•<a style="color: white; text-decoration: none;" href="artist.php?data=all">ARTISTS</a>
		 • <a style="color: white; text-decoration: none;" href="allplaylists.php?data=all">PLAYLISTS</a></p>
		<br>
		<div align="center">
		<form action="search.php" method="POST">
			<input type="text" name="search" placeholder="Search song or artist">
			<button type="submit" name="submit-search">Search</button>
		</form>
		</div>
	</div>
</div>
<br>

<title>Results</title>

<table align="center" border="1">
	<tr>
		<td align="center" valign="center" bgcolor="silver">
			<h4><b>Add Playlist</b></h4>
		</td>
	</tr>
	<tr>
		<td align="center">

	<form action="allplaylists.php?data=all" method="POST" enctype="multipart/form-data">
			<input type="text" name="title"  placeholder="Title"><br>
			<input type="file" name="img_name"  placeholder="img_name" >
			<br>
			<input type="submit" name="insert" value="Add Playlist">
		</form>
	</td>
	</tr>
</table>
	
<?php

if(isset($_POST['insert']))
{
	$title = $_POST['title'];
	$img = $_FILES['img_name']["tmp_name"];
	$filename = $_FILES['img_name']['name'];
	$folder = "art/".$filename;

	if(move_uploaded_file($img, $folder))
	{
		$sql = "INSERT INTO Playlist (title, image) VALUES ('$title', '$folder')";
		mysqli_query($con,$sql);
	}	
}

?>


<?php
	
		$sql = "SELECT * FROM Playlist";
		$result = mysqli_query($con,$sql);
		$qResult = mysqli_num_rows($result);
		
		
		if($qResult > 0){
		echo"
		<font face='Arial'>
		<table align='center' width='63%' border = '1' cellpadding ='5'>";
			echo"<tr height='50' bgcolor='silver'>
				<td align ='center' valign='middle'>
					<b>Artwork</b>
				</td>
				<td align ='center' valign='middle'>
					<b>Title</b>
				</td>
				</tr>";
			while($row = mysqli_fetch_assoc($result))
			{
				echo"
				<tr height='100px' width='100px'>
					<td align='center'>
						<img src='{$row['image']}' height='100px' width='100px'></img>
					</td>
					<td width ='375' align='center'>
						<a href='playlist.php?data={$row['title']}'>
						{$row['title']}</a><br>
				</td>
				</tr>";
				
			}
			echo"</font></table>";
		}
		else {
			echo"This are no playlists";
		}

	
?>
</html>
