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
			$query="select qnty from cart_items where user_id=$user_id and bk_id=$bk_id";
			if($result=mysqli_query($con,$query))
			{
				if(mysqli_affected_rows($con))
				{
					$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
					if($row['qnty']>1)
						$query1="update cart_items set qnty=qnty-1 where user_id=$user_id and bk_id=$bk_id";
					else
						$query1="delete from cart_items where user_id=$user_id and bk_id=$bk_id";
					
					
					if(mysqli_query($con,$query1))
						echo "One item removed from cart.";
					else
						echo "Item could not be remove.";
				}
				
			}
	}
}
}
?>