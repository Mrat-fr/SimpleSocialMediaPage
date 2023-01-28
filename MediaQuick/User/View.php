<!doctype html>
<html lang="en">
  <head>
    <title>portfolio</title>
    <link rel="stylesheet" href="\portfolioV2\Style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
  </head>



<?php
include("db.php");
$port = $_GET['uid'];
$pro = $db->query("SELECT * FROM portfolio WHERE PortfolioID='$port'"); 
$rowcount=mysqli_num_rows($pro);
if($rowcount>0){ 
    $PINFO=mysqli_fetch_array($pro);
    $BGimage = $PINFO['Background'];
    $title = $PINFO['Title'];
    $Texttext = $PINFO['TextText'];
    $video = $PINFO['Video'];
}

//images
$posts = $db->query("SELECT * FROM portfolioimages WHERE PortfolioID='$port'"); 
$prowcount=mysqli_num_rows($posts);
if($prowcount>0){
  while ($Irow = mysqli_fetch_array($posts)) {
    $Postarray[] = $Irow;
  }
} 
?>


<div class="container">

    <img onerror="this.onerror=null; this.src='../image/grey.jpg'" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($BGimage); ?>" style= "width: 100%; height: 310px">

    <div class="Title">
        <form class="form-horizontal" method="post">
                <h> <?php echo $title;?> </h>
        </form>
    </div>

    <div class="Text-Block">
        <form class="form-horizontal" method="post">
                <input style="height: 200px;" type="text" name="Title" value="<?php echo $Texttext;?>">
        </form>
    </div>

    <iframe width="100%" height="500" src="<?php echo $video ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

    <div class="gallery col ">
        <?php if($prowcount>0):
        for ($i=0; $i<count($Postarray); $i++):?>
        <img style="width:100%;height: 500px;" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($Postarray[$i]['Image']);?>" class="Posts">  <br>
        <div style="background-color: black;text-align: center;">
        </div>          
        <?php endfor; endif;?>
    </div>

</div>


  
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php require("../Footer.php");?>