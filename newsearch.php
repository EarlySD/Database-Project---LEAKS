<?php
include "connect.php";

?>
<head>
	<link rel="stylesheet" href="style.css">
</head>


<title>Results</title>
<h1 align='center'>Search Results</h1>
<h3><a href = "mainpage.php">Home</a><h3>

<?php
	if(isset($_POST['submit-search'])){
		$search = mysqli_real_escape_string($con,$_POST['search']);
		$sql = "SELECT * FROM Song WHERE artist LIKE '%$search%' OR title LIKE '%$search%'";
		$result = mysqli_query($con,$sql);
		$qResult = mysqli_num_rows($result);
		
		if($qResult > 0){
		echo"<font face='Arial'><table border = '1' cellpadding ='5'>";
			echo"<tr height='50'>
					<td align='center' valign='middle'>
						<b>Song</font></b>
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
				<td width ='375' align='center'>
					{$row['title']}
				</td>
				<td align ='center' width ='125'>
					{$row['artist']}
				</td></tr>";
				
		}
		}
		else {
			echo"There are no results matching your search!";
		}
	}
?>
</div>