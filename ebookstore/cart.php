<!DOCTYPE HTML>
<?php 
session_start();
require_once("functions.php"); 
$_SESSION['page_location']="cart.php";
if(isset($_SESSION['id']))
{
$id=$_SESSION['id'];
$profile_details=fetch_profile($id);
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
		
		<div class="container-fluid" id="main-author">
		<div class="row "  style="background-color:#fff; padding:30px;" >
				
				<div class="panel panel-primary">
					  <!-- Default panel contents -->
					  <div class="panel-heading"><h4>Cart Items</h4></div>
					  <div class="panel-body" >
						<?php
						if(isset($_SESSION['id']))
						{
							$id=$_SESSION['id'];
							$info=fetch_cart_items($id);
							if(is_array($info))
							{
								
								if(!is_array($info[0]))
									echo $info[0];
								else
								{
									
									$total=0;
									echo "<table class='table'>";
									echo "<tr style='background-color:#353535; color:#fff;'><td>Book</td><td>Quantity</td><td>Price</td></tr>";
									for($i=0;$i<count($info);$i++)
									{
										$sl=$i+1;
										$bk_id=$info[$i]['bk_id'];
										$price=$info[$i]['qnty']*$info[$i]['price'];
										$total=$total+$price;
										echo "<tr><td>$sl. &nbsp;".$info[$i]['bk_name']."</td><td>
										<span class='glyphicon glyphicon-minus btn' aria-hidden='true' value=\"$bk_id\" ></span>
										<font style='font-size:15px; font-weight:bold;'>".$info[$i]['qnty']."
										</font><span class='glyphicon glyphicon-plus  btn' aria-hidden='true' value=\"$bk_id\" ></span>
										</td><td style='text-align:center;'>".$price."</td></tr>";
									}	
									
									echo "<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
									echo "<tr style=''><td style='font-weight:bold; border-bottom:1px solid; border-top:1px solid; '>Total</td>
									<td style='border-bottom:1px solid ; border-top:1px solid;'></td>
									<td style='border-bottom:1px solid ; border-top:1px solid; text-align:center;'>$total</td></tr>";
									echo "</table>";
									echo "<a href='checkout.php'><button class='btn btn-primary pull-right' style='margin-top:30px;'>Proceed To Checkout</button></a>";
								}
							}
							else
							{
								echo $info;
							}
						}
						else
						{
							echo "Your cart is empty.";
						}
						
						?>
						
						
						
					  </div>
					  </div>
			
		</div>
	
		</div>
		
		
		
		
		
	<?php
	require_once("pages/profile.php");
	?>
	
	</div>
</body>
</html>
	