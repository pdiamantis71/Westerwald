<?php
session_start();
?>

<?php
if (!isset($_SESSION['username']))
{
	header("Location:movieIndex.php");
}
if($_SESSION['usertype']!=1)
{
	header("Location:MovieMenu.php");
}
?>

<?php
//index.php
$connect = mysqli_connect("localhost", "root", "", "westerwald");
function make_query($connect)
{
 $query = "SELECT * FROM movies ORDER BY movie_id ASC";
 $result = mysqli_query($connect, $query);
 return $result;
}
//creates carousel
function make_slide_indicators($connect)
{
 $output = ''; 
 $count = 0;
 $result = make_query($connect);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>
   ';
  }
  else
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>
   ';
  }
  $count = $count + 1;
 }
 return $output;
}

function make_slides($connect)
{
 $output = '';
 $count = 0;
 $result = make_query($connect);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '<div class="item active">';
  }
  else
  {
   $output .= '<div class="item">';
  }
  $output .= '
   <img src="data:image/png;base64,'.base64_encode($row['movie_poster']).'" alt="'.$row["movie_title"].'" style="width:1180px;height:1240px; margin-left: auto;margin-right: auto;" />
   <div class="carousel-caption">
    <h3>'.$row["movie_title"].'</h3>
   </div>
  </div>
  ';
  $count = $count + 1;
 }
 return $output;
}

?>

<!DOCTYPE html>
<html>
 <head>
  <title>Welcome</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />

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
        <li class="active"><a href="movieMenuAdmin.php">Home</a></li>
        <li><a href="movieMovies.php">Movies</a></li>
        <li><a href="movieBook.php">Book</a></li>
        <li><a href="movieBookAdmin.php">Manage Bookings</a><li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
	  
        <li><a href="movieLogout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<br />
  <div class="container">
   <h2 align="center">Welcome</h2>
   <br />
   <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <?php echo make_slide_indicators($connect); ?>
    </ol>

    <div class="carousel-inner">
     <?php echo make_slides($connect); ?>
    </div>
    <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
     <span class="glyphicon glyphicon-chevron-left"></span>
     <span class="sr-only">Previous</span>
    </a>

    <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
     <span class="glyphicon glyphicon-chevron-right"></span>
     <span class="sr-only">Next</span>
    </a>

   </div>
  </div>
 </body>
</html>