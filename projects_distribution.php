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

<?php 
	function select_query($connection,$table,$attribute,$test)
	{
		//create query
	$query  = "SELECT * ";
	$query .= "FROM {$table} ";
	$query .= "WHERE {$attribute} = {$test}" ;
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("Database query failed.");
	}
	return $result;	
	}
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
  <head>
    <title>untitled</title>
  </head>
  <body>
<?php 
	$bench_no = 43716;
	$dept_name;
	$projects_arr = array();
	$counter = 0;
	
	$student_bench_no = select_query($connection,"students","bench_no",$bench_no);
	
	while($data = mysqli_fetch_assoc($student_bench_no))
	{
		$dept_name = $data["dept_name"];
		
	}
	$dept_name_query = select_query($connection,"brought_by","dept_name","'{$dept_name}'");
	
	while($data2 = mysqli_fetch_assoc($dept_name_query))
	{
		$projects_arr[$counter] = $data2["project_id"];
		$counter ++;
		
	}
	
	for($i = 0; $i < $counter;$i++ )
	{
		$projects_id_query = select_query($connection,"projects","project_id",$projects_arr[$i]);
		while($data3 = mysqli_fetch_assoc($projects_id_query))
		{
			echo $data3["project_name"] . "<br \>";
			$selected_projects_query = select_query($connection,"chooses","selected_project",$projects_arr[$i]);
			while($data4 = mysqli_fetch_assoc($selected_projects_query))
			{
				$student_bench_no2 = $data4["bench_no"];
				$student_name_query = select_query($connection,"students","bench_no",$student_bench_no2);
				while($data5 = mysqli_fetch_assoc($student_name_query))
				{
					echo $data5["name"] . "<br \>";
					
				}
			}
			
		}
		echo "<hr \>";
	}
	
	
?>
  
  
  
  </body>
</html>
