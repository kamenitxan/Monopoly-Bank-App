<?php include("core/core.php"); ?>
<!DOCTYPE html>
<html lang="cz">
<head>
	<meta charset="utf-8" />
	<title><?php echo $title ?></title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="../../assets/ico/favicon.png">
 
	<!-- Bootstrap core CSS -->
    <link href="core/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="core/css/bootstrap-theme.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="core/js/html5shiv.js"></script>
      <script src="core/js/respond.min.js"></script>
    <![endif]-->
    
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">Monopoly Bank App</a>
	    </div>
	    <div class="collapse navbar-collapse">
	      <ul class="nav navbar-nav">
	        <li><a href="index.php">Úvod</a></li>
	        <li><a href="hrac.php?jmeno=<?php echo($_COOKIE['hrac']) ?>">Účet</a></li>
	        <li><a href="banker.php">Bankéř</a></li>
	      </ul>
	    </div><!--/.nav-collapse -->
	</div> 
