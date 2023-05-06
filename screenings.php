<?php
class Screening
{
	
	public $myTable;
}
$screening=new Screening();
$movieNo=$_GET['movieNo'];

$conn=mysqli_connect("localhost", "root", "","westerwald");
if(!$conn)
{
	die("Connection failed!: ".mysqli_connect_error());
}
$sql="SELECT * FROM screenings WHERE movie_id=$movieNo ORDER BY screening_id ASC";
$result=mysqli_query($conn, $sql);
if (mysqli_num_rows($result)>0)
{
	$tableRow=array();
	
	while($row=mysqli_fetch_array($result))
	{
		
		array_push($tableRow, $row['screening_id']);
	}
	
	$screening->myTable=makeTable($tableRow, $movieNo, $conn);
	echo json_encode($screening);
}
//creates table for screenings according to the movie choice with data received from JSON api
function makeTable($tableRow, $movieNo, $conn)
{
	$newsql="SELECT movie_title FROM movies WHERE movie_id=$movieNo";
	$newresult=mysqli_query($conn, $newsql);
	$newrow=mysqli_fetch_array($newresult);
	$title=$newrow['movie_title'];
	//echo $title;
	$output='
	<table class="table table-dark table-hover">
	<thead >
      <tr>
        <th>Movie Title</th>
        <th>Time</th>
		<th>Venue</th>
        <th></th>
      </tr>
	  </thead>';
	$size=count($tableRow);
	for($x=0; $x<$size; $x++){
		$finalsql="SELECT * FROM screenings WHERE screening_id=$tableRow[$x]";
		$finalResult=mysqli_query($conn, $finalsql);
		$finalrow=mysqli_fetch_array($finalResult);
		
		$time=$finalrow['time'];
		$limit=$finalrow['date_limit'];
		$venue=$finalrow['venue_id'];
	$output.='
	<tbody>
      <tr>
        <td>'.$title.'</td>
        <td>'.$time.'</td>
		<td>Venue '.$venue.'</td>
	<td><input type="radio" name="radio" value="'.$tableRow[$x].'" onclick="sdate(this.value)" required></td>
      </tr>';
	}
	$output.='</tbody>
	</table>';
	return $output;
}
?>