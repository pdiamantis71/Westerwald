<?php
session_start();
include("movieUser.php");
if (isset($_SESSION['username']))
{
	header("Location:movieMenu.php");
}
?>
<?php//gets data from form
if (isset($_REQUEST['username'])){
	$u1 = new movieUser();
	$u1->username=$_REQUEST['username'];
	$u1->password=$_REQUEST['password'];
	$u1->name=$_REQUEST['name'];
	$u1->email=$_REQUEST['email'];
	$u1->usertype=0;
	$u1->signup();
}
?>

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

<nav class="navbar navbar-inverse navbar-fixed-top"">
  <div class="container-fluid">
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
        <li><a href="movieIndex.php">Home</a></li>
        <li><a href="movieMovies.php">Movies</a></li>
        <li><a href="movieBook.php">Book</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
	  <li class="active"><a href="movieSignUp.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li ><a href="movieLogin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <h3>Collapsible Navbar</h3>
  <p></p>
  <p></p>
</div>

<div class="container">
  <h2>Sign Up</h2>
  <form action="movieSignUp.php" method="POST" class="was-validated">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="username" name="username" class="form-control" id="username" placeholder="Enter Username" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
    </div>
	<div class="form-group">
      <label for="name">Name:</label>
      <input type="name" name="name" class="form-control" id="name" placeholder="Enter your Name" required>
    </div>
	<div class="form-group">
      <label for="admin">Email:</label>
      <input type="email" name="email" class="form-control" id="emain" placeholder="Enter E-mail" required>
    </div>
    <div class="checkbox">
      <label><input type="checkbox"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>


</body>
</html>