<?php
 session_start();
if (isset($_SESSION['username'])){
if ($_SESSION['usertype']==1)
{
	include("movieAdminBooking.html");
	$username = $_SESSION['username'];
//$name = $_SESSION['name'];
$email = $_SESSION['email'];
}
else	
{
include("bNavBarOn.html");
$username = $_SESSION['username'];
//$name = $_SESSION['name'];
$email = $_SESSION['email'];
}
}
else
{
	include("bNavBarOff.html");
}

if (isset($_POST['seat']))
 {
	 //checks if seats are chosen and puts user to the reservations table of database
	 $movie=$_POST['movies'];
	 $screening=$_POST['radio'];
	 $date=$_POST['arrival_date'];
	 $seat=$_POST['seat'];
	
	 if(!empty($_POST['seat']))
	 {
		 foreach($_POST['seat'] as $j)
		 {
			 //echo $j;
		 //}
	 //}
	 $conn=mysqli_connect("localhost", "root", "", "westerwald");
	 if (!$conn)
	 {
		 die("Connection Failed! :".mysqli_connect_error()); 
	 }
	 $sql="SELECT * FROM reservations WHERE screening_id=$screening AND date='".$date."' AND seat_id=$j";
	 $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) >0)
        {
           mysqli_close($conn);
            echo "not ok";
            die("");
            
            
        }
 
        else
        {
			
        $sql = "INSERT INTO reservations (username, email, screening_id, date, seat_id) values ('"
           .$username. "','"
           .$email. "','"
           .$screening. "','"
           .$date. "','"
		   .$j."')";    
			}
		}
  //echo $sql;
         //die("");
        $nresult= mysqli_query($conn, $sql); 
        mysqli_close($conn);
        if($nresult)
        {   
         
            header("Location:movieBook.php");
        }   
        
        }
	 
 }
?>

<?php
$conn=mysqli_connect("localhost", "root", "", "westerwald");
function create_query($conn)
{
$sql="SELECT * FROM venues ORDER BY venue_id ASC";
$result=mysqli_query($conn, $sql);
return $result;
}
function create_movies($conn)
{//creates select form for movies with data from database
	$output='<select id="select" onchange="myMovies(this.value)" name="movies">
<option value="">Choose a Movie:</option>';
	$sql="SELECT * FROM movies ORDER BY movie_id ASC";
	$result=mysqli_query($conn, $sql);
	$count=0;
	while ($row=mysqli_fetch_array($result))
	{
		{
		$movieNo=$row['movie_id'];
		$movieName=$row['movie_title'];
		$output.='<option  name="movie" value="'.$movieNo.'" id="movie'.$movieNo.'">'."$movieName".'</option>';
		}
		$count=$count+1;
	}
	$output.='</select>';
	return $output;
}
function date_start($conn)
{
	$sql="SELECT * FROM screenings WHERE screening_id=1";
	$result=mysqli_query($conn, $sql);
	$row=mysqli_fetch_array($result);
	$start=$row['date_start'];
	return $start;
}
function date_limit($conn)
{
	$sql="SELECT * FROM screenings WHERE screening_id=1";
	$result=mysqli_query($conn, $sql);
	$row=mysqli_fetch_array($result);
	$limit=$row['date_limit'];
	return $limit;
}
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
<br />
<br />
<br />
<form method="POST">
<div class="input-group">
<?php echo create_movies($conn); ?>
<br />
<p id="table"></p>
<br />
<p id="calendar"></p>
<br />
<!--<input type="date" id="bookdate" name="bookdate"
       value="<?php echo date_start($conn);?>"
       min="<?php echo date_start($conn);?>" max="<?php echo date_limit($conn);?>"
       
       onchange="document.getElementById('show1').checked=true;
           my_date=this.value;show_seats(this.value,my_show);"
       
       >-->
	<br />
<p id="venue"><p>	
		
</div>
</form>
<script>
function myMovies(no)
{//creates screenings after movie choice
	const movieNo=JSON.parse(no);
	
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	const obj = JSON.parse(this.responseText);
	document.getElementById("table").innerHTML=obj.myTable;
	}
  };
  
  xhttp.open("GET", "screenings.php?movieNo="+movieNo, true);
  xhttp.send();
}
function sdate(row){
//creates calendar after choice of screening
const srow=JSON.parse(row);


var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
	const obj = JSON.parse(this.responseText);
	document.getElementById("calendar").innerHTML=obj.datelimit;
	}
  };
xhttp.open("GET", "calendar.php?srow="+srow, true);
  xhttp.send();
}
function theVenue(date, ar)
{
//creates venues after movie choice	
	const myAr=JSON.parse(ar)
	
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	const obj = JSON.parse(this.responseText);
	document.getElementById("venue").innerHTML=obj.myven;
	}
	
  };
  
  xhttp.open("GET", "Venues.php?date="+date+"&myAr="+myAr, true);
  xhttp.send();
}
</script>
</body>
</html>
