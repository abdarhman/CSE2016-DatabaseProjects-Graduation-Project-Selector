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
  	$project = $_GET["project"];
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

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
  <?php
  	$query2  = "SELECT * ";
    $query2 .= "FROM projects ";
    $query2 .= "WHERE project_id = {$project}" ;
    $result2 = mysqli_query($connection, $query2);
    while($data2 = mysqli_fetch_assoc($result2))
    {
    	?>
    	<div class="jumbotron">
            <h1><?php echo $data2["project_name"];?></h1>
        </div>
        <div class="row">
        	<div class="col-xs-12 col-lg-4">
        		<h2>Supervisors</h2>
                <p>
                   <?php 
                   	$query3  = "SELECT * ";
				    $query3 .= "FROM projects_staff_members ";
				    $query3 .= "WHERE project_id = {$project}" ;
				    $result3 = mysqli_query($connection, $query3);
				    while ($data3 =  mysqli_fetch_assoc($result3))
				    {
				    	$query4  = "SELECT * ";
					    $query4 .= "FROM staff_members ";
					    $query4 .= "WHERE staff_id = {$data3["staff_id"]}" ;
					    $result4 = mysqli_query($connection, $query4);
					    while ($data4 = mysqli_fetch_assoc($result4))
					    {
					    	echo $data4["title"]. " ".$data4["name"].<br />;
					    }

				    }
                   ?>
                </p>
                <h2>Details</h2>
                <p>
                   <?php echo $data2["detailed_disc"];?>
                </p>
            </div>
        <?php
    }
  ?>
    <div class="masfoot navbar-fixed-bottom text-center">
            <div >
              <p>Built for Database project @ the faculty of Engineering Ain Shams University, by Team [].</p>
            </div>
          </div>