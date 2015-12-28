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
    <title>Projects List</title>
  </head>
  <body>
	<?php 
		$bench_no = $_GET["bench_no"];
		$dept_name;
	
	?>
  
  <?php 
//create query
	$query  = "SELECT * ";
	$query .= "FROM students ";
	$query .= "WHERE bench_no = " . $bench_no ;
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("Database query failed.");
	}
?>
<?php 
	while($data = mysqli_fetch_assoc($result))
	{
		$dept_name = $data["dept_name"];
	}


?>
<?php 
//create query
	$query3  = "SELECT * ";
	$query3 .= "FROM brought_by ";
	$query3 .= "WHERE dept_name = '" . $dept_name . "'" ;
	$result3 = mysqli_query($connection, $query3);
	
	if (!$result3) {
		die("Database query failed2.");
	}
?>

<?php 
	$array = array();
	$i = 0;
	while($data3 = mysqli_fetch_assoc($result3))
	{
		//var_dump( $data3 );
		//echo  "<hr />";
		$array[$i] = $data3["project_id"];
		$i++;
	}
	
	
?>


<?php 
//create query
foreach($array as $id)
{
	$query2  = "SELECT * ";
	$query2 .= "FROM projects ";
	$query2 .= "WHERE project_id = {$id}" ;
	$result2 = mysqli_query($connection, $query2);
	
	if (!$result2) {
		die("Database query failed2.");
	}
?>
 <?php 
 	while($data2 = mysqli_fetch_assoc($result2))
	{
		
		
		echo "project name: " . $data2["project_name"] . "<br \>";
		echo "Max Number of Students: " . $data2["max_number"] . "<br \>";
		echo "OverView: ". $data2["brief_disc"] . "<br \>";
?>
	<a href ="project_details.php?project_id ={$id}" ><?php echo "More details";?></a>
<?php 	
		echo "<br \>";
	}
}
?>
<a href ="preferences.php" ><?php echo "Submit Preferences";?></a>

<?php 
	mysqli_free_result($result);
	mysqli_free_result($result2);
  
?>
  </body>
</html>
<?php 
mysqli_close($connection);
?>