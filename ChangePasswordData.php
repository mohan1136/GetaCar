<!DOCTYPE html>
<html>
<head>
<script>
function myfunction()
{
    window.open("indexc.html","_self");
}
</script>
</head>
<body>
        <?php
  
        // servername => localhost
        // username => root
        // password => empty
        // database name => cms
        $conn = mysqli_connect("localhost", "root", "", "cms");
          
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
        $username =  $_REQUEST['username'];
        $oldpassword = $_REQUEST['oldpassword'];
        $newpassword = $_REQUEST['newpassword'];
        $r_newpassword = $_REQUEST['r_newpassword'];
        $sql = "SELECT username,password FROM usr_pwd";
        $found=0;
        $found1=0;
        $found2=0;
         if(mysqli_query($conn, $sql))
        {
            $result= mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
              while($row = mysqli_fetch_assoc($result)) 
              {
                if($row["username"]!=$username)
                {
                    if($row["password"]!=$oldpassword)
                    {
                        $found=1;
                    }
                    else
                    {
                        $found2=1;
                    }
                }
                else if($row["password"]!=$oldpassword)
                {
                    $found1=1;
                }
              }
              if($found==1)
              {
                echo "<center><h1>Invalid Username and password</h1></center>";
              }
              else if($found1==1)
              {
                echo "<center><h1>Invalid password</h1></center>";
              }
              else if($found2==1)
              {
                echo "<center><h1>Invalid username</h1></center>";
              }
              else if($found==0 && $found1==0 && $found2==0)
              {
                    $sql1 = "UPDATE usr_pwd SET password='$newpassword' WHERE username='$username'";
                    if(mysqli_query($conn, $sql1))
                    {
                        echo "<center><h1>Password updated successfully</h1></center>";
                    }
                    else
                    {
                        echo "ERROR: Hush! Sorry $sql. ". mysqli_error($conn);
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
        // Close connection
        mysqli_close($conn);
        ?>
<center><button onclick="myfunction()" style="font-size: 30px;">Goto Home</button></center>
</body>
</html>