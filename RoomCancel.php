<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<script>
	function validate()
	{
		let form = document.Cancel;

		   if( form.mobile.value == "" || isNaN( form.mobile.value))
	       {
	         alert( "Enter your Mobile No. in the format 123." );
	         return false;
	       }
	       if(form.mobile.value.length != 10)
	       {
	       	 alert( "length should be 10" );
	         return false;
	       }
	       return true;
	}	
</script>


<form action="" method="post" style="margin-block-end: 0rem;" name="Cancel" onsubmit="return validate()">


<div cellpadding="2" width="20%" bgcolor="99FFFF" align="center"
cellspacing="2">
<div class="col-lg-12">
<font size=4><b>Room Cancel Form</b></font>
</div>
<div class="row">
<div class="col-lg-3">
  <label for="mobile">Mobile No</label>
</div>
<div class="col-lg-1">
  <label>:</label>
</div>
<div class="col-lg-6">
  <input type=text class="form-control" name="mobile" autocomplete="Off" placeholder="Enter mobile number"/>
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
        $name;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    // collect value of input field
	    $name = $_POST['mobile'];
	    $sql = "SELECT mobile FROM room_data WHERE mobile='$name'";
	    $sql1 = "SELECT username FROM usr_pwd WHERE username='$name'";
	    $found=0;
	    if(mysqli_query($conn, $sql1))
	    {
	    	$result1= mysqli_query($conn, $sql1);
	    	if (mysqli_num_rows($result1) > 0) 
	        {
	              while($row = mysqli_fetch_assoc($result1)) 
	              {
	              	if($row["username"]==$name)
	              	{
	              		$found=1;
	              	}
	              }
	        }
	        else
	        {
	            	echo "<b>Invalid mobile number</b>";
	        }
	        if($found==1)
	        {
			    if(mysqli_query($conn, $sql))
			    {
			    	$count=0;
			    	$result= mysqli_query($conn, $sql);
		            if (mysqli_num_rows($result) > 0) 
		            {
		              while($row = mysqli_fetch_assoc($result)) 
		              {
		              	if($row["mobile"]==$name)
		              	{
		              		$sql1="DELETE FROM room_data WHERE mobile='$name'";
		              		if(mysqli_query($conn, $sql1))
		              			$count=1;
		              		else
		              			echo "ERROR: Hush! Sorry $sql. ". mysqli_error($conn);
		              	}
		              }
		              if($count==1)
		              {
		              	echo "<b>Successfully canceled the room</b>";
		              }
		              else
		              {
		           		echo "<b>you are not having room</b>";
		              }
		            }
		            else
		            {
		            	echo "<b>you are not having room</b>";
		            }
			    }
			    else
		        {
		            echo "ERROR: Hush! Sorry $sql. " 
		                . mysqli_error($conn);
		        }
	        }
        // Close connection
        mysqli_close($conn);
	  }
	}

?>


<div class="row">
<div class="col-lg-3">
  
</div>
<div class="col-lg-2">
</div>
<div class="col-lg-2">
  <input type="submit" class="form-control btn btn-success" name="submit" value="submit" style="margin-top: 10px;" />
</div>
<div class="col-lg-12">
<a href="javascript:window.history.back();" style="font-size: 30px;">Go to back</a>
</div>

</div>
</form>
</body>
</html>