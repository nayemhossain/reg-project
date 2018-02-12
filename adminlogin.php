<?php 
session_start();
$con=new mysqli('localhost','root','','php_registration');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>LOG-IN</title>
<style>
body{
	padding:0;
	margin:0;
	background:skyblue;	
	}
table{
	color:white;
	padding:10px;
	width:400px;	
	}
input{
	padding:5px;	
	}
</style>
</head>

<body>
<?php if(isset($_POST['login'])){ 
				$user_pass=mysqli_real_escape_string($con,$_POST['user_pass']);
				$aduser_email=mysqli_real_escape_string($con,$_POST['user_email']);
				$ab=$con->query("SELECT * FROM admin_user WHERE admin_email='$aduser_email' AND admin_pass='$user_pass'");
				if($ab->num_rows==0){
					echo"<script>alert('E-mail or Password wrong')</script>";
					}else {
						
						$_SESSION['admin_email']=$aduser_email;
						header("Location:output.php");
						}
	}?>
<form action="" method="post">
	<table align="center" bgcolor="gray" width="500">
        <tr align="center">
        	<td colspan="8"><h2>Admin panel-Log-In</h2></td>    
        </tr>
        <tr>
        	<td align="right"><strong>Email:</strong></td>
            <td><input type="text" name="user_email" placeholder="enter your Email" value="<?php if(isset($_POST['register']))
			{ echo $_POST['user_email'];} ?>"></td>
        </tr>       
        <tr>
        	<td align="right"><strong>Password:</strong></td>
            <td><input type="password" name="user_pass" placeholder="enter your pass" value="<?php if(isset($_POST['register']))
			{ echo $_POST['user_pass'];} ?>"></td>
        </tr>        
        <tr align="center">
        	<td colspan="8"><input type="submit" value="Admin-Login" name="login"></td>   
        </tr>    
    </table>
</form>
</body>
</html>