
<?php 
session_start();
require_once("functions.php"); 
$_SESSION['page_location']="view-all.php";
if(isset($_SESSION['id']))
{
$id=$_SESSION['id'];
$profile_details=fetch_profile($id);
}
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
			
		
			
			
		
			
			<?php
			if(isset($_GET['category']))
			{
				$category=urldecode($_GET['category']);
				echo "<h5>
				<a href=\"index.php\">Home</a> &nbsp; > &nbsp;
				$category
				<hr /> </h5>
			<h3><font style=\"border-bottom:2px solid red;\">$category</font></h3><br />";
			
			$book_info=book_category($category);
			
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
			{
				echo "<h3 style=\"color:red;\">$book_info</h3>";
			}
				
			}
			else
			{		
				header("Location:index.php");		
			}
			
			?>
			
		</div>
	
		</div>
		
		
		
		
		<?php
	require_once("pages/profile.php");
	?>
	
	
	</div>
</body>
</html>