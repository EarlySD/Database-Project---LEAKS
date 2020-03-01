<?php
include "connect.php";
$search = $_GET["data"];
if($search != "all"){

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
		<?php echo"<h1 align='center'>$search</h1>"; ?>
		<p><a style="color: white; text-decoration: none;" href="mainpage.php">LIBRARY</a>
		•<a style="color: white; text-decoration: none;" href="artist.php?data=all">ARTISTS</a>
		 • <a style="color: white; text-decoration: none;" href="allplaylists.php?data=all">PLAYLISTS</a></p>
	</div>
</div>


<title>Results</title>

<div align="center">
<div  >
<h3><a href = "mainpage.php">Home	</a><h3>
</div>

<div >
<form action="search.php" method="POST">
	<input type="text" name="search" placeholder="Search song or artist">
	<button type="submit" name="submit-search">Search</button>
</form>
</div>
<br>



<?php
	
		$sql = "SELECT * FROM Song WHERE artist = '$search'";
		$result = mysqli_query($con,$sql);
		$qResult = mysqli_num_rows($result);
		
		
		if($qResult > 0){
		echo"
		<font face='Arial'>
		<table align='center' width='63%' border = '1' cellpadding ='5'>";
			echo"<tr height='50' bgcolor='silver'>
					<td align='center' valign='middle'>
						<b>Song</b>
					</td>
				<td align ='center' valign='middle'>
					<b>Title</b>
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
					{$row['title']}<br>
				</td>
				</tr>";
				
			}
			echo"</font></table>";
		}
		else {
			echo"This artist has no songs";
		}
}
else{
	
?>

<html >
<head>
	<link rel="stylesheet" href="style.css">
</head>

<style>
body,h1,h2,h3,h4,h5,table {font-family: "Raleway", sans-serif}
h1 {font-size: 40;}
</style>




<div class="hero-image">
	<div class="hero-text">
		<?php echo"<h1 align='center'>ARTISTS</h1>"; ?>
		<p><a style="color: white; text-decoration: none;" href="mainpage.php">LIBRARY</a>
		•<a style="color: white; text-decoration: none;" href="artist.php?data=all">ARTISTS</a>
		 • <a style="color: white; text-decoration: none;" href="allplaylists.php?data=all">PLAYLISTS</a></p>
	</div>
</div>


<title>Results</title>

<div align="center">
<div  >
<h3><a href = "mainpage.php">Home	</a><h3>
</div>

<div >
<form action="search.php" method="POST">
	<input type="text" name="search" placeholder="Search song or artist">
	<button type="submit" name="submit-search">Search</button>
</form>
</div>
<br>



<?php

if($search == "all"){
	
	$sql = "SELECT * FROM Artist";
	$result = mysqli_query($con,$sql);
	$qResult = mysqli_num_rows($result);
	
	if($qResult > 0){
	echo"
	<font face='Arial'>
	<table  align='center' width = '25%'border = '1' cellpadding ='5'>";
		echo"
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
		echo"There are no Artists available";
	}
	
}
}
?>
</html>