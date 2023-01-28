<?php require("../Navbars/NavbarAdmin.php");
include("../dbConfig.php");
session_start();

$Vuser = $_GET["uid"];
//userinfo
$check = $db->query("SELECT * FROM users WHERE UserName='$Vuser'"); 
$rows=mysqli_fetch_array($check);
$Requestsent ="A";
$firstname=$rows['FirstName'];
$lastname=$rows['LastName'];
$email=$rows['Email'];
$username=$rows['UserName'];
$password=$rows['Password'];
$PP=$rows['PP'];
$PD=$rows['PD'];
$friend = array();
$Friarray = array();
$Deactivated=$rows['Deactivated'];
$D = "A";

$posts = $db->query("SELECT * FROM posts WHERE UserName='$Vuser' AND Allow='Public Can View'"); 
$rowcount=mysqli_num_rows($posts);
if($rowcount>0){
  while ($Irow = mysqli_fetch_array($posts)) {
    $Postarray[] = $Irow;
  }
}

//friend
$Fcheck = $db->query("SELECT * FROM friends WHERE RequestFrom='$Vuser' OR RequestTo='$Vuser' AND Decision='YES'"); 
$Frowcount=mysqli_num_rows($Fcheck);
if($Frowcount>0){
  while ($Fget = mysqli_fetch_array($Fcheck)) {
    $Friarray[] = $Fget;
  }
}
for ($i=0; $i<count($Friarray); $i++){

  if($Friarray[$i]['RequestFrom'] != $Vuser)
    $friend[] = $Friarray[$i]['RequestFrom'];
  else
    $friend[] = $Friarray[$i]['RequestTo'];
  
}




if(isset($_POST["Deactivate"])){ 
  $check = $db->query("UPDATE users SET Deactivated = 'YES' WHERE UserName='$Vuser'");
  header('Location: Adminviewuser.php?uid='.$Vuser);
}
if(isset($_POST["Activate"])){ 
  $check = $db->query("UPDATE users SET Deactivated = 'NO' WHERE UserName='$Vuser'");
  header('Location: Adminviewuser.php?uid='.$Vuser);
}

?>

<main role="main" class="pb-3">
<div class="container bgColor">
  <div style= "width:100%; height: 500px; margin: auto;">

    <img src="../images/background.jpg" style= "width: 100%; height: 310px">

    <div style= "margin-top: -50px;">
      <?php if($Deactivated == "NO"):?>
      <form class="form-horizontal" action="" method="post">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-danger" name="Deactivate">Deactivate User</button>
        </div>
      </form>
      <?php else: ?>
      <form class="form-horizontal" action="" method="post">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary" name="Activate">Activate User</button>
        </div>
      </form>

      <?php endif; ?>
    </div>

    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($PP); ?>" class="Avatar"> 

    <div class=" text-uppercase font-weight-bold text-white bg-dark" style= " text-align: center; margin-top: 10px; width: 100%; font-size: 50px">
      <?php echo $username;?><br>
    </div>
    <div class="row">
      
      <div  class="col">
        <div class="N">
          <p class="font-weight-light" style = "font-size: 20px"><?php echo $firstname; echo" ";echo $lastname;?><br> </p>
        </div>
      </div>
      <div  class="col">
        <div class="DE">
          <p class="font-weight-light"> <?php echo $PD;?><br> </p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container bgColor">
    <div class="row">
      
      <div class="gallery col ">
      <h2 style="text-align: center"> User posts</h2>
      <?php if($rowcount>0):
         for ($i=0; $i<count($Postarray); $i++):?>
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($Postarray[$i]['Image']);?>" class="uPosts">   
        <?php endfor; endif;?>
      </div>

      <div class="col-4">

          <h2 style="text-align: center"> User friends</h2>
          <?php if($friend>0):
          for ($i=0; $i<count($friend); $i++):?>
            <div sytle="text-align: center; margin-top: 100px;">
             <a> <?php echo $friend[$i]?> </a>
            </div>
          <?php endfor;  endif; ?>

      </div>
    </div>
</div>


</main>
<br><br><br><br><br>
<?php require("../Footer.php");?>