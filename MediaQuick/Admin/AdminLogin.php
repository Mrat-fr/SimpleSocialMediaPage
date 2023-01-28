<?php include("../Navbars/Navbar.php");

if(isset($_POST['Login'])){
  include("../dbConfig.php");

  $username=$_POST['username'];
  $password=$_POST['password'];

  //email
  $check = $db->query("SELECT * FROM admin WHERE UserName='$username' AND Password = '$password'"); 
  $rowcount=mysqli_num_rows($check);
  if($rowcount>0){
    session_start();
    $_SESSION['user'] = "admin";
    header('Location: AdminPage.php');
    echo "logined in ";
  }else{
    echo "wroing username or password";
  }
  
}
?>
<div class="container bgColor">

<h2>Admin Login</h2>

  <form class="form-horizontal" action="AdminLogin.php" method="post">
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