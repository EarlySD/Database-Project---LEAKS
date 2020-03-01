<?php
include "connect.php";
?>
<html>


<?php
if(isset($_GET['delete']))
{


	$title = $_GET['dtitle'];
	
	$query = "SELECT * FROM Song WHERE title = '$title'";
	
	$res = mysqli_query($con,$query);
	
	if($res->num_rows > 0)
	{
		$sql = "DELETE FROM Song WHERE title ='$title'";
		
		$result = mysqli_query($con,$sql);
		
		if($result)
		{
			echo "<h1 align='center'>Song $title Deleted</h1>";
		}
	}
	else {
		echo "<h1 align='center'>Song $title Not Found</h1>";
	}
}


?>

<div align="center" >
<h3><a href = "mainpage.php">RETURN</a><h3>
</div>
</html>
