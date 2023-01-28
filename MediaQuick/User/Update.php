<?php require("../Navbars/NavbarUser.php");
include("../dbConfig.php");
session_start();
$accont = $_SESSION["username"];

$statusMsg = ''; 

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
if (isset($_POST['submit'])){
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $password=$_POST['password'];
    $PD=$_POST['PD'];

    $Dinsert= $db->query("UPDATE users SET FirstName = '$firstname', LastName = '$lastname', Password = '$password', PD = '$PD' WHERE UserName='$accont'");
    if($Dinsert){ 
        $statusMsg = "Information updated"; 
    }else{ 
        $statusMsg = "Information update failed, please try again."; 
    }  
}
if(isset($_POST["Upload"])){ 
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) { 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            $insert = $db->query("UPDATE users SET PP = '$imgContent' WHERE UserName='$accont'"); 
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 

echo $statusMsg; 
?>

<div class="container bgColor">
    <main role="main" class="pb-3">
        <h2>Update User</h2><br>
        <div class="row">
            <div class="col-11">
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($PP); ?>" /> 

                <form action="Update.php" method="post" enctype="multipart/form-data">
                    <label>Select Image File:</label>
                    <input type="file" name="image">
                    <input type="submit" name="Upload" value="Upload">
                </form>

                <form method="post">

                    <div class="form-group col-md-3">
                        <label class="control-label labelFont">First Name</label>
                        <input class="form-control" type="text" name = "firstname" value="<?php echo $firstname; ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="control-label labelFont">Last Name</label>
                        <input class="form-control" type="text" name = "lastname" value="<?php echo $lastname; ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="control-label labelFont">Password</label>
                        <input class="form-control" type="text" name = "password" value="<?php echo $password; ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="control-label labelFont">Profile Description</label>
                        <input height = "200px" class="form-control" type="text" name = "PD" value="<?php echo $PD; ?>">
                    </div>


                    <div class="form-group col-md-3">
                        <input type="submit" name="submit" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>		
    </main>
</div >

<?php require("../Footer.php");?>