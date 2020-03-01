<?php
include "connect.php";
?>
<html>


<?php
if(isset($_POST['update']))
{

	$title = $_POST['newtitle'];
	$oldTitle = $_POST['oldtitle'];
	

	
	$query = "SELECT * FROM Song WHERE title = '$oldTitle'";
	
	$res = mysqli_query($con,$query);
	
	if($res->num_rows > 0)
	{
		$sql = "UPDATE Song SET title = '$title' WHERE title = '$oldTitle'";
		
		if($result)
		{
			echo "<h1 align='center'>Song $oldTitle Updated to $title</h1>";
		}
	}
	else {
		echo "<h1 align='center'>Song $oldTitle Not Found</h1>";
	}
}


?>

<div align="center" >
<h3><a href = "mainpage.php">RETURN</a><h3>
</div>
</html>
