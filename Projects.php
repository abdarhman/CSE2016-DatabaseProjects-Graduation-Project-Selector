<?php
    $connection = mysqli_connect('127.0.0.1','root','Abdarhman93','ProjectDb');
    if(mysqli_connect_errno())
    {
        die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
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

    <title>Projects</title>

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
      $dept_name;  
    ?>
    <?php 
      $query  = "SELECT * ";
      $query .= "FROM students ";
      $query .= "WHERE bench_no = {$bench_no} ";
      $result = mysqli_query($connection, $query);
      while($data = mysqli_fetch_assoc($result))
      {
        $dept_name = $data["dept_name"];
      }
    ?>
    <?php 
      $query3  = "SELECT * ";
      $query3 .= "FROM brought_by ";
      $query3 .= "WHERE dept_name = '" . $dept_name . "'" ;
      $result3 = mysqli_query($connection, $query3);
      $array = array();
      $i = 0;
      while($data3 = mysqli_fetch_assoc($result3))
      {
        $array[$i] = $data3["project_id"];
        $i++;
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
            <li class="active"><a href="#">Home</a></li>
            <li><a href="Project_distribution.php?bn=<?php echo $bench_no ; ?>">Current Students' Distribution</a></li>
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
            <h1><?php echo $dept_name;?>'s Projects</h1>
            <p>
              Please review and select your project carefully <br />
              Deadline is on Saturday 26th of December.
            </p>
          </div>
          <div class="row">
          <?php
            foreach($array as $id)
            {
              $query2  = "SELECT * ";
              $query2 .= "FROM projects ";
              $query2 .= "WHERE project_id = {$id}" ;
              $result2 = mysqli_query($connection, $query2);
              while($data2 = mysqli_fetch_assoc($result2))
              {
          ?>
                <div class="col-xs-6 col-lg-4">
                  <h2><?php echo $data2["project_name"]?></h2>
                  <p>
                    <?php echo $data2["brief_disc"] ."<br />";?>
                    <?php echo "Max number of students : ".$data2["max_number"] ;?>
                  </p>
                  <p><a class="btn btn-default" href="Project_details.php?project= <?php echo $data2["project_id"]; ?>" role="button">View details »</a></p>
                </div><!--/.col-xs-6.col-lg-4-->
          <?php
              }
            } 
          ?>            
          </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->
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