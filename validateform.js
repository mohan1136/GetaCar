function validateHTMlform()
{ 
  let form = document.StudenSignupForm;
   if( form.firstname.value == "" )
   {
     alert( "Enter Your First Name!" );
     return false;
   }
   if( form.lastnames.value == "" )
   {
     alert( "Enter Your Last Name!" );
     return false;
   }
  
   if( form.fathername.value == "" )
   {
     alert( "Enter Your Father Name!" );
     return false;
   }
   if( form.mothername.value == "" )
   {
     alert( "Enter Your Mother Name!" );
     return false;
   }
   if( form.personaladdress.value == "" )
   {
     alert( "Enter Your Personal Address!" );
     return false;
   }
   if ( ( StudenSignupForm.sex[0].checked == false ) && ( StudenSignupForm.sex[1].checked == false ) )
   {
     alert ( "Choose Your Gender: Male or Female" );
     return false;
   }   
   if( form.city.value == "" )
   {
     alert( "Enter Your City!" );
     return false;
   }   
   if( form.Course.value == "-1" )
   {
     alert( "Enter Your Course!" );
     return false;
   }  
   if( form.Country.value == "" )
   {
     alert( "Select Your Country" );
     return false;
   } 
   if( form.State.value == "" )
   {
     alert( "Select Your State!");
     return false;
   } 
   if( form.District.value == "" )
   {
     alert( "Select Your District!" );
     return false;
   } 
   if( form.pincode.value == "" ||
           isNaN( form.pincode.value) ||
           form.pincode.value.length != 6 )
   {
     alert( "Enter your pincode in format ######." );
     return false;
   }
    var email = form.emailid.value;
    atpos = email.indexOf("@");
    dotpos = email.lastIndexOf(".");
    if (email == "" || atpos < 1 || ( dotpos - atpos < 2 )) 
     {
         alert("Enter your correct email ID")
         return false;
     }
    if( form.dob.value == "" )
      {
        alert( "Enter your DOB!" );
        return false;
      }
    if( form.mobilenumber.value == "" || isNaN( form.mobilenumber.value) || form.mobilenumber.value.length != 10 )
       {
         alert( "Enter your Mobile No. in the format 123." );
         return false;
       }
    return true;
}