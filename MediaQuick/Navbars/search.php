<?php
include("../dbConfig.php");
session_start();
$Tuser = $_SESSION["user"];

$Suser = $_GET['search'];

$check = $db->query("SELECT * FROM users WHERE UserName = '$Suser'"); 
$rowcount=mysqli_num_rows($check);
if($rowcount>0){
    if ($Tuser == 'user'){
        header('Location: \MediaQuick\User\viewuser.php?uid='.$Suser);
    }else{
        header('Location: \MediaQuick\Admin\Adminviewuser.php?uid='.$Suser);
    }
}else{
    if ($Tuser == 'user'){
        header('Location: \MediaQuick\User\UserPage.php?');
    }else{
        header('Location: \MediaQuick\Admin\AdminPage.php');
    }
}
?>

