<!DOCTYPE HTML>
<?php
session_start();
if(!isset($_SESSION['admin_id']))
	header("Location:../index.php");

require_once("pages/functions.php");



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
		
		$("#update_password").validate({
			rules: {
				
				old_password:{
					required:true					
				},
				new_password:{
					required:true,
					minlength:5
					
				},
				confirm_password:{
					required:true,
					minlength:5,
					equalTo:"#new_pass"
				}
			},
			messages: {
				old_password:"Please enter your account password",
				new_password:"Please enter new password",
				confirm_password:"Password should be same as above"
			},
			
		submitHandler: function() { 
			
			$.ajax({
				   type: 'POST',
				   url: $('#update_password').attr('action'),
				   data: $('#update_password').serialize(),  
				   success: function(data){
					   $('#msg').fadeIn();
					    $('#msg').text(data);
						$("input[name='old_password']").val('');
						$("input[name='new_password']").val('');
						$("input[name='confirm_password']").val('');
						$('#msg').delay(1000).fadeOut();
				   }
				});
		}			
		
	});
			
			
			
			
			
		$(".approve").click(function(){
			
			var seller_id=$(this).attr("value");
							
			$.ajax({
				   type: 'POST',
				   url: "pages/approve_sellers.php",
				   data: {id:seller_id},  
				   success: function(data){
					    alert(data);
						window.location.href="index.php";
				   }
				});
		});
		
		$(".modificaiton").click(function(){
			
			var order_id=$(this).attr("value");
					
			$.ajax({
				   type: 'POST',
				   url: "pages/cancel_order.php",
				   data: {id:order_id},  
				   success: function(data){
					    alert(data);
						window.location.href="index.php?pid=2";
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
				<li><a href="index.php"> View Sellers </a></li>
				<li><a href="index.php?pid=1"> View Books </a></li>
				<li><a href="index.php?pid=2"> Orders </a></li>
				<li><a href="index.php?pid=3"> Change Password </a></li>
				<li><a href="logout.php"> Logout </a></li>
				
				</ul>
				
			</div>
			
			
			
			
			
			<div class="col-md-9 col-sm-9" id="rightpart">
					
				<?php
				if(isset($_GET['pid']))
				{
					$pid=$_GET['pid'];
					
					if($pid==1)
						require_once("pages/view_books.php");
					else if($pid==2)
						require_once("pages/orders.php");
					else if($pid==3)
						require_once("pages/change_password.php");
					else
						header("Location:index.php");
				}
				else
				{
					require_once("pages/sellers.php");

				}
		
					?>
			</div>
			
					
			
			
			
			
		</div>
	
		</div>
		
		
		
		
		
	
	
	</div>
</body>
</html>