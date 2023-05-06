<?php
session_start();

?>

//<?php
//if (!isset($_SESSION['username']))
//{
//	header("Location:movieMoviesoff.php");
//}
//?>

<!DOCTYPE html>
<html lang="en">
<head>

  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      max-width: 100%; /* Set width to 100% */
      margin: auto;
      height:auto;
	  /*width:640px;*/
  /*height:360px;*/
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
	
  width:640px;
  height:360px;

  }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
<br />
<?php 
if (!isset($_SESSION['username'])) 
{
include("navBarOff.html");
}
else
{
	if($_SESSION['usertype']==1)
	{
		include("movieMoviesAdmin.html");
		
	}
	else
	{
	include("navBarOn.html");
	}
}
?>
 <!-- <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Westerwald Cinemas</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li ><a href="movieMenu.php">Home</a></li>
        <li class="active"><a href="movieMovies.php">Movies</a></li>
        <li><a href="#">Book</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
	  
        <li><a href="movieLogout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
  -->
</nav>
<br />
<?php
include("movieFilms.php");
$film= new Film();
$film-> showFilms();

?>
</body>
</html>