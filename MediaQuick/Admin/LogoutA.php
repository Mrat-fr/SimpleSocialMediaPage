<?php 
session_start();
session_destroy();
header('Location: \MediaQuick\Index.php');
exit;

?>