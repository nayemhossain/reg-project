<?php 
session_start();
if(!isset($_SESSION['email'])){

header("Location:login.php");
$con=new mysqli('localhost','root','','php_registration');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<button><a href="logout.php">Log-out</a></button>
<h1>This is Home page</h1>
</body>
</html>
