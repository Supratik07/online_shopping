
<!DOCTYPE HTML>
<?php 
session_start();
require_once("functions.php"); 
$_SESSION['page_location']="billing_process.php";
if(isset($_SESSION['id']))
{
$id=$_SESSION['id'];
$profile_details=fetch_profile($id);
if(!isset($_SESSION['cart']))
	header("Location:cart.php");

}
?>

<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Online Book Store</title>
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/font-awesome.css" />
	<script type="text/javascript" src="js/jquery.js" ></script>
	<script type="text/javascript" src="js/bootstrap.js" ></script>
	<script type="text/javascript" src="js/jquery.validate.js" ></script>
	<script type="text/javascript">
	$(document).ready(function(){
		
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
					    $('#msg').text(data);
						$("input[name='pass']").val('');
						$("input[name='new_pass']").val('');
						$('#msg').delay(1000).fadeOut();
				   }
				});
		}			
		
	});
		
		$(".glyphicon-minus").click(function(){
			
			var bk_id=$(this).attr("value");
							
			$.ajax({
				   type: 'POST',
				   url: "pages/remove_from_cart.php",
				   data: {id:bk_id},  
				   success: function(data){
					    window.location.href="cart.php";
				   }
				});
		});
		
		$(".glyphicon-plus").click(function(){
			
			var bk_id=$(this).attr("value");
								
			$.ajax({
				   type: 'POST',
				   url: "pages/add_to_cart.php",
				   data: {id:bk_id},  
				   success: function(data){
					    window.location.href="cart.php";
				   }
				});
		});
		
	});
	
	</script>
	
	
</head>
<body>
<?php

			date_default_timezone_set("Asia/Kolkata");

			if(isset($_POST['place_order']))
			{
			$suborder=$_SESSION['cart'];

			$order_id=strtotime("now");

			$curr_date = date('Y-m-d');

			$curr_time=date("H:i:s");
			$user_id=$_SESSION['id'];


			$con=mysqli_connect("localhost","root","","online_book_store");
				if($con)
				{
					$address=mysqli_real_escape_string($con,trim($_POST['address']));
					$payment=$_POST['payment'];
					
					$error=0;
					for($i=0;$i<count($suborder);$i++)
					{
						$bk_id=$suborder[$i]['bk_id'];
							$query="select * from books where bk_id=$bk_id ";
							if($result=mysqli_query($con,$query))
							{
								if(mysqli_affected_rows($con))
								{
									$data=mysqli_fetch_array($result,MYSQLI_ASSOC);
									if($data['qnty']==0)
									{
										$error++;
										$msg=$suborder[$i]['bk_name']." is <b>out of stock</b>. Please remove the item from cart.";
										echo "<script>alert('$msg');</script>";
										echo "<script>window.open('cart.php','_self');</script>";
										exit;
									}
									else 
									{
										if($data['qnty']<$suborder[$i]['qnty'])
										{
											$error++;
											$msg=$suborder[$i]['bk_name']." has only ".$data['qnty']." stocks. Please reduce the quantity.";
											echo "<script>alert('$msg');</script>";
											echo "<script>window.open('cart.php','_self');</script>";
											exit;
										}
									}
								}
							}
					}
					
					if($error==0)
					{
						mysqli_query($con,"SET AUTOCOMMIT=0");
						mysqli_query($con,"START TRANSACTION");
						$query="insert into orders(order_id,order_of_date,order_time,user_id,address,payment,status) 
						values($order_id,'$curr_date','$curr_time',$user_id,'$address','$payment','Processing')";
						if(mysqli_query($con,$query))
						{
							$errors=0;
							for($i=0;$i<count($suborder);$i++)
							{
							$bk_id=$suborder[$i]['bk_id'];	
							$sub_order=$order_id.$bk_id;
							$qnty=$suborder[$i]['qnty'];
							$price=$suborder[$i]['qnty']*$suborder[$i]['price'];
							$bk_name=$suborder[$i]['bk_name'];
							
							$query1="insert into sub_order(order_id,sub_order_id,bk_id,bk_name,qnty,price)
							values ('$order_id','$sub_order',$bk_id,'$bk_name',$qnty,$price)";
							if(mysqli_query($con,$query1))
							{
								$query2="update books set qnty=qnty-$qnty where bk_id=$bk_id";
								if(mysqli_query($con,$query2))
								{
									$query3="delete from cart_items where bk_id=$bk_id and user_id=$user_id";
									if(!mysqli_query($con,$query3))
										$errors++;
								}
								else
								{
									echo mysqli_error($con);
									$errors++;
								}
							}
							else
							{
								echo mysqli_error($con);
								$errors++;
							}
								
							}
							
							if($errors==0)
							{
								mysqli_query($con,"COMMIT");
								$msg= "<center><h3 style='color:green; margin-top:50px;'>Order have been placed successfully.</h3></center>";
								unset($_SESSION['cart']);
							}
							else
							{
								echo mysqli_error($con);
								mysqli_query($con,"ROLLBACK");
								
							}
							
							}
							else
								echo mysqli_error($con);
						}
						else
							echo mysqli_error($con);
					
					
						}
						else
						{
							echo "Database connection failed.";
						}

					}




		?>

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
			
			
			
			
			<div class="pull-right" style="margin-top:20%; padding-right:20px; font-size:16px; text-decoration:none; "> 
			
			<a href="cart.php" style="float:left;">			
			<span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
			Cart</a>
			
			&nbsp;
				
					<?php 
					if(isset($_SESSION['id']))
					{
						?>
						<div class="dropdown"  style="float:left; margin-left:15px; color:#46BBFF; cursor:pointer; ">
						<font class="dropdown-toggle" type="button" data-toggle="dropdown"><?php $username=$_SESSION['username'];
						$fname=explode(' ',$username);
						echo "Hi! ".ucfirst($fname[0])	;
						?>
						<span class="caret"></span></font>
						<ul class="dropdown-menu">
						  <li><a href="#" data-toggle="modal" data-target="#profile">Update Profile</a></li>
						  <li><a href="#">Orders</a></li>
						  <li><a href="logout.php">Logout</a></li>
						</ul>
					  </div>
					  <br clear="all"/>
					<?php
					}
					else
					{
						
					?>
			<a href="login.php">
			<span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span>
			Login</a>
			
			<?php
					}
					?>
			
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
		
		<div class="container-fluid" id="main-author" style="background:url('images/thank_you_page.jpg') 0 0 / 100% 100%;">
		<div class="row "  style="padding:30px; "  >
				
		<?php
		if(isset($msg))
			echo $msg;
		?>
			
		</div>
	
		</div>
		
		
		
		
		
	<?php
	require_once("pages/profile.php");
	?>
	
	</div>
</body>
</html>
	


