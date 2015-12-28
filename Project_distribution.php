<?php
    $connection = mysqli_connect('127.0.0.1','root','Abdarhman93','ProjectDb');
    if(mysqli_connect_errno())
    {
        die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
    }
?>
<?php 
  function select_query($connection,$table,$attribute,$test)
  {
    $query  = "SELECT * ";
    $query .= "FROM {$table} ";
    $query .= "WHERE {$attribute} = {$test}" ;
    $result = mysqli_query($connection, $query);
    if (!$result) 
    {
      die("Database query failed.");
    }
    return $result; 
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

    <title>Students Distribution</title>

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
      $bench_no = $_GET["bn"];
    ?>
    <?php 
      $dept_name;
      $projects_arr = array();
      $counter = 0;
      
      $student_bench_no_query = select_query($connection,"students","bench_no",$bench_no);
      while($data = mysqli_fetch_assoc($student_bench_no_query))
      {
        $dept_name = $data["dept_name"];        
      }
      $dept_name_query = select_query($connection,"brought_by","dept_name","'{$dept_name}'");
      while($data2 = mysqli_fetch_assoc($dept_name_query))
      {
        $projects_arr[$counter] = $data2["project_id"];
        $counter ++;        
      }
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
            <li ><a href="Projects.php?bn=<?php echo $bench_no ; ?>">Home</a></li>
            <li class="active"><a href="#about">Current Students' Distribution</a></li>
            <li><a href="#contact">Submit Preferences</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h1><?php echo $dept_name;?>'s Projects' Distribution</h1>
          </div>
          <div class="row">
          <?php
            for($i = 0; $i < $counter;$i++ )
            {
              $projects_id_query = select_query($connection,"projects","project_id",$projects_arr[$i]);
              while($data3 = mysqli_fetch_assoc($projects_id_query))
              {
                ?>
                <div class="col-sm-6 col-md-6">
                  <div class="thumbnail">
                    <div class="caption">
                      <h3><?php echo $data3["project_name"];?></h3>
                      <ul class="list-group">
                      <?php 
                        $selected_projects_query = select_query($connection,"chooses","selected_project",$projects_arr[$i]);
                        while($data4 = mysqli_fetch_assoc($selected_projects_query))
                        {
                          $student_bench_no2 = $data4["bench_no"];
                          $student_name_query = select_query($connection,"students","bench_no",$student_bench_no2);
                          while($data5 = mysqli_fetch_assoc($student_name_query))
                          {
                            ?>
                            <li class="list-group-item">
                            <span class="badge"> <?php echo $data5["grade"]; ?> </span>
                              <?php echo $data5["name"]; ?>
                            </li>  
                            <?php       
                          }
                        }
                      ?>
                      </ul>
                    </div>
                    <p><a href="Project_details.php?project= <?php echo $projects_arr[$i]; ?>" class="btn btn-primary" role="button">View Project</a> 
                  </div>                  
                </div>
                <?php
              }
            }
          ?>
        </div><!--/.col-xs-12.col-sm-9-->

        <!--<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="#" class="list-group-item active">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
          </div>
        </div>
      </div>-->

      <hr>
      
      

    </div><!--/.container  <footer class = "masfoot" bottom:0>
        <p>© 2015 Company, Inc.</p>
      </footer>-->
    <div class="masfoot navbar-fixed-bottom text-center">
            <div >
              <p>Built for Database project @ the faculty of Engineering Ain Shams University, by Team [].</p>
            </div>
          </div>
   


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="Off%20Canvas%20Template%20for%20Bootstrap_files/jquery.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="Off%20Canvas%20Template%20for%20Bootstrap_files/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="Off%20Canvas%20Template%20for%20Bootstrap_files/ie10-viewport-bug-workaround.js"></script>
    <script src="Off%20Canvas%20Template%20for%20Bootstrap_files/offcanvas.js"></script>
  

</body></html>