<!DOCTYPE HTML>
<?php
session_start();
if(!isset($_SESSION['seller_id']))
	header("Location:../index.php");

require_once("pages/functions.php");

$vendor_id=$_SESSION['seller_id'];

$profile_details=seller_info($vendor_id);
?>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Online Book Store</title>
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="css/style.css" />
	<script type="text/javascript" src="js/jquery.js" ></script>
	<script type="text/javascript" src="js/bootstrap.js" ></script>
	<script type="text/javascript" src="js/jquery-ui.js" ></script>
	<script type="text/javascript" src="js/jquery.validate.js" ></script>
	<script type="text/javascript">
	$(document).ready(function(){
		
						
							
		$("#add_book").validate({
			rules: {
				bk_name: "required",
				author:"required",
				publisher:"required",
				pub_yr:"required",
				isbn_13:"required",
				isbn_10:"required",
				binding:"required",
				no_pages:"required",
				lang:"required",
				subject:"required",
				info:"required",
				// bk_img:"required",
				price:"required",
				qnty:"required"
				
			},
			messages: {
				bk_name: "Enter the name of the book",
				author:"Enter the name of the author of the book",
				publisher:"Enter the name of the publisher",
				pub_yr:"Enter the publication year",
				isbn_13:"Enter ISBN-13 of the book",
				isbn_10:"Enter ISBN-10 of the book",
				binding:"Enter the type of binding",
				no_pages:"Enter the number of pages",
				lang:"Language of the book",
				subject:"Subject of the book",
				info:"Detail information about the book",
				bk_img:"Select the cover page image",
				price:"Enter the price of the book",
				qnty:"No. of quantity you want to add."
			}
		});

		$("#update_profile").validate({
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
					
				},
				new_pass:{
					
					minlength:7
					
				}
			},
			messages: {
				name: "Please enter your name",
				email: "Please enter a valid email address",
				mob:"Please enter your phone number",
				address:"Please enter your address",
				pass:"Please enter your account password",
				new_pass:"Please enter a password of minimum 7 character"
			},
			
		submitHandler: function() { 
			
			$.ajax({
				   type: 'POST',
				   url: $('#update_profile').attr('action'),
				   data: $('#update_profile').serialize(),  
				   success: function(data){
					   $('#msg').fadeIn();
					    $('#msg').text(data);
						$("input[name='pass']").val('');
						$("input[name='new_pass']").val('');
						$('#msg').delay(1000).fadeOut();
						
				   }
				});
		}			
		
	});
	
	$(".modificaiton").click(function(){
			
			var order_id=$(this).attr("value");
								
			$.ajax({
				   type: 'POST',
				   url: "pages/cancel_order.php",
				   data: {id:order_id},  
				   success: function(data){
					    alert(data);
						window.location.href="index.php?pid=3";
				   }
				});
		});
		
		$(".despatch").click(function(){
			
			var order_id=$(this).attr("value");
								
			$.ajax({
				   type: 'POST',
				   url: "pages/despatch_order.php",
				   data: {id:order_id},  
				   success: function(data){
					    alert(data);
						window.location.href="index.php?pid=3";
				   }
				});
		});
		
		
	});
	
	</script>

</head>
<body>
	<div class="container">
	<div id="header" class="container-fluid">

		<div class="row head-logo">
			<div class="col-md-8"></div>
			<div class="col-md-4"></div>
		</div>
					
		</div>
		
		<div class="container-fluid" id="main">
		<div class="row row-eq-height">
			
			<div class="col-md-3 col-sm-3" id="leftpart">
				<h1 style="font-family:Old English Text MT; margin-top:50px;"><u>Manage Books</u></h1>
				
				<br />
				
				<ul id="category">
				<li><a href="index.php"> Home </a></li>
				<li><a href="index.php?pid=1"> Add new book </a></li>
				<li><a href="index.php?pid=2"> Change Book Info. </a></li>
				<li><a href="index.php?pid=3"> Orders </a></li>
				<li><a href="logout.php"> Logout </a></li>
				
				</ul>
				
			</div>
			
			
			
			
			
			<div class="col-md-9 col-sm-9" id="rightpart">
					
				<?php
				if(isset($_GET['pid']))
				{
					$pid=$_GET['pid'];
					
					if($pid==1)
						require_once("pages/add_book.php");
					else if($pid==2)
						require_once("pages/edit_book.php");
					else if($pid==3)
						require_once("pages/orders.php");
					else
						header("Location:index.php");
				}
				else
				{
					?>	
					<form action="pages/update_profile.php" method="post" id="update_profile" style="margin-top:30px; margin-left:30px;">
					<input type="hidden" name="user_id"  value="<?php echo $profile_details['vendor_id']; ?>" />
					<table>
					<tr>
						<td>Your Name</td>
						<td><input type="text" name="name" class="form-control" value="<?php echo $profile_details['v_name']; ?>" /></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><textarea name="address" class="form-control" style="resize:none;"> <?php echo $profile_details['v_address']; ?> </textarea></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" name="email" class="form-control"  value="<?php echo $profile_details['v_email']; ?>" /></td>
						<input type="hidden" name="old_email" class="form-control"  value="<?php echo $profile_details['v_email']; ?>" /></td>
					</tr>
					<tr>
						<td>Mobile No.</td>
						<td><input type="text" name="mob" class="form-control"  value="<?php echo $profile_details['v_phone']; ?>"  /></td>
					</tr>
					<tr>
						<td>Old Password</td>
						<td><input type="password" name="pass" id="pass" class="form-control"  /></td>
					</tr>
					<tr>
						<td>New Password</td>
						<td><input type="password" name="new_pass" class="form-control"  /> &nbsp;
						 [ If you want to change ]
						</td>
					</tr>
					
					
					</table>
					
					
					<br />
				
				
				
							
			  
				 &nbsp; &nbsp;
				<button id="update_btn" name="update_profile" class="btn btn-primary">Save changes</button>
				<br />
				<span id="msg" style="font-size:18px; color:#D85C1E; ">
					</span>
				</form>
				
						<?php
						}
		
					?>
			</div>
			
					
			
			
			
			
		</div>
	
		</div>
		
		
		
		
		
	
	
	</div>
</body>
</html>