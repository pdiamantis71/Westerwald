<?php
session_start();
//checks usertype
if($_SESSION['usertype']!=1)
{
	header("Location:movieIndex.php");
}
else{
include("movieBookAdmin.html");
}
?>
<?php//connects
	$conn=mysqli_connect("localhost","root", "", "westerwald");
if (!$conn)
{
	die("Connection failed!: ".mysqli_connect_error());
}
//checks approve button
if (isset($_POST['approve']))
{
	$choice=$_POST['choice'];
	
	
	
if(!empty($choice)){
	//loops through $choice array to update column approved
$length=count($choice);
	for ($x=0; $x<$length; $x++)
	{
		$sql="UPDATE `reservations` SET approved='2' WHERE res_id='".$choice[$x]."' ";
		$result=mysqli_query($conn,$sql);
		
	}
}
}
//checks cancel button
if (isset($_POST['cancel']))
{
	$choice=$_POST['choice'];
	
	
	$conn=mysqli_connect("localhost","root", "", "westerwald");
if (!$conn)
{
	die("Connection failed!: ".mysqli_connect_error());
}
if(!empty($choice)){
	//follows the same procedure as with the approved
$length=count($choice);
	for ($x=0; $x<$length; $x++)
	{
		$sql="DELETE FROM `reservations` WHERE res_id='".$choice[$x]."' ";
		$result=mysqli_query($conn,$sql);
		 
	}
}
}

if (isset($_POST['done']))
{//checks button done
	$scr=$_POST['screenings'];
	//updates date and time
	if(isset($_POST['time']))
	{
		$newtime=$_POST['time'];
		$sql="UPDATE screenings SET time='".$newtime."' WHERE screening_id='".$scr."' ";
		$result=mysqli_query($conn, $sql);
	}
	if (isset($_POST['date_start']))
	{
		$newstartdate=$_POST['date_start'];
		$sql="UPDATE screenings SET date_start='".$newstartdate."' WHERE screening_id='".$scr."' ";
		$result=mysqli_query($conn, $sql);
	}
	if (isset($_POST['date_limit']))
	{
		$newlimitdate=$_POST['date_limit'];
		$sql="UPDATE screenings SET date_limit='".$newlimitdate."' WHERE screening_id='".$scr."' ";
		$result=mysqli_query($conn, $sql);
	}
	
	
}

function make_query($conn){
	$sql="SELECT * FROM reservations WHERE approved!=2 ORDER BY date ASC";
	$result=mysqli_query($conn, $sql);
	return $result;
}
//creates approval or cancelation array
function adminarray($conn){
	$count=0;
	$output='<table class="table table-dark table-hover">
	<thead >
      <tr>
        <th>username</th>
        <th>email</th>
		<th>screening id</th>
        <th>date</th>
		<th>seat</th>
      </tr>
	  </thead>';
	$count=0;
	$result=make_query($conn);
	while($row=mysqli_fetch_array($result))
	{
		{
			$username=$row['username'];
	$email=$row['email'];
	$screeningid=$row['screening_id'];
	$adate=$row['date'];
	$seat=$row['seat_id'];
	$res_id=$row['res_id'];
		$output.='
	  <tbody>
      <tr>
        <td name="username" value="'.$username.'">'.$username.'</td>
        <td name="email" value="'.$email.'">'.$email.'</td>
		<td name="screening" value="'.$screeningid.'">'.$screeningid.'</td>
	<td name="date" value="'.$adate.'">'.$adate.'</td>
	<td name="seat" value="'.$seat.'">'.$seat.'</td>
	<td><input type="checkbox" class="form-check-input" name="choice[]" value="'.$res_id.'"></td>
      </tr>
	  ';
	}
	$count=$count+1;
	}
	
$output.='
</tbody></table>
<td><input type="submit" name="approve" value="approve"></td>
	<td><input type="submit" name="cancel" value="cancel"></td>
';


return $output;
	
	
}
function make_date_query($conn)
{
	$sql="SELECT * FROM screenings ORDER BY screening_id ASC";
	$result=mysqli_query($conn, $sql);
	return $result;
}
//creates date and time changing form
function createscreenings($conn)
{
	$sql="SELECT * FROM screenings ORDER BY screening_id ASC";
	$result=mysqli_query($conn, $sql);
	$output='<select id="select" name="screenings" required>
<option value="">Choose a Screening:</option>';
	while($row=mysqli_fetch_array($result))
	{
		$screening_id=$row['screening_id'];
		$movie_id=$row['movie_id'];
		$newsql="SELECT movie_title FROM movies WHERE movie_id=$movie_id";
		$newresult=mysqli_query($conn,$newsql);
		$newrow=mysqli_fetch_array($newresult);
		$movie=$newrow['movie_title'];
		$venue=$row['venue_id'];
		$output.='<option name="screening" value="'.$screening_id.'" id="screening'.$screening_id.'">'."$movie, Venue $venue".'</option>'; 
	}
	$output.='</select>';
	return $output;
}
function dateandtimechange($conn)
{
	
	$output='<table class="table table-dark table-hover">
	<thead >
      <tr>
		<th>time</th>
        <th>Date Start</th>
		<th>Date Limit</th>
      </tr>
	  </thead>
	  <tbody>
	  <tr>
	 
	  <td><input type="time" value="time" name="time" required></td>
	  <td><input type="date" value="date_start" min="2023-01-20" name="date_start" required></td>
	  <td><input type="date" value="date_limit" min="2023-01-20" name="date_limit" required></td>
	  <td><input type="submit" name="done" value="Done"></td>
	  </tr>
	  </tbody></table>';
	
	return $output;
}
	  



?>
<!DOCTYPE html>
<html>
<body>
<br />
<br />
<h1>Approve or Cancel Reservations</h1>
<form method="POST">
<div class="input-group">
<p><?php echo adminarray($conn); ?></p>
</div>
</form>
<br />
<h1>Change Time and Date of Screenings</h1>
<form method="POST">
<div class="input-group">
<p><?php echo createscreenings($conn);?></p>
<br />
<br />
<p><?php echo dateandtimechange($conn); ?></p>
</div>
</form>


</body>
</html>