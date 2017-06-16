
<?php 
session_start();
require_once("functions.php");

$comp=book_category("Computer & Internet");
$edu=book_category("Eductional and Professional");
$exam=book_category("Competitive Exams");

if(is_array($comp) && is_array($edu) && is_array($exam))
{
	if(count($comp)<5 || count($edu)<5 || count($exam)<5)
	{
	echo "Service is not available. Please try again later.";
	exit();
	}
}
else
{	
	echo "Service is not available. Please try again later.";
	exit();
}
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

		<div class="row head-img">
								<div id="myslider" class="carousel slide" data-ride="carousel">
										  <!-- Indicators -->
										  <ol class="carousel-indicators">
										    <li data-target="#myslider" data-slide-to="0" class="active"></li>
										    <li data-target="#myslider" data-slide-to="1"></li>
										    <li data-target="#myslider" data-slide-to="2"></li>
										    <li data-target="#myslider" data-slide-to="3"></li>
										    <li data-target="#myslider" data-slide-to="4"></li>
										  </ol>

										  <!-- Wrapper for slides -->
										  <div class="carousel-inner" role="listbox" style="max-height:370px;">

										    <div class="item active">
										      <img src="images/children-book-banner.jpg" alt="..." style="height:370px; width:100%;">
										      <div class="carousel-caption">
										        <h3 style="color:#FF2D49;">Children Special</h3>
										      </div>
										    </div>

										    <div class="item">
										      <img src="images/Exam-book-banner.jpg" alt="..." style="height:370px; width:100%;">
										      <div class="carousel-caption">
										        <h3 style="color:#FF2D49;">Exam Preparation</h3>
										      </div>
										    </div>

										    <div class="item">
										      <img src="images/self-help-book-banner.jpg" alt="..." style="height:370px; width:100%;">
										      <div class="carousel-caption">
										        <h3 style="color:#FF2D49;">Self Esteem</h3>
										      </div>
										    </div>
											<div class="item">
										      <img src="images/SBIPO.jpg" alt="..." style="height:370px; width:100%;">
										      <div class="carousel-caption">
										        <h3 style="color:#FF2D49;">Competitive Exam</h3>
										      </div>
										    </div>
											<div class="item">
										      <img src="images/fiction.jpg" alt="..." style="height:370px; width:100%;">
										      <div class="carousel-caption">
										        <h3 style="color:#FF2D49;">Fiction</h3>
										      </div>
										    </div>
										   
										   
										  </div>


										  <!-- Controls -->
										  <a class="left carousel-control" href="#myslider" role="button" data-slide="prev">
										    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
										    <span class="sr-only">Previous</span>
										  </a>
										  <a class="right carousel-control" href="#myslider" role="button" data-slide="next">
										    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
										    <span class="sr-only">Next</span>
										  </a>
									</div>
		</div>
		
		</div>
		
		<div class="container-fluid" id="main">
		<div class="row row-eq-height"  style="background-color:#fff;" >
			
			<div class="col-md-3 col-sm-3" id="leftpart" >
				<h1 style="font-family:Old English Text MT; margin-top:50px;"><u>Category</u></h1>
				
				<br />
				
				<ul id="category">
				<li><a href="view-all.php?category=<?php echo urlencode("Arts & Photography"); ?>"> >> Arts & Photography </a></li>
				<li><a href="view-all.php?category=<?php echo urlencode("Biography"); ?>"> >> Biography </a></li>
				<li><a href="view-all.php?category=<?php echo urlencode("Business & Investing"); ?>"> >> Business & Investing </a></li>
				<li><a href="view-all.php?category=<?php echo urlencode("Children Books"); ?>"> >> Children Books </a></li>
				<li><a href="view-all.php?category=<?php echo urlencode("College Text & Reference"); ?>"> >> College Text & Reference </a></li>
				<li><a href="view-all.php?category=<?php echo urlencode("Computer & Internet"); ?>"> >> Computer & Internet </a></li>
				<li><a href="view-all.php?category=<?php echo urlencode("Cooking & Food"); ?>"> >> Cooking & Food </a> </li>
				<li><a href="view-all.php?category=<?php echo urlencode("Eductional and Professional"); ?>"> >> Eductional and Professional </a></li>
				<li><a href="view-all.php?category=<?php echo urlencode("Entertainment"); ?>"> >> Entertainment </a></li>
				<li><a href="view-all.php?category=<?php echo urlencode("Competitive Exams"); ?>"> >> Competitive Exams </a></li>
				</ul>
				
			</div>
			
			
			
			
			
			<div class="col-md-9 col-sm-9" id="rightpart">
					<div class="new" >
					<h3><u>Computer & Internet<u></h3><br />
					<?php
					for($j=0;$j<5;$j++)
					{						
						echo "<div class=\"new-items\">";
						echo "<a href=\"details.php?bk_id=".$comp[$j]['bk_id']."\">";
						echo "<img src=\"cover_pics/".$comp[$j]['bk_img']."\" style=\"height:65%; width:100%; \"/>";
						echo $comp[$j]['bk_name']."<br />";
						echo "</a>";
						echo "<i class=\"fa fa-inr fa-lg\" aria-hidden=\"true\"></i> <font style='font-size:18px; color:#FF571E;'>".$comp[$j]['price']."</font>";
						echo "</div>";
					}
					
					?>
					<br clear="all"/>
					
					</div>
					
					
					
					<div class="new" >
					<h3><u>Eductional and Professional <u></h3><br />
					<?php
					for($j=0;$j<5;$j++)
					{						
						echo "<div class=\"new-items\">";
						echo "<a href=\"details.php?bk_id=".$edu[$j]['bk_id']."\">";
						echo "<img src=\"cover_pics/".$edu[$j]['bk_img']."\" style=\"height:65%; width:100%; \"/>";
						echo $edu[$j]['bk_name']."<br />";
						echo "</a>";
						echo "<i class=\"fa fa-inr fa-lg\" aria-hidden=\"true\"></i> <font style='font-size:18px; color:#FF571E;'>".$edu[$j]['price']."</font>";
						echo "</div>";
					}
					
					?>
					<br clear="all"/>
					</div>
					
					
					
					<div class="new" >
					<h3><u>Competitive Exam Preparation <u></h3><br />
					<?php
					for($j=0;$j<5;$j++)
					{						
						echo "<div class=\"new-items\">";
						echo "<a href=\"details.php?bk_id=".$exam[$j]['bk_id']."\">";
						echo "<img src=\"cover_pics/".$exam[$j]['bk_img']."\" style=\"height:65%; width:100%; \"/>";
						echo $exam[$j]['bk_name']."<br />";
						echo "</a>";
						echo "<i class=\"fa fa-inr fa-lg\" aria-hidden=\"true\"></i> <font style='font-size:18px; color:#FF571E;'>".$exam[$j]['price']."</font>";
						echo "</div>";
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