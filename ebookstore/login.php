
<?php 
session_start();
ob_start();
header_remove();

if(isset($_SESSION['id']))
	header("Location:index.php");

require_once("functions.php");


 ?>
 <!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Online Book Store</title>
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/font-awesome.css" />
	<script type="text/javascript" src="js/jquery.js" ></script>
	<script type="text/javascript" src="js/bootstrap.js" ></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function(){
				
						
		$("#sign_up").validate({
			rules: {
				name: "required",
				email: {
					required: true,
					email: true
				},
				mob:{
					required:true,
					minlength:10,
					maxlength:10
				},
				address:"required",
				pass:{
					required:true,
					minlength:7
				},
				con_pass:{
					required:true,
					minlength:7,
					equalTo:"#pass"
				}
			},
			messages: {
				name: "Please enter your name",
				email: "Please enter a valid email address",
				mob:"Please enter your phone number",
				address:"Please enter your address",
				pass:"Please enter a password of minimum 7 character",
				con_pass:"Please enter the same password"
			}
		});
		
		
	
	});
	
	</script>
	
</head>
<body>
	<div class="container">
	<div id="header" class="container-fluid">
	<?php require_once("header.php"); ?>

		

		<div class="row nav-menu">
			<ul class="head-menu">
				<li class="nav-items"><a href="index.php">Home</a></li>
				<li class="nav-items"><a href="author-list.php">Authors</a></li>
				<li class="nav-items"><a href="publishers.php">Publishers</a></li>
				<li class="nav-items"><a href="view-all.php?category=<?php echo urlencode("Children Books"); ?>">Children Books </a></li>
				<li class="nav-items"><a href="view-all.php?category=<?php echo urlencode("Biography"); ?>">Biography</a></li>
				<li class="nav-items"><a href="view-all.php?category=<?php echo urlencode("Entertainment"); ?>">Entertainment</a></li>
				<li class="nav-items"><a href="view-all.php?category=<?php echo urlencode("Competitive Exam"); ?>">Competitive Exam</a></li>
								
			</ul>
		</div>

		</div>
		
		<div class="container-fluid" id="main-author" style="padding-left:25px;">
		<br />
		<h5><a href="index.php"> Home </a> > Login</h5> 
			
			
			<u><h3>LOGIN / SIGNUP</h3></u><br />
			
		<div class="row row-eq-height"  style="background-color:#fff; padding-left:30px;" >
			
			<div class="col-md-6 col-sm-6" style="border:1px solid #EAEAEA; width:41%;">
					
					<h3>Create an account</h3> <br />
					Please enter the details. <br /><br />
					
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="sign_up">
					<table>
					<tr>
						<td>Your Name</td>
						<td><input type="text" name="name" class="form-control" required/></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><textarea name="address" class="form-control" style="resize:none;" required ></textarea></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" name="email" class="form-control"  required /></td>
					</tr>
					<tr>
						<td>Mobile No.</td>
						<td><input type="text" name="mob" class="form-control" required  /></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="pass" id="pass" class="form-control" required  /></td>
					</tr>
					<tr>
						<td>Confirm Password</td>
						<td><input type="password" name="con_pass" class="form-control" required  /></td>
					</tr>
					<tr> <td></td>	<td></td>	</tr>
					<tr>
						<td><input type="reset" value="Reset"  class="btn pull-right btn-org" style="color:#fff; background-color:#666666;"/></td>
						<td><input type="submit" name="sign_up" value="CREATE AN ACCOUNT"  class="btn btn-org" style="color:#fff; background-color:#666666;" /></td>
					</tr>
					</table>
					</form>
					
					<br />
				
				<span id="msg">
				<?php
				if(isset($_POST['sign_up']))
				{
				$info=signup($_POST);
				echo $info;		
					header("Refresh:5; url=login.php");
					
				}
				
				?>
				</span>
				
				
			</div>
			
			
			<div class="col-md-6 col-sm-6" style="border:1px solid #EAEAEA; width:45%; margin-left:5%;">
					
					<h3>Already registered?</h3> <br />
					<br />
					
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="login">
					<?php if(isset($_GET['bk_id']))
					{
						$bk_id=$_GET['bk_id'];
						echo "<input type='hidden' name='bk_id' value=\"$bk_id\" />";
					}
					?>
					<table>
					<tr>
						<td>Email</td>
						<td><input type="email" name="login_email" id="" class="form-control" required/></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="password" id="" class="form-control" required/></td>
					</tr>
					
					<tr> <td></td>	<td></td>	</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="login" value="SIGN IN"  class="btn btn-org" style="color:#fff; background-color:#666666;" /></td>
					</tr>
					</table>
					</form>
					
					<?php
				
					if(isset($_POST['login']))
					{
						$info=login($_POST);
						if(is_array($info))
						{
							$_SESSION['id']=$info['user_id'];
							$_SESSION['username']=$info['name'];
							
							
							if(isset($_POST['bk_id']))
							{
								require_once("pages/add_cart.php");
							}
							echo "<h4 style='color:green;'>Redirecting...</h4>";
							if(isset($_SESSION['page_location']))
							{
							$page_location=$_SESSION['page_location'];
							header("Refresh:5; url=$page_location");
							}
							else
								header("Refresh:5; url=index.php");
						}
						else
						{
							echo "<h4 style='color:red;'>$info</h4>";
							$_SESSION=array();
						}	
					}
					
					?>
					
					<br />
				
			</div>
			
		
		</div>
	
		</div>
		
		
		
		
		
	
	
	</div>
</body>
</html>
<?php
exit;
ob_end_flush();
?>