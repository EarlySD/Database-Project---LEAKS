<?php
include "connect.php";
session_start();
?>
<html>
<head>
	<link rel="stylesheet" href="style.css">
</head>


<title>Results</title>
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
<br>
<div align="center">

<form action="search.php" method="POST">
	<input type="text" name="search" placeholder="Search song or artist">
	<button type="submit" name="submit-search">Search</button>
</form>
</div>
<br>



<?php
	if(isset($_POST['submit-search'])){
		
		$search = mysqli_real_escape_string($con,$_POST['search']);
		
		$sql = "SELECT * FROM Song WHERE title LIKE '%$search%'";
		$result = mysqli_query($con,$sql);
		$qResult = mysqli_num_rows($result);
		
		
		if($qResult > 0){
		echo"
		<font face='Arial'>
		<table style ='float: left' align='center' width='50%' border = '1' cellpadding ='5'>";
			echo"<tr>
					<th colspan='3' align='center'>Songs</th>
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
				</td></tr>";
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
				</td></tr>";
				
			}
			echo"</font></table>";
		}
		else {
			echo"There are no Songs matching your search!<br>";
		}
		
		$sql = "SELECT * FROM Artist WHERE name LIKE '%$search%'";
		$result = mysqli_query($con,$sql);
		$qResult = mysqli_num_rows($result);
		
		if($qResult > 0){
		echo"
		<font face='Arial'>
		<table  align='center' width = '25%'border = '1' cellpadding ='5'>";
			echo"<tr>
					<th align='center'>Artists</th>
				</tr>
				<tr height='50' bgcolor='silver'>
					<td align='center' valign='middle'>
						<b>Name</b>
					</td>
				</tr>";
			while($row = mysqli_fetch_assoc($result))
			{
				echo"
				<tr height = '50'>
					<td align='center'>
						<a href = 'artist.php?data={$row['name']}'>{$row['name']}</a>
					</td>
				</tr>";
				
			}
			echo"</font></table>";
		}
		else {
			echo"There are no Artists matching your search!";
		}

	}
?>
</html>