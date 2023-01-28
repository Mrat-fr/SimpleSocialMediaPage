<?php include("../Navbars/Navbar.php");

if(isset($_POST['register'])){
  $sameE = $sameU = "N";
  $ErrorU = $ErrorE ="";
  include("../dbConfig.php");

  $firstname=$_POST['firstname'];
  $lastname=$_POST['lastname'];
  $email=$_POST['email'];
  $username=$_POST['username'];
  $password=$_POST['password'];
  $Deactivated="NO";
  $Vcode = rand(100000, 999999);
  $Verified = 'NO';
  $image = '../images/default.png'; 
  $PP = addslashes(file_get_contents($image));



  //email
  $check = $db->query("SELECT * FROM users WHERE Email='$email'"); 
  $rowcount=mysqli_num_rows($check);
  if($rowcount>0){
    $sameE = 'Y';
    $ErrorE="The email: $email is already used";
  }

  $check = $db->query("SELECT * FROM users WHERE UserName='$username'"); 
  $rowcount=mysqli_num_rows($check);
  if($rowcount>0){
    $sameU = 'Y';
    $ErrorU="The username: $username is already used";
  }
  
  if($sameE=='Y'){
    echo $ErrorE;
  }else{
    if($sameU=='Y'){
      echo $ErrorU;
    }else{
      $insert =("INSERT INTO users (FirstName,LastName,Email,UserName,Password,Vcode,Verified,PP,Deactivated) VALUES ('$firstname','$lastname','$email','$username','$password','$Vcode','$Verified','$PP','$Deactivated')"); 
      $result = mysqli_query($db,$insert);
      if($result){
        header('Location: Verify.php?uid='.$email);
      }
      else echo"You Not Register";
    }
  }   
}
?>

<div class="container bgColor">
<h2>Register </h2>
  <form class="form-horizontal" action="register.php" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">FirstName:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="firstname" required>
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="email">LastName:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="lastname" required>
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" name="email" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">UserName</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" name="username" required>
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" name="password" required>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary" name="register">Register</button>
      </div>
    </div>
  </form>
  </div>
  </div>  
</div>  


<?php
include("../Footer.php");
?>