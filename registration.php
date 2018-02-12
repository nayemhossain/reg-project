<?php 
session_start();
$con=new mysqli('localhost','root','','php_registration');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>registration</title>
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
<?php if(isset($_POST['register'])){ 
			$user_email=$_POST['user_email'];
			$sel_email=$con->query("SELECT * FROM registration_user WHERE user_email='$user_email'");
			$numeml=$sel_email->num_rows;
			if($_POST['user_name']==""){echo "<script>alert('Please fill the name fileds')</script>";} 
			elseif($_POST['user_pass']==""){echo "<script>alert('Please input password')</script>";}
			elseif(!(strlen($_POST['user_pass'])>=4 && strlen($_POST['user_pass'])<=8)){echo"<script>alert(' lenth must be 4 to 8')</script>";} 
			elseif($_POST['user_email']==""){echo "<script>alert('Please input your e-mail')</script>";}
			elseif(filter_var($_POST['user_email'],FILTER_VALIDATE_EMAIL)==false){echo"<script>alert('Invalid E-mail')</script>";} 
			elseif($numeml!==0){echo"<script>alert('This Email is already registered')</script>";}
			elseif($_POST['user_phone']==""){echo"<script>alert('Please don\'t blank Phone')</script>";} 
			elseif($_POST['country']==""){echo "<script>alert('Select Your Country')</script>";} 
			elseif($_POST['b_day']==""){echo "<script>alert('Input Your Date of Birth')</script>";}
			else{
				$user_name=mysqli_real_escape_string($con,$_POST['user_name']);
				$user_pass=mysqli_real_escape_string($con,$_POST['user_pass']);
				$user_email=mysqli_real_escape_string($con,$_POST['user_email']);
				$country=mysqli_real_escape_string($con,$_POST['country']);
				$user_phone=mysqli_real_escape_string($con,$_POST['user_phone']);
				$user_address=mysqli_real_escape_string($con,$_POST['user_address']);
				$user_gender=mysqli_real_escape_string($con,$_POST['user_gender']);
				$b_day=mysqli_real_escape_string($con,$_POST['b_day']);
				$user_image="upload/".$_FILES['user_image']['name'];
				move_uploaded_file($_FILES['user_image']['tmp_name'],$user_image);
				$_SESSION['email']=$user_email;
				if($con->query("INSERT INTO registration_user VALUES(NULL,'$user_name','$user_pass','$user_email','$country','$user_phone','$user_address','$user_gender','$b_day','$user_image',NOW())")){
					echo"Successfully Reqistration";
					echo "<script>window.open('home.php','_self')</script>";
					};
			}
	}?>
<form action="" method="post" enctype="multipart/form-data">
	<table align="center" bgcolor="gray" width="500">
        <tr align="center">
        	<td colspan="8"><h2>New User!! Registration Here</h2></td>    
        </tr>    
        <tr>
        	<td align="right"><strong>Name:</strong></td>
            <td><input type="text" name="user_name" placeholder="enter your name" value="<?php if(isset($_POST['register']))
			{ echo $_POST['user_name'];} ?>"></td>
        </tr>        
        <tr>
        	<td align="right"><strong>Password:</strong></td>
            <td><input type="password" name="user_pass" placeholder="enter your pass" value="<?php if(isset($_POST['register']))
			{ echo $_POST['user_pass'];} ?>"></td>
        </tr>    
        <tr>
        	<td align="right"><strong>Email:</strong></td>
            <td><input type="text" name="user_email" placeholder="enter your Email" value="<?php if(isset($_POST['register']))
			{ echo $_POST['user_email'];} ?>"></td>
        </tr>    
        <tr>
        	<td align="right"><strong>Country:</strong></td>
            <td>
                <select name="country">
                    <option value="" hidden="">Select a country</option>
                    <option>Afganistan</option>
                    <option>Pakistan</option>
                    <option>India</option>	
                    <option>United state</option>
                    <option>Germany</option>    
                </select>    
            </td>
        </tr>
        <tr>
        	<td align="right"><strong>Phone:</strong></td>
        	<td><input type="text" name="user_phone"></td>
        </tr>    
        <tr>
        	<td align="right"><strong>Address:</strong></td>
       		<td><textarea name="user_address" cols="30" rows="5"></textarea></td>
        </tr>    
        <tr>
            <td align="right"><strong>Gender:</strong></td>
            <td>Male: <input type="radio" name="user_gender" value="Male">Female: <input type="radio" name="user_gender" value="Female"></td>
        <tr>
            <td align="right"><strong>Birthday:</strong></td>
            <td><input type="date" name="b_day"></td>    
        </tr>   
        <tr>
            <td align="right"><strong>Image:</strong></td>
            <td><input type="file" name="user_image"></td>    
        </tr>
        <tr align="center">
        	<td colspan="8"><input type="submit" value="Register Now" name="register"></td>   
        </tr>    
    </table>
</form>
<h3 style="text-align:center">Already Registered? <a href="login.php">Log-In Here</a></h3>
</body>
</html>