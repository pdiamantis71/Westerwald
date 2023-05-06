<?php
session_start();
?>
<?php
class myVenue
{
	public $myven;
}
header("Content-Type: application/json; charset=UTF-8");
$theVenue=new myVenue();
$date=$_GET['date'];
$myAr=$_GET['myAr'];

$conn=mysqli_connect("localhost", "root", "","westerwald");
if (!$conn)
{
	die("Connection failed: " . mysqli_connect_error());
}

$sql="SELECT venue_id FROM screenings WHERE screening_id=$myAr";
$result=mysqli_query($conn, $sql);

$row=mysqli_fetch_array($result);

	$venue=$row['venue_id'];
	
	$newsql="SELECT venue_capacity FROM venues WHERE venue_id=$venue";
	$newresult=mysqli_query($conn, $newsql);
	$newrow=mysqli_fetch_array($newresult);
	$cap=$newrow['venue_capacity'];
	$theVenue->myven=create_venue($date, $cap, $myAr,$conn);
	echo json_encode($theVenue);
	//creates venue according to date, capacity, and number of screening with data received from JSON api
function create_venue($date, $cap, $myAr, $conn)
{
	$taken=array();
	
	$finalsql="SELECT * FROM reservations WHERE  date='".$date."' AND screening_id=$myAr ";
	

	$finalresult=mysqli_query($conn, $finalsql);
	
	
	
	
	
		
		
		while($takenSeats=mysqli_fetch_array($finalresult))
		{
			
				array_push($taken, $takenSeats['seat_id']);
				
		
		}
	
	$counter=1;
	$line=$cap/10;
	$output='
	<div class="venue">
	<div class="screen"></div>';
	for($i=0; $i<=$line-1; $i++)
	{
		$output.='
		
		<div class="row">';
		for($j=1; $j<=10; $j++)
		{
			if(!empty($taken)){
					
					if(check($taken,$counter)){
						
					$output.='
					<input type="checkbox" class="form-check-input" disabled>';
					
					}
					else
					{
						$output.='
					<input type="checkbox" class="form-check-input" id="seat'.$counter.'" name="seat[]" value="'.$counter.'">';
					
					}
					
					}
					else
					{
			
					
					$output.='
					<input type="checkbox" class="form-check-input" id="seat'.$counter.'" name="seat[]" value="'.$counter.'">';
					
					}
					$counter++;
				}
			
				
		
        
      $output.='</div>';
	  
	}
	$output.='</div>
	</div>
	<input type="submit" name="submit" value ="submit">';
	
	return $output;
}
function check($taken, $counter)
{//checks if seat is taken
	
	$takensize=count($taken);
	for($x=0; $x<$takensize;$x++){
		if($taken[$x]==$counter)
		{
			return true;
		}
	}
	return false;
}


?>