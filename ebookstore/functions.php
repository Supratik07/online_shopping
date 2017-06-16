<?php
function connection()
{
	$con=mysqli_connect("localhost","root","","online_book_store");
	if($con)
		return $con;
	else
		return false;
}

function author_list()
{
	$con=connection();
	if($con)
	{
		$info=array();
		$query="select author from books group by author order by author ";
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				while($row=mysqli_fetch_array($result))
				{		array_push($info,$row[0]);		}
				return $info;
			}
			else	{
				$msg="Oops! No record found.";
				return $msg;
			}
		}
		else
		{			
				$msg="Oops! Query error.";
				return $msg;
		}
	}
	else
	{
		$msg="Oops! Database connection failed.";
		return $msg;
	}
	
}



function book_info($authors)
{
	
	$con=connection();
			
	if($con)
	{
		$author=mysqli_real_escape_string($con,trim($authors));
		$info=array();
		$query="select bk_id,bk_name,bk_img,price from books where author like '%$author%'";
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
				{
					array_push($info,$row);
				}
				return $info;
			}
			else
			{
				$msg="Oops! No record found.";
				return $msg;
			}
		}
		else
		{
			
				$msg="Oops! Query error.";
				return $msg;
		}
	}
	else
	{		
		$msg="Oops! Database connection failed.";
		return $msg;
	}
	
	
}



function book_details($id)
{
	$con=connection();
	if($con)
	{
	
	$bk_id=mysqli_real_escape_string($con,trim($id));
	
	$query="select * from books where bk_id=$bk_id";
	if($result=mysqli_query($con,$query))
	{
		if(mysqli_affected_rows($con))
		{
			$details=mysqli_fetch_array($result,MYSQLI_ASSOC);
			return $details;
		}
		else
		{
			$msg="Oops! No record found.";
				return $msg;
		}
	}
	else
	{
		$msg="Oops! Query error.";
				return $msg;
	}
	
	}
	else
	{
		$msg="Oops! Database connection failed.";
		return $msg;
	}
	
}


function same_category($id)
{
	$con=connection();
	if($con)
	{
	
	$bk_id=mysqli_real_escape_string($con,trim($id));
	
	$query="select category from books where bk_id=$bk_id";
	if($result=mysqli_query($con,$query))
	{
		if(mysqli_affected_rows($con))
		{
			$category=mysqli_fetch_array($result,MYSQLI_NUM);
			
			$query1="select * from books where category like '%$category[0]%' and bk_id<>$bk_id";
			
			if($result1=mysqli_query($con,$query1))
			{
				if(mysqli_affected_rows($con))
				{
					$records=array();
					while($details=mysqli_fetch_array($result1,MYSQLI_ASSOC))
					{
						array_push($records,$details);
					}
					return $records;
				}
				else
				{
					$msg="Oops! No record found.";
					return $msg;
				}
			}
			else
			{
				$msg="Oops! Query error.";
				return $msg;
			}
			
			
		}
		else
		{
			$msg="Oops! No record found.";
				return $msg;
		}
	}
	else
	{
		$msg="Oops! Query error.";
				return $msg;
	}
	
	}
	else
	{
		$msg="Oops! Database connection failed.";
		return $msg;
	}
	
}





function book_category($category)
{
	
	$con=connection();
			
	if($con)
	{
		$cat=mysqli_real_escape_string($con,trim($category));
		$info=array();
		$query="select bk_id,bk_name,bk_img,price from books where category like '%$cat%'";
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
				{
					array_push($info,$row);
				}
				return $info;
			}
			else
			{
				$msg="Oops! No record found.";
				return $msg;
			}
		}
		else
		{
			
				$msg="Oops! Query error.";
				return $msg;
		}
	}
	else
	{		
		$msg="Oops! Database connection failed.";
		return $msg;
	}
	
	
}

function publishers()
{
	$con=connection();
	if($con)
	{
		$info=array();
		$query="select publisher from books group by author order by author ";
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				while($row=mysqli_fetch_array($result))
				{		array_push($info,$row[0]);		}
				return $info;
			}
			else	{
				$msg="Oops! No record found.";
				return $msg;
			}
		}
		else
		{			
				$msg="Oops! Query error.";
				return $msg;
		}
	}
	else
	{
		$msg="Oops! Database connection failed.";
		return $msg;
	}
	
}


function book_publisher($publisher)
{
	
	$con=connection();
			
	if($con)
	{
		$pub=mysqli_real_escape_string($con,trim($publisher));
		$info=array();
		$query="select bk_id,bk_name,bk_img,price from books where publisher like '%$pub%'";
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
				{
					array_push($info,$row);
				}
				return $info;
			}
			else
			{
				$msg="Oops! No record found.";
				return $msg;
			}
		}
		else
		{
			
				$msg="Oops! Query error.";
				return $msg;
		}
	}
	else
	{		
		$msg="Oops! Database connection failed.";
		return $msg;
	}
	
	
}

function book_search($search_by,$search_item)
{
	$con=connection();
	if($con)
	{
		$s_by=mysqli_real_escape_string($con,trim($search_by));
		$s_item=mysqli_real_escape_string($con,trim($search_item));
		$info=array();
		if($s_by=='Book')
		$query="select bk_id,bk_name,bk_img,price from books where bk_name like '%$s_item%' or isbn_13 like '%$s_item%' or isbn_10 like '%$s_item%'";
		
		if($s_by=='Author')
		$query="select bk_id,bk_name,bk_img,price from books where author like '%$s_item%'";
		
		if($s_by=='Subject')
		$query="select bk_id,bk_name,bk_img,price from books where subject like '%$s_item%'";
		
			
		
		
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
				{
					array_push($info,$row);
				}
				return $info;
			}
			else
			{
				$msg="Oops! No record found.";
				return $msg;
			}
		}
		else
		{
			
				$msg="Oops! Query error.";
				return $msg;
		}
	}
	else
	{
		$msg="Oops! Database connection failed.";
		return $msg;
	}
}



function signup($data)
{
	$con=connection();
	if($con)
	{
		$name=mysqli_real_escape_string($con,trim($data['name']));
		$address=mysqli_real_escape_string($con,trim($data['address']));
		$email=mysqli_real_escape_string($con,trim($data['email']));
		$mob=mysqli_real_escape_string($con,trim($data['mob']));
		$pass=mysqli_real_escape_string($con,trim($data['pass']));
		$password=md5($pass);
		
		$query1="select * from user where email='$email'";
					if(mysqli_query($con,$query1))
					{
						if(mysqli_affected_rows($con))
						{
							$msg="<h4 style='color:red'>Email id has been already registered.</h4>";
							return $msg;
							
						}
						else
						{
						$query="insert into user(name,address,email,phone,password) values('$name','$address','$email',$mob,'$password') ";
						if(mysqli_query($con,$query))
						{
							$msg="<h4 style='color:green'>Your account have been created successfully.</h4>";
							return $msg;
						}
						else 
						{
							$msg="<h4 style='color:red'>Oops! Query could not process.</h4>";
							return $msg;
						}
						}
					}
				else
				{
					$msg="<h4 style='color:red'>Oops! Query could not process for email varification.</h4>";
					return $msg;
				}
	}
	else
	{
		$msg="<h4 style='color:red'>Oops! Database Connection failed.</h4>";
		return $msg;
	}
}

function login($data)
{
	if($con=connection())
	{
		$email=mysqli_real_escape_string($con,trim($data['login_email']));
		$pass=mysqli_real_escape_string($con,trim($data['password']));
		$password=md5($pass);
		
		$query="select * from user where email='$email'";
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				$query1="select * from user where email='$email' and password='$password' limit 1";
				if($result1=mysqli_query($con,$query1))
				{
					if(mysqli_affected_rows($con))
					{
						
						$row=mysqli_fetch_array($result1,MYSQLI_ASSOC);
						
						return $row;
					}
					else
					{
						$msg="Password does not matched.";
						return $msg;
					}
				}
				else
				{
					$msg="Oops! Query could not process.";
					return $msg;
				}
			}
			else
			{
				$msg="Email is not registered.";
				return $msg;
			}
		}
		else
		{		
			$msg="Oops! Query could not process.";
			return $msg;
		}
		
	}
	else
	{
		$msg="<h4 style='color:red'>Oops! Database Connection failed.</h4>";
		return $msg;
	}
}


function fetch_profile($id)
{
	$user_id=$id;
	$con=connection();
	if($con)
	{
			$query="select * from user where user_id=$user_id";
			if($result=mysqli_query($con,$query))
			{
				$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
				return $row;
			}
	}
	
}

function fetch_cart_items($id)
{
	$user_id=$id;
	$item=array();
	if($con=connection())
	{
			$query="select books.bk_id,books.bk_name,books.price,cart_items.qnty
			from books
			inner join cart_items
			on books.bk_id=cart_items.bk_id
			where cart_items.user_id=$id";
	
			if($result=mysqli_query($con,$query))
			{
				if(mysqli_affected_rows($con))
				{
					
					while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
					{
						array_push($item,$row);
					}
					return $item;
				}
				else
				{
					$item[]="<h4 style='color:red'>Your cart is empty.</h4>";
					return $item;
				}
			}
			else
			{
				$msg="<h4 style='color:red'>Oops! Query could not process.</h4>";
				return $msg;
			}
	}
	else
	{
		$msg="<h4 style='color:red'>Oops! Database Connection failed.</h4>";
		return $msg;
	}
}

function order_details($id)
{
	$user_id=$id;
	if($con=connection())
	{
		$query="select orders.order_id,orders.order_of_date,orders.order_time,orders.address,orders.payment,
		orders.status,orders.remarks,sub_order.sub_order_id,sub_order.bk_id,sub_order.bk_name,sub_order.qnty,sub_order.price
		from orders
		inner join sub_order
		on orders.order_id=sub_order.order_id
		where orders.user_id=$user_id";
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





function seller_signup($data)
{
	$con=connection();
	if($con)
	{
		$v_name=mysqli_real_escape_string($con,trim($data['name']));
		$v_address=mysqli_real_escape_string($con,trim($data['address']));
		$v_email=mysqli_real_escape_string($con,trim($data['email']));
		$v_phone=mysqli_real_escape_string($con,trim($data['mob']));
		$v_pass=mysqli_real_escape_string($con,trim($data['pass']));
		$password=md5($v_pass);
		
		$query1="select * from book_vendors where v_email='$v_email'";
					if(mysqli_query($con,$query1))
					{
						if(mysqli_affected_rows($con))
						{
							$msg="<h4 style='color:red'>Email id has been already registered.</h4>";
							return $msg;
							
						}
						else
						{
						$query="insert into book_vendors(v_name,v_address,v_email,v_phone,v_pass,v_status) values('$v_name','$v_address','$v_email',$v_phone,'$password','Pending') ";
						if(mysqli_query($con,$query))
						{
							$msg="<h4 style='color:green'>Your account have been created successfully. But need approval from admin.</h4>";
							return $msg;
						}
						else 
						{
							$msg="<h4 style='color:red'>Oops! Query could not process.</h4>";
							return $msg;
						}
						}
					}
				else
				{
					$msg="<h4 style='color:red'>Oops! Query could not process for email varification.</h4>";
					return $msg;
				}
	}
	else
	{
		$msg="<h4 style='color:red'>Oops! Database Connection failed.</h4>";
		return $msg;
	}
}


function seller_login($data)
{
	if($con=connection())
	{
		$email=mysqli_real_escape_string($con,trim($data['login_email']));
		$pass=mysqli_real_escape_string($con,trim($data['password']));
		$password=md5($pass);
		
		$query="select * from book_vendors where v_email='$email'";
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				$query1="select * from book_vendors where v_email='$email' and v_pass='$password' limit 1";
				if($result1=mysqli_query($con,$query1))
				{
					if(mysqli_affected_rows($con))
					{
						
						$row=mysqli_fetch_array($result1,MYSQLI_ASSOC);
						if($row['v_status']=="Pending")
						{
							$msg="You need approval from admin. Please contact with admin.";
							return $msg;
						}
						else
						return $row;
					}
					else
					{
						$msg="Password does not matched.";
						return $msg;
					}
				}
				else
				{
					$msg="Oops! Query could not process.";
					return $msg;
				}
			}
			else
			{
				$msg="Email is not registered.";
				return $msg;
			}
		}
		else
		{		
			$msg="Oops! Query could not process.";
			return $msg;
		}
		
	}
	else
	{
		$msg="<h4 style='color:red'>Oops! Database Connection failed.</h4>";
		return $msg;
	}
}


function admin_login($data)
{
	if($con=connection())
	{
		$email=mysqli_real_escape_string($con,trim($data['login_email']));
		$pass=mysqli_real_escape_string($con,trim($data['password']));
		$password=md5($pass);
		
		$query="select * from admin where username='$email'";
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				$query1="select * from admin where username='$email' and password='$password' limit 1";
				if($result1=mysqli_query($con,$query1))
				{
					if(mysqli_affected_rows($con))
					{
						$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
						return $row;
					}
					else
					{
						$msg="Password does not matched.";
						return $msg;
					}
				}
				else
				{
					$msg="Oops! Query could not process.";
					return $msg;
				}
			}
			else
			{
				$msg="Username is not correct.";
				return $msg;
			}
		}
		else
		{		
			$msg="Oops! Query could not process.";
			return $msg;
		}
		
	}
	else
	{
		$msg="<h4 style='color:red'>Oops! Database Connection failed.</h4>";
		return $msg;
	}
}

?>