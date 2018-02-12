<?php 
session_start();
if(!$_SESSION['admin_email']){ 
header("Location:adminlogin.php");
}
$con=new mysqli('localhost','root','','php_registration');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Users-Admin panel</title>
</head>
<style>
body{padding:0;
margin:0;
background:skyblue;}
table{  color:white;
	padding:2px;
	width:1000px;
	background:orange;}
th{ border:2px solid black;}
</style>
<body>
<?php 
$sql="SELECT * FROM registration_user";
$abc=$con->query($sql);
?>
<table align="center">
	<tr align="center"><td colspan="6"><h2>View All Users</h2></td></tr>
	<tr align="center">
    	<th>S.N.</th>
        <th>Name</th>
        <th>E-mail</th>
        <th>Image</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php 
	while($row = $abc->fetch_object()){
	?>
    <tr align="center">
    	<td><?php echo $row->user_id;?></td>
        <td><?php echo $row->user_name;?></td>
        <td><?php echo $row->user_email;?></td>
        <td><img src="<?php echo $row->user_image;?>" height="50"></td>
        <td><?php echo $row->registration_dat;?></td>
        <td><a href="edit.php?id=<?php echo $row->user_id;?>">Edit</a>&nbsp;<a href="delete.php?id=<?php echo $row->user_id;?>">Delete</a></td>
    </tr>
    <?php
	}
	?>
</table>
<h3 style="float:right; margin-right:180px;">Wellcome: <?php echo $_SESSION['admin_email'] ?>&nbsp;<a href="logout.php">Log-out</a></h3>
<?php
if(isset($_GET['id'])){
$p=$_GET['id'];	
$delete="DELETE FROM registration_user WHERE user_id='$p'";
$con->query($delete);
	
	}
?>
</body>
</html>