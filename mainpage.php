<?php
include "connect.php";
session_start();

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

<table style="width:30%" border="1" align="center">

<tr height = "125">
	<td>
		<div align="center">
		<p><b><u>Search Database</u></b></p>
		<form action="search.php" method="POST">
			<input type="text" name="search" placeholder="Search song or artist">
			<button type="submit" name="submit-search">Search</button>
		</form>
		</div>
	</td>

	<td>
		<div align="center">
		<p><b><u>Add Song</u></b></p>

		<form action="addsong.php" method="POST" enctype="multipart/form-data" >
			<input type="text" name="title"  placeholder="Title">
			<input type="text" name="artist"  placeholder="Artist">
			<input type="file" name="file_name"  placeholder="file_name" >
			<input type="submit" name="insert" value="Upload">
		</form>
		</div>
	</td>
	<td>
		<div align="center">
		<p align="center"><b><u>Delete Song</u></b></p>
		<form action="delete.php" method="GET">
		<input type="text" name="dtitle" placeholder="Title">
		<button type="submit" name="delete" value="Delete">Delete</button>
		</div>
	</td>
	
</tr>


</table>

<title>LEAKS</title>



<?php

$sql = "SELECT * FROM Song";
$result = mysqli_query($con,$sql);



if($result)
{
	echo"<font face=''>
			<table style='width:50%;' align='center'  border = '1' cellpadding ='5'>";
	echo"<tr height='50' bgcolor='silver'>
			<td align='center' valign='middle'>
				<b>Song</b>
			</td>
		<td align ='center' valign='middle'>
			<b>Title</b>
		</td>
		<td width ='100' align='center' valign='middle'>
			<b>Artist</b>
		</td></tr>";
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
		</td></tr></div>";
	}
	echo"</font></table>";

}


?>
</body>
</html>