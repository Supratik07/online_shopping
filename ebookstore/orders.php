<!DOCTYPE HTML>
<?php 
session_start();
require_once("functions.php"); 
$_SESSION['page_location']="orders.php";
if(isset($_SESSION['id']))
{
$id=$_SESSION['id'];
$profile_details=fetch_profile($id);
}
else
	header("Location:index.php");
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
		
		$(".modificaiton").click(function(){
			
			var order_id=$(this).attr("value");
								
			$.ajax({
				   type: 'POST',
				   url: "pages/cancel_order.php",
				   data: {id:order_id},  
				   success: function(data){
					    alert(data);
						window.location.href="orders.php";
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
						  <li><a href="orders.php">Orders</a></li>
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
				
				<?php
				$order_details=order_details($id);
				
				if(is_array($order_details))
				{
					
						if(count($order_details))
						{
						echo "<table class='table'>
							<tr>
								<td>Order Id</td>
								<td>Order Date</td>
								<td>Order Time</td>
								<td>Sub Order Id</td>
								<td>Book Name</td>
								<td>Quatity</td>
								<td>Price</td>
								<td>Address</td>
								<td>Mode of Payment</td>
								<td>Status</td>
								<td>Remarks</td>
								<td></td>
							</tr>";
						
							
							$total=count($order_details);
							$pre_id=0;
							for($i=0;$i<$total;$i++)
							{
								$order_id=$order_details[$i]['order_id'];
									$sub_order_id=$order_details[$i]['sub_order_id'];
									$order_time=$order_details[$i]['order_time'];
									$order_date=$order_details[$i]['order_of_date'];
									$bk_name=$order_details[$i]['bk_name'];
									$bk_id=$order_details[$i]['bk_id'];
									$qnty=$order_details[$i]['qnty'];
									$price=$order_details[$i]['price'];
									$address=$order_details[$i]['address'];
									$payment=$order_details[$i]['payment'];
									$status=$order_details[$i]['status'];
									$remarks=$order_details[$i]['remarks'];
									
									if(strcasecmp($status,"Processing")==0)
											$cancel="<button class='btn btn-danger modificaiton' value='$order_id'>Cancel</button>";
										else
											$cancel="";
									
								if($order_details[$i]['order_id']==$order_details[$pre_id]['order_id'])
								{
																			
									if($i==0)
									{
										
										
										echo "<tr>
												<td>$order_id</td>
												<td>$order_date</td>
												<td>$order_time</td>
												<td>$sub_order_id</td>
												<td>$bk_name</td>
												<td>$qnty</td>
												<td>$price</td>
												<td>$address</td>
												<td>$payment</td>
												<td>$status</td>
												<td>$remarks</td>
												<td>$cancel</td>
											</tr>";
									}
									else
									{
											echo "<tr>
												<td></td>
												<td></td>
												<td></td>
												<td>$sub_order_id</td>
												<td>$bk_name</td>
												<td>$qnty</td>
												<td>$price</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>";
									}
									
								}
								else
								{
									echo "<tr>
												<td>$order_id</td>
												<td>$order_date</td>
												<td>$order_time</td>
												<td>$sub_order_id</td>
												<td>$bk_name</td>
												<td>$qnty</td>
												<td>$price</td>
												<td>$address</td>
												<td>$payment</td>
												<td>$status</td>
												<td>$remarks</td>
												<td>$cancel</td>
											</tr>";
								}
								$pre_id=$i;
							}
							echo "</table>";
						}
					
					
				}
				else
					echo $order_details;
				
			
				
				
				?>
			
		</div>
	
		</div>
		
		
		
		
		
	<?php
	require_once("pages/profile.php");
	?>
	
	</div>
</body>
</html>
	