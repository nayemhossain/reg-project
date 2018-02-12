<?php
$con=new mysqli('localhost','root','','php_registration');
$p=$_GET['id'];
$delete="DELETE FROM registration_user WHERE user_id='$p'";
$con->query($delete);
header("Location:output.php");
?>