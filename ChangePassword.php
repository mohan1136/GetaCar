<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
	function Validate()
	{
		let form=document.ChangePassword;
		var user=form.username.value;
		var pass=form.oldpassword.value;
		var new_pass=form.newpassword.value;
		var r_new_pass=form.r_newpassword.value;
		if(user=="")
		{
			alert("please enter username");
			return false;
		}
		else if(pass=="")
		{
			alert("please enter password");
			return false;
		}
		else if(new_pass=="")
		{
			alert("please enter new password");
			return false;
		}
		else if(r_new_pass=="")
		{
			alert("please enter retype new password");
			return false;
		}
		else if(pass.length<8)
		{
			alert("oldpassword length should be atleast 8");
			return false;
		}
		else if(new_pass!=r_new_pass)
		{
			alert("passwords must be same");
			return false;
		}
		else if(new_pass.length<8)
		{
			alert("new password length should be atleast 8");
			return false;
		}
		else
		{
			return true;
		}
	}
	function myFunction()
	{
		var x = document.getElementById("oldpassword");
		var y = document.getElementById("newpassword");
		var z = document.getElementById("r_newpassword");
		  if (x.type === "password") {
		    x.type = "text";
		  } else {
		    x.type = "password";
		  }
		  if (y.type === "password") {
		    y.type = "text";
		  } else {
		    y.type = "password";
		  }
		  if (z.type === "password") {
		    z.type = "text";
		  } else {
		    z.type = "password";
		  }
	}
</script>
</head>
<body>

<form action="ChangePasswordData.php" method="post" style="margin-block-end: 0rem;" name="ChangePassword" onsubmit="return Validate()">

<div cellpadding="2" width="20%" bgcolor="99FFFF" align="center"
cellspacing="2">

<div class="col-lg-12">
<font size=4><b>Change Password</b></font>
</div>

<div class="row">
<div class="col-lg-3">
  <label for="username">Username</label>
</div>
<div class="col-lg-1">
  <label>:</label>
</div>
<div class="col-lg-6">
  <input type=text class="form-control buttonIn" name="username" id="username" autocomplete="Off" placeholder="username">
</div>
</div>

<div class="row">
<div class="col-lg-3">
  <label for="oldpassword">Old Password</label>
</div>
<div class="col-lg-1">
  <label>:</label>
</div>
<div class="col-lg-6">
  <input type="password" class="form-control" name="oldpassword" id="oldpassword" autocomplete="Off" placeholder="old password">
</div>
</div>

<div class="row">
<div class="col-lg-3">
  <label for="newpassword">New Password</label>
</div>
<div class="col-lg-1">
  <label>:</label>
</div>
<div class="col-lg-6">
  <input type="password" class="form-control" name="newpassword" id="newpassword" autocomplete="Off" placeholder="new password">
</div>
</div>

<div class="row">
<div class="col-lg-3">
  <label for="r_newpassword">Retype New Password</label>
</div>
<div class="col-lg-1">
  <label>:</label>
</div>
<div class="col-lg-6">
  <input type="password" class="form-control" name="r_newpassword" id="r_newpassword" autocomplete="Off" placeholder="new password">
</div>
</div>

<div class="row">
 <div class="col-lg-12" style="margin-top: 10px;">
<input type="checkbox" onclick="myFunction()">Show Password
</div>

<div class="row">
 <div class="col-lg-12" style="margin-top: 10px;">
<input type="reset" class="btn btn-danger"/>
</div>
<div class="col-lg-12" style="margin-top: 10px;">
<input type="submit"  class="btn btn-primary" value="Submit"/>
</div>

<div class="col-lg-12" style="margin-top: 10px;">
	<a href="indexc.html">Go to home</a>
</div>

</div>
</form>
</body>
</html>