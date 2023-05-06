<?php
class Film
{
	public $movie_id;
	public $movie_title;
	public $movie_description;
	public $movie_poster;
	
	//creates film array 
	function showFilms()
	{
		$conn=mysqli_connect("localhost", "root", "", "westerwald");
		
		
		if(!$conn)
		{
			die("Connection failed".mysqli_connect_error());
		}
		$sql="SELECT * FROM movies";
		$result=mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result)>0)
		{
			echo "<br />";
			 echo "<div class='"."container"."'>";
        echo "<h2>Movie</h2>";
        echo "<table class='table table-hover'>";
        echo  "<thead>";
        echo "<tr>";
        echo "<th>Movie Id</th>";
        echo "<th>Movie Title</th>";
        echo "<th>Movie Plot</th>";
        echo "<th>Movie Poster</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while($row=mysqli_fetch_assoc($result))
            {
               echo "<tr>";
                $this->movie_id=$row['movie_id'];
                echo "<td>".$this->movie_id."</td>";
                $this->movie_title=$row['movie_title'];
                echo "<td>".$this->movie_title."</td>";
                $this->movie_description=$row['movie_description'];
                echo "<td style='"."text-align:justify"."'>".$this->movie_description."</td>";
                $this->movie_poster=$row['movie_poster'];
    
                echo "<td>".'<img src="data:image/png;base64,'.base64_encode($this->movie_poster).'" width =200 height=300/>'."</td>";                
                 echo "</tr>";
            }
          
            mysqli_close($conn);
		}
	}
}
?>