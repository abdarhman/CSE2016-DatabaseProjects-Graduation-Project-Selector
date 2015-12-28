	<?php
	//connect to db

	$connection = mysqli_connect('localhost','manager','ssmtt','grade_projects');
	if(mysqli_connect_errno())
	{
		die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")");
	
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
  <head>
    <title>login</title>
  </head>
  <body>
<?php   
	$name = 43716;
	$pass = "secret";
	
?>

<?php 
//create query
	$query  = "SELECT * ";
	$query .= "FROM students ";
	$query .= "WHERE bench_no = " . $name ;
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("Database query failed.");
	}
?>

<?php 
//use data
		while($data = mysqli_fetch_assoc($result))
		{
		if($pass == $data["password"])
		{
			$bench_no = $data["bench_no"];
			header("Location: projects_list.php?bench_no={$bench_no}");
			//exit;
		}
		else
		{
			echo "failed login";
		}
		}
?>
<?php
	mysqli_free_result($result);
?>

  </body>
</html>
<?php
mysqli_close($connection);
?>