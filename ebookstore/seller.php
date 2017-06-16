
<?php 
session_start();
ob_start();
header_remove();

if(isset($_SESSION['seller_id']))
	header("Location:book_vendors/index.php");

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

		<div class="row head-logo">
			<div class="head1">
			<img src="images/bookstore.png" alt="" style="height:125px; width:180px;"/>
			</div>
			
			<div class="head2">
			 <br /><br /><br />
				<form style="border:2px solid #FF571E; padding:0px !important; width:98%;" action="search.php" method="post">
				  				
					   <select name="search" class="form-control" style="width:19.5%;  outline: none; border-color: #fff; float:left;">
					   <option value="Book">Book</option>
					   <option value="Author">Author</option>
					   <option value="Subject">Subject</option>
					   </select>
					
						<label class="sr-only" for="exampleInput">Search by title, author, subject or ISBN here...</label>
						  <input type="text" name="search-item" class="form-control" id="exampleInput" placeholder="Search by title, author, subject or ISBN here..." style="width:61%;  outline: none; border-color:#fff; float:left;">
													
				  <button type="submit" name="submit" style="padding:5px; width:19.5%; background-color:#FF571E; float:left;" >
				  <span class="glyphicon glyphicon-search" aria-hidden="true"></span> &nbsp;
				  Search
				  </button>
				  <br clear="all" />
				</form>
				
			
			</div>
			
			
			<div class="head1">
			<a href="contact.php" class="pull-right">Contact Us</a>
			<br />
			
			
			
			
			<div class="pull-right" style="margin-top:20%; padding-right:20px; font-size:18px; text-decoration:none; "> 
			
			<a href="cart.php">			
			<span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
			Cart</a>
			
			&nbsp;
					
			<a href="login.php">
			<span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span>
			Login</a>
			
			</div>
			
			
			</div>
		</div>

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
				$info=seller_signup($_POST);
				echo $info;		
					header("Refresh:5; url=seller.php");
					
				}
				
				?>
				</span>
				
				
			</div>
			
			
			<div class="col-md-6 col-sm-6" style="border:1px solid #EAEAEA; width:45%; margin-left:5%;">
					
					<h3>Already registered?</h3> <br />
					<br />
					
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="login">
					
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
						$info=seller_login($_POST);
						if(is_array($info))
						{
							$_SESSION['seller_id']=$info['vendor_id'];
							
							echo "<h4 style='color:green;'>Redirecting...</h4>";
							header("Refresh:5; url=book_vendors/index.php");
						}
						else
						{
							echo "<h4 style='color:red;'>$info</h4>";
							
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