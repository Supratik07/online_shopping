<?php
session_start();
if(isset($_SESSION['id']))
{
	$user_id=$_SESSION['id'];

if(isset($_POST['id']))
{
	$bk_id=$_POST['id'];
	
	$con=mysqli_connect("localhost","root","","online_book_store");;
	if($con)
	{
			$query="select * from cart_items where user_id=$user_id and bk_id=$bk_id";
			if(mysqli_query($con,$query))
			{
				if(mysqli_affected_rows($con))
				{
					$query1="update cart_items set qnty=qnty+1 where user_id=$user_id and bk_id=$bk_id";
					if(mysqli_query($con,$query1))
						echo "Item added to cart.";
					else
						echo "Item could not be added.";
				}
				else
				{
					$query1="insert into cart_items(user_id,bk_id,qnty) values($user_id,$bk_id,1)";
					if(mysqli_query($con,$query1))
						echo "Item added to cart.";
					else
						echo "Item could not be added.";
				}
			}
	}
}
}
?>