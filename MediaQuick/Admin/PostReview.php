<?php require("../Navbars/NavbarAdmin.php");
include("../dbConfig.php");
session_start();

$posts = $db->query("SELECT * FROM posts WHERE Allow='Waiting for approval'"); 

while ($Irow = mysqli_fetch_array($posts)) {
  $Postarray[] = $Irow;
}


if(isset($_POST["Decision"])){ 
    $id = $_GET["uid"];
    $Decision = $_POST['Decision'];
    $insert = $db->query("UPDATE posts SET Allow = '$Decision' WHERE ID='$id'"); 
    header('Location: PostReview.php');
  }
?>

<div class="container bgColor">
  <main role="main" class="pb-3">
  <h2 style="text-align: center">Review Posts</h2>

  <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <td>UserName</td>
                        <td>Post</td>
                        <td>decision</td>
                    </thead>

                    <?php for ($i=0; $i<count($Postarray); $i++):?>
                        <tr>
                        <td> <h><?php echo $Postarray[$i]['UserName'];?></h> </td>
                        <td> <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($Postarray[$i]['Image']);?>"/> </td>
                        <td>
                            <form  action="PostReview.php?uid=<?php echo $Postarray[$i]['ID'] ?>" method="post">
                                <select name="Decision" class="form-control">
                                    <option value="Waiting For Approval">Waiting for approval</option>
                                    <option value="Public Can View">Allow</option>
                                    <option value="Post Denied">Deny</option>
                                </select>
                                <div class="form-group col-md-3">
                                    <input type="submit" name="Allow" value="submit" class="btn btn-primary">
                                </div>
                            </form>
                            </td>     
                        </tr>        
                    <?php endfor;?>  
                                           
                    </tr>
                </table>    
            </div>
        </div>







  </main>
</div >
<br><br><br><br><br>

<?php require("../Footer.php");?>