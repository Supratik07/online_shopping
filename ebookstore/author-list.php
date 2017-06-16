<!DOCTYPE HTML>
<?php 
session_start();
require_once("functions.php"); 
$_SESSION['page_location']="author-list.php";
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
		
		<div class="container-fluid" id="main-author">
		<div class="row "  style="background-color:#fff; padding:30px;" >
			
		
			
			
		
			
			<?php
			if(isset($_GET['author']))
			{
				$author=$_GET['author'];
				echo "<h5>
				<a href=\"index.php\">Home</a> &nbsp; > &nbsp;
				<a href=\"author-list.php\">Authors</a> &nbsp;  > &nbsp;
				$author
				<hr /> </h5>
			<h3><font style=\"border-bottom:2px solid red;\">$author</font></h3><br />";
			
			$book_info=book_info($author);
			
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
			
			echo "<h5><a href=\"index.php\">Home</a> &nbsp; > &nbsp; Authors <hr /> </h5>
			<h3><font style=\"border-bottom:2px solid red;\">Authors</font></h3><br />";
			$record=author_list();
			if(is_array($record))
			{
				$i=0;
				while($i<count($record))
				{
					echo "<div class='col-md-2'><ul>";
					for($j=$i;$j<$i+10;$j++)
					{
						if($j>=count($record))
							break;
						
						if(strcasecmp(trim($record[$j]),"unknown")==0)
							echo "";
						else
						echo "<li><a href=\"author-list.php?author=".$record[$j]."\">$record[$j]</a></li>";
					}
					echo "</ul></div>";
					$i=$i+10;
					
				}
			}
			else
				echo $record;
			
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