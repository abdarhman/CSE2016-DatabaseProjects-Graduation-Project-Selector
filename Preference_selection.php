<?php
    $connection = mysqli_connect('127.0.0.1','root','Abdarhman93','ProjectDb');
    if(mysqli_connect_errno())
    {
        die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
    }
?>
<?php   
    if (isset($_POST['submit']))
    {
        $first = isset($_POST['1stpref']) ? $_POST['1stpref'] : "" ;
        $second = isset($_POST['2ndpref']) ? $_POST['2ndpref'] : "" ;
        $third = isset($_POST['3rdpref']) ? $_POST['3rdpref'] : "" ; 
        //update data
        $query  = "UPDATE chooses SET ";
        $query .= "1st_pref = {$first}, ";
        $query .= "2nd_pref = {$second}, ";
        $query .= "3rd_pref = {$third} ";
        $query .= "WHERE bench_no = {$id}";

        $result = mysqli_query($connection, $query);

        //if ($result && mysqli_affected_rows($connection) == 1) {
          // Success
        //} else {
          // Failure
          // $message = "Subject update failed";
        //  die("Database query failed213. " . mysqli_error($connection));
        //}

        add_to_project($id,$connection);
      ?>
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
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Preferences</title>

    <!-- Bootstrap core CSS -->
    <link href="Off%20Canvas%20Template%20for%20Bootstrap_files/bootstrap.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="Off%20Canvas%20Template%20for%20Bootstrap_files/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="Off%20Canvas%20Template%20for%20Bootstrap_files/offcanvas.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="Off%20Canvas%20Template%20for%20Bootstrap_files/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php 
      $id = $_GET["bn"];
    ?>
    
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project Selector</a>
        </div>
        <div style="" aria-expanded="true" id="navbar" class="navbar-collapse collapse in">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">Current Students' Distribution</a></li>
            <li><a href="#contact">Submit Preferences</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->
    <div class="container">
    <form method = "post" action = "Preference_selection.php?bn=<?php echo $id ;?>" class="form-signin">
        <h2 class="form-signin-heading">Please select your preference by typing the project name</h2>
        <label for="inputEmail" class="sr-only">1st Preference</label>
        <input id="inputEmail" name = "1stpref" class="form-control" placeholder="Your bench number" required="" autofocus="" type="text">
        <label for="inputEmail" class="sr-only">2nd Preference</label>
        <input id="inputEmail" name = "2ndpref" class="form-control" placeholder="Your bench number" required="" autofocus="" type="text">
        <label for="inputEmail" class="sr-only">3rd Preference</label>
        <input id="inputEmail" name = "3rdpref" class="form-control" placeholder="Your bench number" required="" autofocus="" type="text">
        <button class="btn btn-lg btn-primary btn-block" name = "submit" type="submit">Submit</button>
    </form>      
    </div><!--/.container  <footer class = "masfoot" bottom:0>
        <p>© 2015 Company, Inc.</p>
      </footer>-->
    <div class="masfoot navbar-fixed-bottom text-center">
            <div >
              <p>Built for Database project @ the faculty of Engineering Ain Shams University, by Team [ 21 ].</p>
            </div>
    </div>
    <script src="Off%20Canvas%20Template%20for%20Bootstrap_files/jquery.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="Off%20Canvas%20Template%20for%20Bootstrap_files/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="Off%20Canvas%20Template%20for%20Bootstrap_files/ie10-viewport-bug-workaround.js"></script>
    <script src="Off%20Canvas%20Template%20for%20Bootstrap_files/offcanvas.js"></script>
</body></html>
