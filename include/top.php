<!DOCTYPE html>
<html>
<head>

	<!-- Hanterar scaling till mobila enheter -->
	<meta charset="iso-8859-1">
	
	<!-- <script src="js/javascript.js"></script> -->
	<link rel="stylesheet" type="text/css" href="include/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="include/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="include/datepicker/css/datepicker.css">

	<title>Tidrapportering för examensarbete</title>
</head>
<body>

<?php 
require_once 'core/init.php';

$messages = array (

  'success' => "<div style='width:25%;' class='alert alert-success alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
  <strong> ",

  'danger' => "<div style='width:25%;' class='alert alert-danger alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
  <strong>  ",

  'end' => "</strong> </div>"


    );
?>


<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="include/bootstrap/js/bootstrap.js"></script>
<script src="include/datepicker/js/bootstrap-datepicker.js"></script>



<div class="row">
  <div class="col-sm-2">
    <div class="sidebar-nav" style="width: 70%;">
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="visible-xs navbar-brand">Meny</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class="nav navbar-nav">
            <li id="tidrapportering"><a href="index.php">Tidrapportering</a></li>
            <li id="statistik"><a href="statistics.php">Statistik</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <div class="col-sm-10">
 
