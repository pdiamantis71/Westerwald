<?php

session_start();
?>
<?php

	
include("movieUser.php");


if (isset ($_SESSION['username'])){
	header("Location:movieMenu.php");
}

if (isset($_REQUEST['username']))
{//gets data from form
	$user=new movieUser();
	$user->username=$_REQUEST['username'];
	$user->password=$_REQUEST['password'];
	
	$user->login();
	
}



	/*if(isset($_REQUEST['username']))
	
{
$username = $_POST['username'];
$password = $_REQUEST['password'];

$conn=mysqli_connect("localhost", "root", "", "metrop");

if(!$conn)
{
	die("Connection failed: " .mysqli_connect_error());
} 

$sql="SELECT * FROM users where username ='".$username."' and password ='".$password."'";

$result=mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0)
{
	$_SESSION['username']=$username;
	
	header("Location:movieMenu.php");
}
else
{
	header("Location:movieSignUp.php");
	
}
}*/

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
	  <li><a href="movieSignUp.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li class="active"><a href="movieLogin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <h3>Log In</h3>
  <p></p>
  <p></p>
</div>

<div class="container">
  <h2>Log-in</h2>
  <form action="movieLogin.php" class="needs-validation" method="POST">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="username" name="username" class="form-control" id="username" placeholder="Enter Username" required>
	  <!--<div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>-->
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
	  <!--<div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>-->
    </div>
    <div class="checkbox">
      <label><input type="checkbox"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>