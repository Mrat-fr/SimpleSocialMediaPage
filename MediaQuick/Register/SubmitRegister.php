<?php require("../Navbars/Navbar.php"); 
include("../dbConfig.php");
$status = $statusMsg = $Semail= '';

if (isset($_POST['submit'])){
    
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];

    $Vcode = rand(100000, 999999);
    $Verified = 'N';
    $insert= $db->query("INSERT into user (FirstName,LastName,Email,Password,Vcode,Verified) VALUES ('$firstname','$lastname','$email','$username','$password','$Vcode','$Verified')");
    if($insert){ 
        $statusMsg = "You Are Register</h3>";
    }else{
        $statusMsg = "You Are Not Register</h3>";
    }
    echo $statusMsg; 


    //email check
  //  $Q1="select * from users where Email='$email'";
  //  $que1=mysqli_query($connection, $Q1);
   // $rowcount=mysqli_num_rows($que1);
   // if($rowcount>0){
  //  $rows=mysqli_fetch_array($check);
  //  $Semail=$rows['email'];
  //  }
    
  //  if($name==null || $lastname==null || $email==null || $username==null || $password==null){
  //       echo "<h3 class='text-center'>Please Fill Out Details</h3>";
 //   }
 //   else{
  //      if($Semail==$email){
  //          $statusMsg = "The email has already been registerd";
 //       }
  //      else{
  //          $Vcode = rand(100000, 999999);
  //          $Verified = 'N';
  //          $insert= $db->query("INSERT into users (FirstName,LastName,Email,Password,Vcode,Verified) VALUES ('$firstname','$lastname','$email','$username','$password','$Vcode','$Verified')");
  //          if($insert){ 
  //              $statusMsg = "You Are Register</h3>";
 //           }else{
   //             $statusMsg = "You Are Not Register</h3>";
   //         }
  //      }
  //  }
}
?>