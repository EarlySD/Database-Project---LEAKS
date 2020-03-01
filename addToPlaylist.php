<?php
include "connect.php";
$pname = $_GET["data"];
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
}

?>
<style>
body,h1,h2,h3,h4,h5,table {font-family: "Raleway", sans-serif}
h1 {font-size: 70;}
</style>

<html>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<body>


<div class="hero-image">
	<div class="hero-text">
		<h1>LEAKS</h1>
		<p><a style="color: white; text-decoration: none;" href="mainpage.php">LIBRARY</a>
		•<a style="color: white; text-decoration: none;" href="artist.php?data=all">ARTISTS</a>
		 • <a style="color: white; text-decoration: none;" href="allplaylists.php">PLAYLISTS</a></p>
	</div>
</div>

<br><br>

<div align="center" ><?php
echo"<h3><a href = 'playlist.php?data=$pname'>RETURN</a><h3>" ?>
</div>

<br><br>


<title>LEAKS</title>



<?php

$sql = "SELECT * FROM Song";
$result = mysqli_query($con,$sql);



if($result)
{
	echo"<font face=''>
			<table style='width:50%; 'align='center'  border = '1' cellpadding ='5'>";
	echo"<tr height='50' bgcolor='silver'>
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
			<b>Add</b>
		</td>
		</tr>";
	while($row = mysqli_fetch_assoc($result)){
		echo"
		<tr><td>
				<audio controls>
				<source src = {$row['path']} type='audio/mp3'>
				Your browser does not support the audio tag.
				</audio>
		</td>
		<td width ='375' align='center'><div style='font-size: 14'>
			{$row['title']}
		</div></td>
		<td align ='center' width ='125'><div style='font-size: 15'>
			<a href = 'artist.php?data={$row['artist']}'>{$row['artist']}</a>
		</td>
		<td><form action='addToPlaylist.php?data=$pname&id={$row['title']}' method='POST'>
			<button style='height:40px' type='submit' name='add'><b>ADD</b></button></form>
		</td>
		</tr></div>";
	}
	echo"</font></table>";

}

if(isset($_POST['add']))
{
	$sql = "SELECT * FROM Song WHERE playlist IS NOT NULL AND title ='$id'";
	$result = mysqli_query($con,$sql);
	
	 $qResult = mysqli_num_rows($result);
		
	if($qResult > 0)
	{
		$row = mysqli_fetch_assoc($result);
		
		$sql = "INSERT INTO Song (title, path, artist, playlist) VALUES ('{$row['title']}', '{$row['path']}', '{$row['artist']}', '$pname')";
		
			
			$result = mysqli_query($con,$sql);
			
	}
	else
	{
		$sql = "UPDATE Song SET playlist = '$pname' WHERE title='$id'";
		
		$result = mysqli_query($con,$sql);	
	}
}

?>
</body>
</html>