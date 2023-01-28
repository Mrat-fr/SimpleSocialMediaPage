<?php require("../Navbars/NavbarUser.php");
include("../dbConfig.php");
session_start();
$accont = $_SESSION["username"];
$allow = "Waiting for approval";
$statusMsg = ""; 
if(isset($_POST["Upload"])){ 
    if(!empty($_FILES["image"]["name"])) { 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            $insert = $db->query("INSERT INTO posts (UserName, Image, Allow) VALUES ('$accont','$imgContent','$allow')"); 
            if($insert){ 
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
    Post

    <form action="Post.php" method="post" enctype="multipart/form-data">
        <label>Select Image File:</label>
        <input type="file" name="image">
        <input type="submit" name="Upload" value="Upload">
    </form>

  </main>
</div >

<?php require("../Footer.php");?>