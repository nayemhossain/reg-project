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
				$user_email=mysqli_real_escape_string($con,$_POST['user_email']);
				$ab=$con->query("SELECT * FROM registration_user WHERE user_email='$user_email' AND user_pass='$user_pass'");
				if($ab->num_rows==0){
					echo"<script>alert('E-mail or Password wrong')</script>";
					}else {
						
						$_SESSION['email']=$user_email;
						header("Location:home.php");
						}
	}?>
<form action="" method="post">
	<table align="center" bgcolor="gray" width="500">
        <tr align="center">
        	<td colspan="8"><h2>Log-In Here</h2></td>    
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
        	<td colspan="8"><input type="submit" value="LOG-IN" name="login"></td>   
        </tr>    
    </table>
</form>
<h3 style="text-align:center">New Here? <a href="registration.php">Registration Here</a></h3>
</body>
</html>