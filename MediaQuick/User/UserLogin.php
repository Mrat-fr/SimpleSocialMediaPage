<?php include("../Navbars/Navbar.php");
$verify = "NO";
if(isset($_POST['Login'])){
  include("../dbConfig.php");

  $username=$_POST['username'];
  $password=$_POST['password'];

  //email
  $check = $db->query("SELECT * FROM users WHERE UserName='$username' AND Password = '$password'"); 
  $rowcount=mysqli_num_rows($check);

  if($rowcount>0){
    $rows=mysqli_fetch_array($check);
    if($rows['Deactivated'] == 'YES'){
      echo "Your accont has been Deactivated";
    }else{
      if($rows['Verified'] == 'NO'){
        echo "Your accont has not been Verified yet";
        $verify = "YES";
      }else{
        session_start();
        $_SESSION['user'] = "user";
        $_SESSION['username'] = $username;
        header('Location: UserPage.php');
      }
    }
  }else{
    echo "wrong username or password";
  }
  
}
?>
<div class="container bgColor">
<?php if($verify == "YES"):?>
      <a href="../Register/Verify.php?uid=<?php echo $rows['Email']; ?>">PLEASE CLICK TO VERIFY</a>
<?php endif; ?>

<h2>Login </h2>

  <form class="form-horizontal" action="UserLogin.php" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Username:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="username" required>
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="email">Password:</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" name="password" required>
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary" name="Login">Login</button>
      </div>
    </div>
  </form>
</div>
</div>  
</div>  


<?php
include("../Footer.php");
?>