<?php 
session_start();
session_destroy();
if(isset($_SESSION)){
header("Location:login.php");
}
?>