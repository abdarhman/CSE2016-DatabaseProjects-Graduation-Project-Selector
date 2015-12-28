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
	function add_to_project($bench_no,$connection)
	{
		$counter = 0;
		$curr_student_grade;
		$curr_arr = array();
		$max_num = 0;
		$pref_arr = array();
		
		
		$query5  = "UPDATE chooses SET ";
		$query5 .= "selected_project = 0 ";
		$query5 .= "WHERE bench_no = {$bench_no}";

		$result5 = mysqli_query($connection, $query5);
		if ($result5 ) {
			// Success
		} else {
			// Failure
			// $message = "Subject update failed";
			die("Database query failed5. " . mysqli_error($connection));
		}
		//get student preferences.
		$query6  = "SELECT * ";
		$query6 .= "FROM chooses ";
		$query6 .= "WHERE bench_no = {$bench_no}" ;
		$result6 = mysqli_query($connection, $query6);
		if (!$result6) {
			die("Database query failed6.");
		}
		while($data6 = mysqli_fetch_assoc($result6))
			{
				$pref_arr[0] = $data6["1st_pref"];
				$pref_arr[1] = $data6["2nd_pref"];
				$pref_arr[2] = $data6["3rd_pref"];
				
			}
		
		
		
		for($i =0 ; $i <3 ; $i++)
		{
			$query1  = "SELECT * ";
			$query1 .= "FROM chooses ";
			$query1 .= "WHERE selected_project = {$pref_arr[$i]}" ;
			$result1 = mysqli_query($connection, $query1);
			if (!$result1) {
				die("Database query failed1.");
			}
			
			while($data1 = mysqli_fetch_assoc($result1))
			{
				
				$query3  = "SELECT * ";
				$query3 .= "FROM students ";
				$query3 .= "WHERE bench_no = {$data1["bench_no"]}" ;
				$result3 = mysqli_query($connection, $query3);
				if (!$result3) {
					die("Database query failed3.");
				}
				while($data3 = mysqli_fetch_assoc($result3))
				{
					$curr_arr["{$data1["bench_no"]}"] = "{$data3["grade"]}";
				}
				$counter ++;
				
			}
			$query2  = "SELECT * ";
			$query2 .= "FROM projects ";
			$query2 .= "WHERE project_id = {$pref_arr[$i]}" ;
			$result2 = mysqli_query($connection, $query2);
			
			if (!$result2) {
				die("Database query failed2.");
			}
			
			while($data2 = mysqli_fetch_assoc($result2))
			{
				$max_num = $data2["max_number"];
				
			}
			if($counter < $max_num)
			{
				$query  = "UPDATE chooses SET ";
				$query .= "selected_project = '{$pref_arr[$i]}' ";
				$query .= "WHERE bench_no = {$bench_no}";

				$result = mysqli_query($connection, $query);
			
				if ($result && mysqli_affected_rows($connection) == 1) {
					// Success
				} else {
					// Failure
					// $message = "Subject update failed";
					die("Database query failed0. " . mysqli_error($connection));
				}
			break;
			} elseif($counter == $max_num) {
				asort($curr_arr);
				$query4  = "SELECT * ";
				$query4 .= "FROM students ";
				$query4 .= "WHERE bench_no = {$bench_no}" ;
				$result4 = mysqli_query($connection, $query4);
				if (!$result4) {
					die("Database query failed4.");
				}
				while($data4 = mysqli_fetch_assoc($result4))
				{
					$curr_student_grade = $data4["grade"];
				}
				if(reset($curr_arr) < $curr_student_grade)
				{
					$query  = "UPDATE chooses SET ";
					$query .= "selected_project = '{$pref_arr[$i]}' ";
					$query .= "WHERE bench_no = {$bench_no}";

					$result = mysqli_query($connection, $query);
				
					if ($result && mysqli_affected_rows($connection) == 1) {
						// Success
					} else {
						// Failure
						// $message = "Subject update failed";
						die("Database query failed01. " . mysqli_error($connection));
					}
					$student_key = key($curr_arr);
					add_to_project("{$student_key}",$connection);
				break;
				}
				
				
			}	
			
			
		}
		
		
	}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
  <head>
    <title>Submit Preferences</title>
  </head>
  <body>
<?php 
	$preference = array(1,2,3);
	$id = $_GET["bench_no"];

?>

<?php 
	//update data
	$query  = "UPDATE chooses SET ";
	$query .= "1st_pref = {$preference[0]}, ";
	$query .= "2nd_pref = {$preference[1]}, ";
	$query .= "3rd_pref = {$preference[2]} ";
	$query .= "WHERE bench_no = {$id}";

	$result = mysqli_query($connection, $query);

	//if ($result && mysqli_affected_rows($connection) == 1) {
		// Success
	//} else {
		// Failure
		// $message = "Subject update failed";
	//	die("Database query failed213. " . mysqli_error($connection));
	//}

	add_to_project($id,$connection);
?>
  
  
  
  </body>
</html>
