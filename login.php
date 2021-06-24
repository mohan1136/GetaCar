<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <center>
        <?php
            $f=new Data();
            $f->retrive();
            $usr=$f->getData();
            $conn = mysqli_connect("localhost", "root", "", "cms");
                  
                // Check connection
                if($conn === false){
                    die("ERROR: Could not connect. " 
                        . mysqli_connect_error());
                
                }
                $sql = "INSERT INTO login VALUES('$usr')";
                mysqli_query($conn, $sql);
        ?>
        <?php
  
        // servername => localhost
        // username => root
        // password => empty
        // database name => staff
        class Data
        {
            public $data;
            function retrive()
            {
                $conn = mysqli_connect("localhost", "root", "", "cms");
                  
                // Check connection
                if($conn === false){
                    die("ERROR: Could not connect. " 
                        . mysqli_connect_error());
                }
                  
                // Taking all 5 values from the form data(input)
                $username =  $_REQUEST['user_name'];
                $password = $_REQUEST['pass_word'];
                  
                // Performing insert query execution
                // here our table name is college
                $sql = "SELECT username,password FROM usr_pwd";
                $count=0;
                if(mysqli_query($conn, $sql))
                {
                    $result= mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) 
                    {
                      while($row = mysqli_fetch_assoc($result)) 
                      {
                        if($row["password"]==$password && $row["username"]==$username)
                        {
                            $count=$count+1;
                        }
                      }
                      if($count==0)
                      {
                        echo '<script>alert("Invalid username and password");
                            window.open("login.html","_self");</script>';
                      }
                      else
                      {
                        echo '<script>alert("Success");</script>';
                            $this->data=$username;
                      }
                    } 
                    else
                    {
                       echo '<script>alert("Invalid username and password");
                            window.open("login.html","_self");</script>';
                    }
                }
                else
                {
                    echo "ERROR: Hush! Sorry $sql. " 
                        . mysqli_error($conn);
                }
                // Close connection
                mysqli_close($conn);
            }
            function getData()
            {
                return $this->data;
            }
        }
        ?>
    </center>
    
<div class="w3-black">
  <button class="w3-bar-item w3-button" onclick="openCity('Home')">Home</button>
  <button class="w3-bar-item w3-button" onclick="openCity('Room')">RoomAllocation</button>
  <button class="w3-bar-item w3-button" onclick="openCity('View')">View Deatails</button>
  <button class="w3-bar-item w3-button" onclick="Cancel()">Room Cancellation</button>
  <button class="w3-bar-item w3-button" onclick="change()">Change Password</button>
  <button class="w3-bar-item w3-button" onclick="logout()">LogOut</button>
</div>

<div id="Home" class="w3-container city">
  <h2>Welcome to Hostel Management</h2>
</div>


<div id="View" class="w3-container city" style="display: none;">

<?php
     $conn = mysqli_connect("localhost", "root", "", "cms");
                  
                // Check connection
                if($conn === false){
                    die("ERROR: Could not connect. " 
                        . mysqli_connect_error());
                
                }
                $sql = "SELECT username FROM login";
                if(mysqli_query($conn, $sql))
                {
                    $result= mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $fname=$row["username"];
                        // echo "$fname";
                        $sql1 = "SELECT * FROM room_data WHERE mobile='$fname'";
                        if(mysqli_query($conn, $sql1))
                            {
                                $result1= mysqli_query($conn, $sql1);
                                if (mysqli_num_rows($result1) > 0) 
                                {
                                  while($row = mysqli_fetch_assoc($result1)) 
                                  {
                                        echo '<h1 style="color:black;">Room allocated details</h1>';
                                        echo '<table border="2" style="font-size:40px;"><tr><td style="color:red;">FirstName</td><td>'.$row["fname"].'</td></tr><tr><td style="color:red;">LastName</td><td>'.$row["lname"].'</td></tr><tr><td style="color:red;">Mobile No</td><td>'.$row["mobile"].'</td></tr><tr><td style="color:red;">Block</td><td>'.$row["block"].'</td></tr><tr><td style="color:red;">Room No</td><td>'.$row["room"].'</td></tr><tr><td style="color:red;">Bed No</td><td>'.$row["bed"].'</td></tr></table>';
                                  }
                                } 
                                else
                                {
                                  echo '<h1 style="color:red;">You are not having room</h1>';
                                }
                                $sql2 = "DELETE FROM login";
                                mysqli_query($conn, $sql2);
                            }
                        else
                        {
                            echo "ERROR: Hush! Sorry $sql.". mysqli_error($conn);
                        }
                    }
                }
                else
                {
                    echo "ERROR: Hush! Sorry $sql.". mysqli_error($conn);
                }
                mysqli_close($conn);
?>

</div>

<div id="Room" class="w3-container city" style="display:none;">
<script>
    var stateObject={
        "BOYS HOSTEL-1":{"G-01":["G01-01","G01-02","G01-03","G01-04"],"G-02":["G02-01","G02-02","G02-03","G02-04"],"G-03":["G03-01","G03-02","G03-03","G03-04"],"G-04":["G04-01","G04-02","G04-03","G04-04"],"G-05":["G05-01","G05-02","G05-03","G05-04"]},
        "BOYS HOSTEL-2":{"F-01":["F01-01","F01-02","F01-03","F01-04"],"F-02":["F02-01","F02-02","F02-03","F02-04"],"F-03":["F03-01","F03-02","F03-03","F03-04"],"F-04":["F04-01","F04-02","F04-03","F04-04"],"F-05":["F05-01","F05-02","F05-03","F05-04"]},
        "GIRLS HOSTEL-1":{"S-01":["S01-01","S01-02","S01-03","S01-04"],"S-02":["S02-01","S02-02","S02-03","S02-04"],"S-03":["S03-01","S03-02","S03-03","S03-04"],"S-04":["S04-01","S04-02","S04-03","S04-04"],"S-05":["S05-01","S05-02","S05-03","S05-04"]},
        "GIRLS HOSTEL-2":{"T-01":["T01-01","T01-02","T01-03","T01-04"],"T-02":["T02-01","T02-02","T02-03","T02-04"],"T-03":["T03-01","T03-02","T03-03","T03-04"],"T-04":["T04-01","T04-02","T04-03","T04-04"],"T-05":["T05-01","T05-02","T05-03","T05-04"]}};
    window.onload=function()
    {
        var blockSel=document.getElementById("blockSel");
        var roomSel=document.getElementById("roomSel");
        var bedSel=document.getElementById("bedSel");
            for(var block in stateObject)
            {
                blockSel.options[blockSel.options.length]=new Option(block,block);
            }
            blockSel.onchange=function()
            {
                roomSel.length=1;
                if(this.selectedIndex<1) return;
                for (var room in stateObject[this.value]) 
                {
                    roomSel.options[roomSel.options.length] = new Option(room,room);
                }
            }
            blockSel.onchange();
            roomSel.onchange=function()
            {
                bedSel.length=1;
                var district=stateObject[blockSel.value][this.value];
                for(var i=0;i<district.length;i++)
                {
                    
                    bedSel.options[bedSel.options.length]=new Option(district[i],district[i]);
                }
            }
    }
    function validate()
    {
        let form = document.RoomAllocationForm;
           if( form.firstname.value == "" )
           {
             alert( "Enter Your First Name!" );
             return false;
           }
           if( form.lastname.value == "" )
           {
             alert( "Enter Your Last Name!" );
             return false;
           }
           if( form.mobilenumber.value == "" || isNaN( form.mobilenumber.value))
           {
             alert( "Enter your Mobile No. in the format 123." );
             return false;
           }
           if ( ( RoomAllocationForm.sex[0].checked == false ) && ( RoomAllocationForm.sex[1].checked == false ) )
           {
             alert ( "Choose Your Gender: Male or Female" );
             return false;
           }   
           if(form.mobilenumber.value.length != 10)
           {
             alert( "length should be 10" );
             return false;
           }
           if(form.blockSel.value=="")
           {
             alert( "pleas select block");
             return false;
           }
           if(form.roomSel.value=="")
           {
             alert( "pleas select room");
             return false;
           }
           if(form.bedSel.value=="")
           {
             alert( "pleas select bed");
             return false;
           }
           return true;
    }
</script>
<form action="RoomAllocationData.php" method="post" style="margin-block-end: 0rem;" name="RoomAllocationForm" onsubmit="return validate()">
 
<div cellpadding="2" width="20%" bgcolor="99FFFF" align="center"
cellspacing="2">
<div class="col-lg-12">
<center><font size=4><b>Room Allocation Form</b></font></center>
</div>
<div class="row">
<div class="col-lg-3">
    <label for="textname">First Name<font style="color:Red;">*</font></label>
</div>
<div class="col-lg-1">
    <label>:</label>
</div>
<div class="col-lg-6">
    <input type=text class="form-control" name="first_name" id="firstname" size="30" autocomplete="Off">
</div>
</div>

<div class="row">
<div class="col-lg-3">
    <label for="last_name">Last Name<font style="color:Red;">*</font></label>
</div>
<div class="col-lg-1">
    <label>:</label>
</div>
<div class="col-lg-6">
    <input type=text class="form-control" name="last_name" id="lastname" size="30" autocomplete="Off">
</div>
</div>

<div class="row">
<div class="col-lg-3">
    <label for="mobilenumber">Mobile Number<font style="color:Red;">*</font></label>
</div>
<div class="col-lg-1">
    <label>:</label>
</div>
<div class="col-lg-6">
    <input type=text class="form-control" name="mobilenumber" id="mobile_no" autocomplete="Off">
</div>
</div>

<div class="row">
<div class="col-lg-3">
    <label for="sex">Gender<font style="color:Red;">*</font></label>
</div>
<div class="col-lg-1">
    <label>:</label>
</div>
<div class="col-lg-3">
    <input type="radio" class="form-check-input" value="Male" name="sex" id="sex1" autocomplete="Off"/>
    <label class="form-check-label" for="sex">Male</label>
</div>
<div class="col-lg-1">
    <input type="radio" class="form-check-input" value="Female" name="sex" id="sex" autocomplete="Off"/>
    <label class="form-check-label" for="sex">Female</label>
</div>
 </div>


<div class="row">
<div class="col-lg-3">
    <label for="block">Block<font style="color:Red;">*</font></label>
</div>
<div class="col-lg-1">
    <label>:</label>
</div>
<div class="col-lg-6">
    <select name="block" class="form-control" id="blockSel">
    <option value="">select block</option>
    </select>
</div>
</div>

<div class="row">
<div class="col-lg-3">
    <label for="block">Room<font style="color:Red;">*</font></label>
</div>
<div class="col-lg-1">
    <label>:</label>
</div>
<div class="col-lg-6">
    <select name="room" class="form-control" id="roomSel">
    <option value="">select block first</option>
    </select>
</div>
</div>

<div class="row">
<div class="col-lg-3">
    <label for="bed">Bed No<font style="color:Red;">*</font></label>
</div>
<div class="col-lg-1">
    <label>:</label>
</div>
<div class="col-lg-6">
    <select name="bed" class="form-control" id="bedSel">
    <option value="">select room first</option>
    </select>
</div>
</div>

<div class="row">
 <div class="col-lg-12">
<input type="reset" class="btn btn-danger" style="margin-top: 10px;"/>
</div>

<div class="col-lg-12">
<input type="submit"  class="btn btn-primary" value="Submit" style="margin-top: 10px;"/>
</div>
</div>
</form>
</div>
</div>



<script>
function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(cityName).style.display = "block";

}
function logout()
{
    if(confirm("are you sure to logout?"))
    {
        window.open('indexc.html','_self');
    }
}
function Cancel()
{
    if(confirm("are you sure to Cancel the room?"))
    {
        window.open('RoomCancel.php','_self');
    }
}
function change()
{
    if(confirm("are you sure to change the password?"))
    {
        window.open('ChangePassword.php','_self');
    }
}
</script>
</body>
  
</html>