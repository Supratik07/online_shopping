<?php
	if(isset($_POST['id']))
	{
	$order_id=$_POST['id'];
	
	$con=mysqli_connect("localhost","root","","online_book_store");
	if($con)
	{
		mysqli_query($con,"SET AUTOCOMMIT=0");
		mysqli_query($con,"START TRANSACTION");
						
		$query="select orders.status,sub_order.bk_id,sub_order.qnty
		from orders
		inner join sub_order
		on orders.order_id=sub_order.order_id
		where orders.order_id='$order_id'";
		
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				$errors=0;
				while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
				{
					$bk_id=$row['bk_id'];
					$qnty=$row['qnty'];
					$query1="update books set qnty=qnty+$qnty where bk_id=$bk_id";
					if(!mysqli_query($con,$query1))
					{
						$errors++;
					}
				}
				if($errors==0)
				{
					$query2="update orders set status='Cancelled', remarks='Cancelled by Admin.' where order_id=$order_id";
					if(mysqli_query($con,$query2))
					{
						mysqli_query($con,"COMMIT");
						echo "Order Cancelled !!!";
					}
					else
					{
						echo mysqli_error($con);
						mysqli_query($con,"ROLLBACK");
					}
				}
			}
		}
		
	}
	else
		echo "Database connection failed.";

	}



?>