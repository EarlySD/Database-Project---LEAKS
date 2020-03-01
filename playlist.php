<?php
include "connect.php";
$data = $_GET["data"];
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
}
?>
<html>
<head>
	<link rel="stylesheet" href="style.css">
</head>

<style>
body,h1,h2,h3,h4,h5,table {font-family: "Raleway", sans-serif}
h1 {font-size: 40;}
</style>


echo"<div class='hero-image'>
	<div class='hero-text'>
		 <h1 align='center'>PLAYLISTS</h1>
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
<?php
$sql = "SELECT * FROM Playlist WHERE title = '$data'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);

echo"<img style='float: left' src='{$row['image']}' height='150px' width='150px' border='5'></img>";
?>

<title>Results</title>
<?php
echo"<form align='center' action='addToPlaylist.php?data=$data' method='POST'>" ?>
<button style="height:40px" type="submit" name="submit-search"><b>Add to Playlist</b></button><br><br>
<?php
	
		$sql = "SELECT * FROM Song WHERE Playlist LIKE '$data'";
		$result = mysqli_query($con,$sql);
		$qResult = mysqli_num_rows($result);
		
		
		if($qResult > 0){
		echo"
		<font face='Arial'>
		<table align='center' width='50%' border = '1' cellpadding ='5'>";
			echo"<tr>
					<th colspan='4' align='center'>$data</th>
				</tr>
				<tr height='50' bgcolor='silver'>
					<td align='center' valign='middle'>
						<b>Song</b>
					</td>
				<td align ='center' valign='middle'>
					<b>Title</b>
				</td>
				<td width ='100' align='center' valign='middle'>
					<b>Artist</b>
				</td>
				<td width ='100' align='center' valign='middle'>
					<b>Remove</b>
				</td>
				</tr>";
			while($row = mysqli_fetch_assoc($result))
			{
				echo"
				<tr><td>
						<audio controls>
						<source src = {$row['path']} type='audio/mp3'>
						Your browser does not support the audio tag.
						</audio>
				</td>
				<td width ='375' align='center'>
					{$row['title']}
				</td>
				<td align ='center' width ='125'>
					{$row['artist']}
				</td>
				<td><form action='playlist.php?data=$data&id={$row['title']}' method='POST'>
					<button style='height:40px' type='submit' name='remove'><b>REMOVE</b></button></form>
				</td>
				</tr>";
				
			}
			echo"</font></table>";
		}
		
if(isset($_POST['remove']))
{
	$sql = "UPDATE Song SET playlist = NULL WHERE title='$id'";
	
	$result = mysqli_query($con,$sql);
	
	header("Refresh:0");

}
	
?>

</html>
