<?php
class movieUser
{
	public $username;
	public $password;
	public $name;
	public $email;
	public $usertype;
	public $conn;
	
	function connect()
	{
		$this->conn=mysqli_connect("localhost", "root", "", "westerwald");
		if (!$this->conn)
		{
			die("Connection failed.".mysqli_connect_error());
		}
		
	}
	function login()
	{//checks database if user exists
		$this->connect();
		
		$sql="SELECT * FROM users WHERE username='".$this->username."' AND password='".$this->password."'";
		$result=mysqli_query($this->conn, $sql);
		
		if(mysqli_num_rows($result)>0)
		{
			while ($row=mysqli_fetch_assoc($result))
			{
				$this->username=$row['username'];
				$this->name=$row['name'];
				$this->email=$row['email'];
				$this->usertype=$row['usertype'];
			}
			mysqli_close($this->conn);
			//if logged-in, creates session
				$_SESSION['username']=$this->username;
				$_SESSION['name']=$this->name;
				$_SESSION['email']=$this->email;
				$_SESSION['usertype']=$this->usertype;
				
				if($_SESSION['usertype']==1)
				{
					header("Location:movieMenuAdmin.php");
				}
				else{
				header("Location:movieMenu.php");
				}
		}
		else
		{
			mysqli_close($this->conn);
		}
	}
	
	function signup()
	{
		$conn= mysqli_connect("localhost", "root", "", "westerwald");
		if (!$conn)
		{
			die("Connection failed: ". mysqli_connect_error());
		}
		$sql="SELECT * FROM users WHERE username='".$this->username."'";
		
		$result=mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0)
		{
			mysqli_close($conn);
		}
		else
		{
			$sql="INSERT INTO users (username, password, name, email, usertype) values ('"
			.$this->username."','"
			.$this->password."','"
			.$this->name."','"
			.$this->email."','"
			.$this->usertype."')";
			
			$result=mysqli_query($conn, $sql);
			 if($result)
			 {//creating sessions afted succesfull sign up
				 mysqli_close($conn);
				 $_SESSION['name']=$this->name;
				 $_SESSION['username']=$this->username;
				 $_SESSION['email']=$this->email;
				 $_SESSION['usertype']=$this->usertype;
				 header("Location:movieMenu.php");
			 }
			mysqli_close($conn);
		}
		
		 
		 
	}
}

?>