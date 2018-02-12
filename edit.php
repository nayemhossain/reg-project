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
<title>Update Information</title>
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
<?php 
$p=$_GET['id'];
if(isset($_POST['register'])){ 
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
				if($con->query("UPDATE registration_user SET user_name='$user_name',user_pass='$user_pass',user_email='$user_email',user_country='$country',user_phone'$user_phone',user_address='$user_address',user_gender='$user_gender',dob='$b_day',user_image='$user_image' WHERE user_id='$p'")){
					echo"Successfully Updated";
					header("Location:output.php");
					};
			
	}
	$sql="SELECT * FROM registration_user WHERE user_id='$p'";
	$abc=$con->query($sql);
	$abcd=$abc->fetch_object();
	?>
<form action="" method="post" enctype="multipart/form-data">
	<table align="center" bgcolor="gray" width="500">
        <tr align="center">
        	<td colspan="8"><h2>Existing User!! Update Here</h2></td>    
        </tr>    
        <tr>
        	<td align="right"><strong>Name:</strong></td>
            <td><input type="text" name="user_name" value="<?php echo $abcd->user_name; ?>"></td>
        </tr>        
        <tr>
        	<td align="right"><strong>Password:</strong></td>
            <td><input type="password" name="user_pass" value="<?php echo $adcd->user_pass; ?>"></td>
        </tr>    
        <tr>
        	<td align="right"><strong>Email:</strong></td>
            <td><input type="text" name="user_email" value="<?php echo $abcd->user_email; ?>"></td>
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
        	<td><input type="text" name="user_phone" value="<?php echo $abcd->user_phno; ?>"></td>
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
            <td><input type="date" name="b_day" value="<?php echo $abcd->dob; ?>"></td>    
        </tr>   
        <tr>
            <td align="right"><strong>Image:</strong></td>
            <td><input type="file" name="user_image"></td>    
        </tr>
        <tr align="center">
        	<td colspan="8"><input type="submit" value="Update" name="register"></td>   
        </tr>    
    </table>
</form>
</body>
</html>