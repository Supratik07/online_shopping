<!DOCTYPE HTML>

<?php 
session_start();
require_once("functions.php");
if(!isset($_GET['bk_id']))
header("Location:index.php");	

$id=$_GET['bk_id'];
$book_details=book_details($id);
$book_info=same_category($id);

if(!is_array($book_details))
	header("Location:index.php");	

if(isset($_SESSION['id']))
{
	$status='true';
	$id=$_SESSION['id'];
	$profile_details=fetch_profile($id);
}
else
{
	$_SESSION=array();
	$_SESSION['page_location']="details.php?bk_id=$id";
	$status='false';
	
}

?>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Online Book Store</title>
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="css/style.css" />
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
				
				
				
				
		$("#add_cart").click(function(){
			
			var status=<?php echo $status; ?> ;
			
			if(status==false)
				window.location.href = "login.php?bk_id=<?php echo $id; ?>";
			else
			{
			
			var bk_id=$("#add_cart").val();
						
			$.ajax({
				   type: 'POST',
				   url: "pages/add_to_cart.php",
				   data: {id:bk_id},  
				   success: function(data){
					    window.location.href="details.php?bk_id="+bk_id;
				   }
				});
			}
		});
		
		
		$(".glyphicon-minus").click(function(){
			
			var bk_id=$(this).attr("value");
				
				var bk=<?php echo $_GET['bk_id']; ?>
				
			$.ajax({
				   type: 'POST',
				   url: "pages/remove_from_cart.php",
				   data: {id:bk_id},  
				   success: function(data){
					    window.location.href="details.php?bk_id="+bk;
				   }
				});
		});
		
		$(".glyphicon-plus").click(function(){
			
			var bk_id=$(this).attr("value");
				var bk=<?php echo $_GET['bk_id']; ?>		
				
			$.ajax({
				   type: 'POST',
				   url: "pages/add_to_cart.php",
				   data: {id:bk_id},  
				   success: function(data){
					    window.location.href="details.php?bk_id="+bk;
				   }
				});
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
		
		<div class="container-fluid" id="main-details" style="padding:30px;">
		<div class="row"><a href="index.php">Home </a> >  <?php echo $book_details['bk_name']; ?> <br /></div>
		
		<div class="row row-eq-height-details " >
		
			<div class="col-md-2 col-sm-3 col-xs-3" style="border-right:1px dotted;"> <img src="cover_pics/<?php echo $book_details['bk_img']; ?>" alt="" style="height:200px; width:150px; border:1px solid #EAEAEA; margin-top:15px;" /></div>
			
			<div class="col-md-5 col-sm-5 col-xs-5" style="border-right:1px dotted;">
			<h3><?php echo $book_details['bk_name']; ?></h3>
			<h4>
			<b>Author : </b> <?php echo $book_details['author']; ?>   <br /><br />
			<b>Publisher : </b> <?php echo $book_details['publisher']; ?>   <br /><br />
			<b>Price ( Rs ) : </b>  <?php echo $book_details['price']; ?> /-  <br /><br /><br /> 
			</h4>
			<?php 
			if($book_details['qnty']==0)
				echo "<button class='btn btn-danger' style='pointer-events: none;'>Out of stock </button>";
			else
			echo "<button class='btn btn-info' id='add_cart' value='".$book_details['bk_id']."'>Add To Cart </button> &nbsp; &nbsp; <button class='btn btn-danger' id='buy_now' value='".$book_details['bk_id']."'>Buy Now</button>"	;
			?>
			
			</div>
			
			<div class="col-md-5 col-sm-5 col-xs-5">
			<div id="cart">
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
										</td><td>".$price."</td></tr>";
									}	
									
									echo "<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
									echo "<tr style=''><td style='font-weight:bold; border-bottom:1px solid; border-top:1px solid; '>Total</td>
									<td style='border-bottom:1px solid ; border-top:1px solid;'></td>
									<td style='border-bottom:1px solid ; border-top:1px solid;' class='pull-right'>$total</td></tr>";
									echo "</table>";
									echo "<a href='cart.php'><button class='btn btn-primary pull-right' style='margin-top:30px;'>Proceed To Checkout</button></a>";
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
					
		</div>
		
		
		<div class="row" style="padding:30px; height:35%; ">
		<br /><br />
			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#specification" aria-controls="home" role="tab" data-toggle="tab">PRODUCT SPECIFICATIONS</a></li>
				<li role="presentation"><a href="#information" aria-controls="profile" role="tab" data-toggle="tab">INFORMATION</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content" style="padding:20px; overflow:auto;">
				<div role="tabpanel" class="tab-pane active" id="specification">
				
				<table class="table table-responsive">
					<tr>
						<td>Publisher</td>
						<td><?php echo $book_details['publisher']; ?></td>
					</tr>
					<tr>
						<td>Publication Year</td>
						<td><?php echo $book_details['publication_year']; ?></td>
					</tr>
					<tr>
						<td>ISBN-13</td>
						<td><?php echo $book_details['isbn_13']; ?></td>
					</tr>
					<tr>
						<td>ISBN-10</td>
						<td><?php echo $book_details['isbn_10']; ?></td>
					</tr>
					<tr>
						<td>Binding</td>
						<td><?php echo $book_details['binding']; ?></td>
					</tr>
					<tr>
						<td>Number of pages</td>
						<td><?php echo $book_details['no_pages']; ?></td>
					</tr>
					<tr>
						<td>Language</td>
						<td><?php echo $book_details['language']; ?></td>
					</tr>
				</table>
				
				</div>
				
				<div role="tabpanel" class="tab-pane" id="information" style="overflow:auto;">
				<?php echo $book_details['info']; ?>
				</div>
			 </div>

					
		</div>
		<hr />
		<div class="row" style="padding:10px 30px; overflow:auto;">
			  
			  <h3> <u> Similar Items </u> </h3>
			<?php
			if(is_array($book_info))
			{
					$books=count($book_info);
				$i=0;
				while($i<$books)
				{
					echo "<div class=\"author\" >";
					
					for($j=$i;$j<$i+5;$j++)
					{
						if($j>=$books)
							break;
						echo "<div class=\"author-books\">";
						echo "<a href=\"details.php?bk_id=".$book_info[$j]['bk_id']."\">";
						echo "<img src=\"cover_pics/".$book_info[$j]['bk_img']."\" style=\"height:70%; width:100%; \"/>";
						echo $book_info[$j]['bk_name']."<br />";
						echo "</a>";
						echo "<i class=\"fa fa-inr fa-lg\" aria-hidden=\"true\"></i> <font style='font-size:18px; color:#FF571E;'>".$book_info[$j]['price']."</font>";
						echo "</div>";
					}
					
					echo "</div>";
					echo "<br clear='all' />";
					$i=$i+5;
				}
				
			}
			else
				echo "<h4 style='color:red;'>$book_info<h4>";
			
			
			?>
					
		</div>
	
		</div>
		
		
		
		
		
	
	<?php
	require_once("pages/profile.php");
	?>
	</div>
</body>
</html>