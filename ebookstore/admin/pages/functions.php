<?php

function connection()
{
	$con=mysqli_connect("localhost","root","","online_book_store");
	if($con)
		return $con;
	else
		return false;
}

function sellers()
{
	if($con=connection())
	{
		$query="select * from book_vendors";
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				$sellers=array();
				while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
				{
					array_push($sellers,$row);
					
				}
				return $sellers;
				
			}
			else
			{
				$msg="No seller registration found.";
				return $msg;
			}
		}
	}
}

function fetch_books()
{
	if($con=connection())
	{
		$query="select * from books";
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				$books=array();
				while($row=mysqli_fetch_array($result,MYSQLI_NUM))
				{
					array_push($books,$row);
					
				}
				return $books;
				
			}
			else
			{
				$msg="No boos found.";
				return $msg;
			}
		}
	}
}
function order_details()
{
	
	if($con=connection())
	{
		$query="select orders.order_id,orders.order_of_date,orders.order_time,orders.address,orders.payment,
		orders.status,orders.remarks,sub_order.sub_order_id,sub_order.bk_id,sub_order.bk_name,sub_order.qnty,sub_order.price
		from orders
		inner join sub_order
		on orders.order_id=sub_order.order_id";
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				$info=array();
					while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
					{
						array_push($info,$row);
					}
					return $info;
			}
			else
			{
				$info="No details found";
				return $info;
			}
			
		}
		else
		{
			$error=mysqli_error($con);
			return $error;
		}
	}
}

?>