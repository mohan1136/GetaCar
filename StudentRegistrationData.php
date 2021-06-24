<!DOCTYPE html>
<html>
<head>
    <title>Insert Page page</title>
</head>
<body>
    <center>
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
          
        // Taking all 5 values from the form data(input)
        $first_name =  $_REQUEST['first_name'];
        $last_name = $_REQUEST['lastnames'];
        $father_name =  $_REQUEST['full_father_name'];
        $mother_name =  $_REQUEST['full_mother_name'];
        $address = $_REQUEST['personal_address'];
        $sex=$_REQUEST['sex'];
        $city=$_REQUEST['City'];
        $course=$_REQUEST['Course'];
        $country=$_REQUEST['Country'];
        $state=$_REQUEST['State'];
        $district=$_REQUEST['District'];
        $pincode=$_REQUEST['pin_code'];
        $email = $_REQUEST['email_id'];
        $dob = $_REQUEST['date_of_birth'];
        $mobile = $_REQUEST['mobilenumber'];

        $sql = "INSERT INTO s_r_data  VALUES ('$first_name', 
            '$last_name','$father_name','$mother_name','$address','$sex','$city','$course','$country','$state','$district','$pincode','$email','$dob','$mobile')";
        $sql2="SELECT * FROM s_r_data";
        function rand_string( $length ) 
        {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            return substr(str_shuffle($chars),0,$length);
        }
            if(mysqli_query($conn, $sql2)){
                $result=mysqli_query($conn, $sql2);
                $count=0;
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result)) 
                    {
                        if($row["fname"]==$first_name && $row["lname"]==$last_name && $row["ftname"]==$father_name && $row["mname"]==$mother_name &&$row["address"]==$address && $row["gender"]==$sex && $row["city"]==$city && $row["course"]==$course && $row["country"]==$country && $row["state"]==$state && $row["district"]==$district && $row["pincode"]==$pincode && $row["email"]==$email && $row["dob"]==$dob && $row["mobile"]==$mobile)
                        {
                            $count=1;
                            echo "<h1>already registered</h1>";
                        }
                    }
                    if($count==0)
                    {
                        mysqli_query($conn, $sql);
                        echo "<h1>succesfully registered</h1>";
                        $pwd=rand_string(8);
                        $sql1="INSERT INTO usr_pwd VALUES ('$mobile','$pwd')";
                        if(mysqli_query($conn,$sql1))
                        {
                            echo "<p><b>Username:</b>$mobile</p>";
                            echo "<p><b>Password:</b>$pwd</p><br>";
                            echo "<p>Please note down your username and password to login</p>";
                            echo "<p>After login please change your password</p>";
                        }
                        else
                        {
                            echo "ERROR: Hush! Sorry $sql. " 
                        . mysqli_error($conn);
                        }
                    }
                }
                else if(mysqli_num_rows($result)==0)
                {
                    mysqli_query($conn, $sql);
                    echo "<h1>succesfully registered</h1>";
                        $pwd=rand_string(8);
                        $sql1="INSERT INTO usr_pwd VALUES ('$mobile','$pwd')";
                        if(mysqli_query($conn,$sql1))
                        {
                            echo "<p><b>Username:</b>$mobile</p>";
                            echo "<p><b>Password:</b>$pwd</p><br>";
                            echo "<p>Please note down your username and password to login</p>";
                            echo "<p>After login please change your password</p>";
                        }
                        else
                        {
                            echo "ERROR: Hush! Sorry $sql. " 
                        . mysqli_error($conn);
                        }
                }

            }
            else
            {
                echo "ERROR: Hush! Sorry $sql. " 
                . mysqli_error($conn);
            }

            mysqli_close($conn);
            ?>
    </center>
</body>
  
</html>