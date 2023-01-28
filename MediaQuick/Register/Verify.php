<?php require("../Navbars/Navbar.php");
include("../dbConfig.php");
$email = $_GET['uid'];
$check = $db->query("SELECT * FROM users WHERE Email='$email'"); 
$rowcount=mysqli_num_rows($check);
if($rowcount>0){
    $rows=mysqli_fetch_array($check);
    $code=$rows['Vcode'];

    $to = $email;
    $subject = "Billygram verification";
    $message = "verification code:".$code;
    $headers = "From: Billigram\r\n";
    mail($to, $subject, $message, $headers);

}


$errorc = "";
$allFields = "yes";

if (isset($_POST['submit'])){

	if ($_POST['code'] != $code){
        $errorc = "Invalid code";
        $allFields = "no";
    }

    if($allFields == "yes")
    {
        $sql= "UPDATE users SET Verified = 'YES' WHERE Email = '$email'";
        mysqli_query ($db,$sql) ;

        header('Location: ../Index.php');
    }
}
	
?>

	<div class="container bgColor">
        <main role="main" class="pb-3">
		<h1>Verify accont</h2><br>
		<p>Go to E-mail used to register to verify</p>
		<div class="row">
                <div class="col-6">
                    <form method="post">
                        <div class="form-group col-md-6">
                                <label class="control-label labelFont">Code</label>
                                <input class="form-control" type="text" name = "code">
                                <span class="text-danger"><?php echo $errorc; ?></span>
                        </div>
                        
                        <div class="form-group col-md-4">
                                <input class="btn btn-primary" type="submit" value="Submit" name ="submit">
                        </div>
                    </form>
                </div>
            </div>		
		</main>
	</div>

<?php require("../Footer.php");?>