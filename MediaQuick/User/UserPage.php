<?php require("../Navbars/NavbarUser.php");
include("../dbConfig.php");
session_start();
$accont = $_SESSION["username"];
//userinfo
$check = $db->query("SELECT * FROM users WHERE UserName='$accont'"); 
$rowcount=mysqli_num_rows($check);
if($rowcount>0){
  $rows=mysqli_fetch_array($check);
}
$firstname=$rows['FirstName'];
$lastname=$rows['LastName'];
$email=$rows['Email'];
$username=$rows['UserName'];
$password=$rows['Password'];
$PP=$rows['PP'];
$PD=$rows['PD'];
$friend = array();
$Frows = array();
$Rarray = array();
$Friarray = array();
$prowcount = array();
$rrowcount = array();
$frowcount = array();
$Postarray = array();
//posts
$posts = $db->query("SELECT * FROM posts WHERE UserName='$accont'"); 
$prowcount=mysqli_num_rows($posts);
if($prowcount>0){
  while ($Irow = mysqli_fetch_array($posts)) {
    $Postarray[] = $Irow;
  }
}
//request
$Rcheck = $db->query("SELECT * FROM friends WHERE RequestTo='$accont' AND Decision='WATING'"); 
$rrowcount=mysqli_num_rows($Rcheck);
if($rrowcount>0){
  while ($Rget = mysqli_fetch_array($Rcheck)) {
    $Rarray[] = $Rget;
  }
}

//friend
$Fcheck = $db->query("SELECT * FROM friends WHERE RequestFrom='$accont' OR RequestTo='$accont' AND Decision='YES'"); 
$frowcount=mysqli_num_rows($Fcheck);
if($frowcount>0){
  while ($Fget = mysqli_fetch_array($Fcheck)) {
    $Friarray[] = $Fget;
  }
}

for ($i=0; $i<count($Friarray); $i++){
  if($Friarray[$i]['Decision'] == "YES")
    if($Friarray[$i]['RequestFrom'] != $accont)
      $friend[] = $Friarray[$i]['RequestFrom'];
    else
      $friend[] = $Friarray[$i]['RequestTo'];
  
}

if(isset($_POST["Accept"])){ 
  $id = $_GET["uid"];
  $check = $db->query("UPDATE friends SET Decision = 'YES' WHERE ID='$id'");
  header('Location: UserPage.php');
}
if(isset($_POST["Deny"])){ 
  $id = $_GET["uid"];
  $check = $db->query("UPDATE friends SET Decision = 'NO' WHERE ID='$id'");
  header('Location: UserPage.php');
}

?>

<main role="main" class="pb-3">
<div class="container bgColor">
  <div style= "width:100%; height: 500px; margin: auto;">
    <img src="../images/background.jpg" style= "width: 100%; height: 310px">

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
      <h2 style="text-align: center"> Your posts</h2>
      <?php if($rowcount>0):
         for ($i=0; $i<count($Postarray); $i++):?>
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($Postarray[$i]['Image']);?>" class="Posts">  <br>
        <div style="text-align: center; margin-top: -20px; margin-bottom: 20px;">
          Status: <?php echo $Postarray[$i]['Allow'];?> <br>
          <a href="Deletepost.php?uid=<?php echo $Postarray[$i]['ID'];?>">  (Delete)</a>     
         </div>          
        <?php endfor; endif;?>
      </div>

      <div class="col-4">

          <h2 style="text-align: center"> Your friends</h2>
          <?php if ($friend>0):
            for ($i=0; $i<count($friend); $i++):?>
            <div sytle="text-align: center; margin-top: 100px;">
             <a> <?php echo $friend[$i]?> </a>
            </div>
          <?php endfor; endif;?>
        

        <div sytle="bottom">
          <h2 style="text-align: center"> friend requests</h2>
          <?php if ($Rarray>0):
            for ($i=0; $i<count($Rarray); $i++):?>
            <div class="row">
            <table class="table table-striped">
              <tr>
              <td> <a class="col-sm-offset-2 " ><?php echo $Rarray[$i]['RequestFrom'];?></a></td>
                  <form class="form-horizontal" action="UserPage.php?uid=<?php echo $Rarray[$i]['ID'] ?>" method="post">
                    <div class="col-sm-offset-2 col-sm-10">
                    <td>        <button type="submit" class="btn btn-primary" name="Accept">Accept</button></td>
                    </div>
                  </form>
                  <form class="form-horizontal" action="UserPage.php?uid=<?php echo $Rarray[$i]['ID'] ?>" method="post">
                    <div class="col-sm-offset-2 col-sm-10">
                    <td>      <button type="submit" class="btn btn-primary" name="Deny">Deny</button></td>
                    </div>
                  </form>
                </div>  
                <?php endfor;endif;?>
              </tr>
            </table>
        </div>

      </div>
    </div>
</div>


</main>
<br><br><br><br><br>
<?php require("../Footer.php");?>