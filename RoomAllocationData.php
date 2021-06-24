<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<?php
	$conn = mysqli_connect("localhost", "root", "", "cms");
	     // Check connection
	if($conn === false){
	     die("ERROR: Could not connect. " 
	         . mysqli_connect_error());
	 }
	 $fname=  $_REQUEST['first_name'];
     $lname = $_REQUEST['last_name'];
     $mobile =  $_REQUEST['mobilenumber'];
     $gender =  $_REQUEST['sex'];
     $block =  $_REQUEST['block'];
     $room = $_REQUEST['room'];
     $bed=$_REQUEST['bed'];
     $sql = "INSERT INTO room_data VALUES ('$fname','$lname','$mobile','$gender','$block','$room','$bed')";
     $sql1="SELECT username FROM usr_pwd";
     $sql2="SELECT block,room,bed FROM room_data";
     $count=0;

     if(mysqli_query($conn, $sql2))
     {
		$result= mysqli_query($conn, $sql2);
		if (mysqli_num_rows($result) > 0) 
            {
              while($row = mysqli_fetch_assoc($result)) 
              {
                if($row["block"]==$block && $row["room"]==$room && $row["bed"]==$bed)
                {
                	$count=$count+1;
                    echo "<h1>$block:$room:$bed is filled please select another one</h1>";
                }
              }
              if($count==0)
                {
                        $mobile1;
	                	if(mysqli_query($conn, $sql1))
			              {
                            $result1= mysqli_query($conn, $sql1);
                            while($row = mysqli_fetch_assoc($result1)) 
                              {
                                if($row["username"]==$mobile)
                                {
                                    $count=$count+1;
                                    $mobile1=$mobile;
                                }
                              }
                              if($count==1)
                              {
                                $sql2="SELECT mobile FROM room_data";
                                if(mysqli_query($conn, $sql2))
                                 {
                                        $count=0;
                                        $result2= mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result1) > 0)
                                        {
                                            while($row = mysqli_fetch_assoc($result2)) 
                                              {
                                                if($row["mobile"]==$mobile || $row["mobile"]==$mobile1)
                                                {
                                                    $count=$count+1;
                                                    echo "<h1>already room allocated to you</h1>";
                                                }
                                            }
                                            if($count==0)
                                            {
                                                
                                               if($gender=="Male" && ($block=="BOYS HOSTEL-1" || $block=="BOYS HOSTEL-2"))
                                                {
                                                    mysqli_query($conn, $sql);
                                                    echo "<center><h1>successfully alloted room</h1></center>";
                                                }
                                                else if($gender=="Female" && ($block=="GIRLS HOSTEL-1" || $block=="GIRLS HOSTEL-2"))
                                                {
                                                    mysqli_query($conn, $sql);
                                                    echo "<center><h1>successfully alloted room</h1></center>";
                                                }
                                                else if($gender=="Male" && ($block=="GIRLS HOSTEL-1" || $block=="GIRLS HOSTEL-2"))
                                                {
                                                    echo "<center><h1>please select block is BOYS HOSTEL-1 or BOYS HOSTEL-2</h1></center>";
                                                }
                                                else if($gender=="Female" && ($block=="BOYS HOSTEL-1" || $block=="BOYS HOSTEL-2"))
                                                {
                                                    mysqli_query($conn, $sql);
                                                    echo "<center><h1>please select block is GIRLS HOSTEL-1 or GIRLS HOSTEL-2</h1></center>";
                                                }
                                            }
                                        }
                                     }
                                     else
                                     {
                                        echo "ERROR: Hush! Sorry $sql. ". mysqli_error($conn);
                                     }
                                }
                                else
                                {
                                    echo "<h1>invalid mobilenumber</h1>";
                                }
			              }
			              else
			              {
			              	echo "ERROR: Hush! Sorry $sql. ". mysqli_error($conn);
			              }
                	}
            }
            else if(mysqli_num_rows($result)==0)
            {
                if($gender=="Male" && ($block=="BOYS HOSTEL-1" || $block=="BOYS HOSTEL-2"))
                {
                    if(mysqli_query($conn, $sql))
                        echo "<center><h1>successfully alloted room</h1></center>";
                    else
                        echo "ERROR: Hush! Sorry $sql. ". mysqli_error($conn);
                }
                else if($gender=="Female" && ($block=="GIRLS HOSTEL-1" || $block=="GIRLS HOSTEL-2"))
                {
                    mysqli_query($conn, $sql);
                    echo "<center><h1>successfully alloted room</h1></center>";
                }
                else if($gender=="Male" && ($block=="GIRLS HOSTEL-1" || $block=="GIRLS HOSTEL-2"))
                {
                    echo "<center><h1>please select block is BOYS HOSTEL-1 or BOYS HOSTEL-2</h1></center>";
                }
                else if($gender=="Female" && ($block=="BOYS HOSTEL-1" || $block=="BOYS HOSTEL-2"))
                {
                    mysqli_query($conn, $sql);
                    echo "<center><h1>please select block is GIRLS HOSTEL-1 or GIRLS HOSTEL-2</h1></center>";
                }
             }

     }
    else
    {
       echo "ERROR: Hush! Sorry $sql. ". mysqli_error($conn);
    }

    mysqli_close($conn);
?>
    <center>
	<a href="javascript:window.history.back();" style="font-size: 30px;">Go to back</a>
</center>
</form>
</body>
</html>