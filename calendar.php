
<?php
class theCalendar
{
	public $datelimit;
}
header("Content-Type: application/json; charset=UTF-8");
$calendar=new theCalendar();
$srow=$_GET['srow'];

$conn=mysqli_connect("localhost", "root", "","westerwald");
if (!$conn)
{
	die("Connection failed: " . mysqli_connect_error());
}
$cal="SELECT * FROM screenings WHERE screening_id=$srow";
$dates=mysqli_query($conn, $cal);

	$crow=mysqli_fetch_array($dates);
	$start=$crow['date_start'];
	$limit=$crow['date_limit'];
	$calendar->datelimit=create_calendar($start, $limit, $srow);
	echo json_encode($calendar);

//creates calendar according to screeningchoice with data received from JSON api 
function create_calendar($start,$limit,$srow)
{
	$output='<input type="date" value="date" name="arrival_date" id="arrival_date" class="form-control" aria-label="..." min="'.$start.'" max="'.$limit.'" onchange="theVenue(this.value,'.$srow.')" required>';
	
	return $output;
}

?>


