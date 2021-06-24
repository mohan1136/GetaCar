<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
</head>
<body>

<form action="" method="post" style="margin-block-end: 0rem;" name="login">

<div cellpadding="2" width="20%" bgcolor="99FFFF" align="center"
cellspacing="2">

<div class="col-lg-12">
<font size=4><b>Forgot Password</b></font>
</div>

<div class="row">
<div class="col-lg-3">
  <label for="mobile">Verify Mobile number</label>
</div>
<div class="col-lg-1">
  <label>:</label>
</div>
<div class="col-lg-6">
  <input type=text class="form-control" name="mobile" autocomplete="Off">
</div>
</div>

<div class="row" >
<div class="col-lg-3">
  <label for="mobile" style="margin-top: 10px;">Capcha</label>
</div>
<div class="col-lg-1">
  <label style="margin-top: 10px;">:</label>
</div>
<div class="col-lg-4" style="margin-top: 10px;">
  <input type=text class="form-control" name="capcha" autocomplete="Off">
</div>
<div class="col-lg-2" style="font-size: 30px; background: green; margin-top: 10px">
<?php
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$capcha=substr(str_shuffle($chars),0,5);
		echo "$capcha";
		$conn = mysqli_connect("localhost", "root", "", "cms");
          
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
        $sql = "INSERT INTO capcha VALUES ('$capcha')";
        mysqli_query($conn, $sql);
        ?>
</div>
</div>

<div class="row" >
<div class="col-lg-12">
<?php
  
        // servername => localhost
        // username => root
        // password => empty
        // database name => staff

        $conn = mysqli_connect("localhost", "root", "", "cms");
          
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
        $sql = "SELECT mobile FROM s_r_data";
        $sql1 = "SELECT capcha FROM capcha";
        $name;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    // collect value of input field
	    $name = $_POST['mobile'];
	    $cap=$_POST['capcha'];
	    $count=0;
	    $found=0;
	    if (empty($name)) {
	        echo '<script>alert("please enter mobile number")</script>';
	    }
	    else
	    {
	    	if(mysqli_query($conn, $sql))
	        {
	            $result= mysqli_query($conn, $sql);
	            if (mysqli_num_rows($result) > 0) 
	            {
	              while($row = mysqli_fetch_assoc($result)) 
	              {
	                if($row["mobile"]==$name)
	                {
	                	$result1= mysqli_query($conn, $sql1);
	                	if (mysqli_num_rows($result1) > 0) 
			            {
			              while($row = mysqli_fetch_assoc($result1)) 
			              {
			                if($row["capcha"]==$cap)
			                {
			           		 	$found=1;
			                }
			              }
			              if($found!=1)
			              {
			              	echo "<h1>Invalid capcha</h1>";
			              }
			              if($found==1)
			              {
			              	$sql2 = "SELECT username FROM usr_pwd WHERE username='$name'";
			              	$result2= mysqli_query($conn, $sql2);
				            if (mysqli_num_rows($result) > 0) 
				            {
				              while($row = mysqli_fetch_assoc($result2)) 
				              {
				              		$fname=$row["username"];
				                	echo "<b>Username:</b>$fname<br>";
				                	$sql3 = "SELECT password FROM usr_pwd WHERE username='$fname'";
			              			$result3= mysqli_query($conn, $sql3);
			              			if(mysqli_query($conn, $sql3))
			              			{
				              			while($row = mysqli_fetch_assoc($result3)) 
				              			{
				              				$password=$row["password"];
				              				echo "<b>your password:</b>$password<br>";
				              			}
				              		}
				              		else
				              		{
				              			echo "ERROR: Hush! Sorry $sql. ". mysqli_error($conn);
				              		}
				              }
				            }
			  
			              }
			            } 
			            else
			            {
			              echo "0 results";
			            }
	                }
	                else
	                {
	                    echo "<h1>Invalid mobile number</h1>";
	                }
	              }
	            } 
	            else
	            {
	              echo "0 results";
	            }
	        }
	        else
	        {
	            echo "ERROR: Hush! Sorry $sql. " 
	                . mysqli_error($conn);
	        }
	    }
		}
        // Close connection
        mysqli_close($conn);
?>
</div>
</div>

<div class="col-lg-12">
<input type="submit"  class="btn btn-primary" value="Submit" style="margin-top: 10px;"/>
</div>
<div class="col-lg-12" style="margin-top: 10px;">
	<a href="login.html">Go to login</a>
</div>
</div>
</form>
</body>
</html>