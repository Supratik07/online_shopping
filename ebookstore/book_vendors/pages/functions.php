
<?php


function connection()
{
	$con=mysqli_connect("localhost","root","","online_book_store");
	if($con)
		return $con;
	else
		return false;
}



function add_book()
{
	$errors=array();
	if($con=connection())
	{
	$vendor_id=$_SESSION['seller_id'];
	
	$bk_name=mysqli_real_escape_string($con,trim($_POST['bk_name']));
	$author=mysqli_real_escape_string($con,trim($_POST['author']));
	$publisher=mysqli_real_escape_string($con,trim($_POST['publisher']));
	$pub_yr=mysqli_real_escape_string($con,trim($_POST['pub_yr']));
	$isbn_13=mysqli_real_escape_string($con,trim($_POST['isbn_13']));
	$isbn_10=mysqli_real_escape_string($con,trim($_POST['isbn_10']));
	$binding=mysqli_real_escape_string($con,trim($_POST['binding']));
	$no_pages=mysqli_real_escape_string($con,trim($_POST['no_pages']));
	$lang=mysqli_real_escape_string($con,trim($_POST['lang']));
	$subject=mysqli_real_escape_string($con,trim($_POST['subject']));
	$category=$_POST['category'];
	$info=mysqli_real_escape_string($con,trim($_POST['info']));
	$price=mysqli_real_escape_string($con,trim($_POST['price']));
	$qnty=mysqli_real_escape_string($con,trim($_POST['qnty']));
	
					$file_name=mysqli_real_escape_string($con,trim($_FILES['bk_img']['name']));
					$file_size=$_FILES['bk_img']['size'];
					$file_tmp=$_FILES['bk_img']['tmp_name'];
					$file_type=$_FILES['bk_img']['type'];
					$ext=explode('.',$file_name);
					$file_ext=strtolower(end($ext));
					$extensions=array('jpeg','jpg','png');
					
					
					if(in_array($file_ext,$extensions)===false)
						$errors[]="Extension not allowed, please choose a jpep or png file.";
					if($file_size>1048576)
						$errors[]="File size must be less than 1MB.";
					
					mysqli_query($con,"SET AUTOCOMMIT=0");
					mysqli_query($con,"START TRANSACTION");
					
					$query1="select * from books where bk_name='$bk_name' and vendor_id=$vendor_id";
					if(mysqli_query($con,$query1))
					{
						if(mysqli_affected_rows($con))
						{
							$errors[]="Your have already added the book to store.";
							return $errors;
							
						}
						else
						{
						$query="insert into books(bk_name,author,publisher,publication_year,isbn_13,isbn_10,binding,no_pages,language,subject,category,info,bk_img,vendor_id,price,qnty) 
						values ('$bk_name','$author','$publisher',$pub_yr,'$isbn_13','$isbn_10','$binding',$no_pages,'$lang','$subject','$category','$info','$file_name',$vendor_id,$price,$qnty) ";
						if(mysqli_query($con,$query))
						{
							if(empty($errors)==true)
							{
								move_uploaded_file($file_tmp,"../cover_pics/".$file_name);
								mysqli_query($con,"COMMIT");
								return true;
							}
							else
							{
								 mysqli_query($con,"ROLLBACK");
								
								 return $errors;
							}
							
						}
						else 
						{
							 $errors[]="Book details insertion failed due to query error.";
							 return $errors;
						}
							
						}
					}
				else 
					return $errors;
	
	
	}
	else
	{
		 $errors[]="Database connection failed.";
		return $errors;
	}
}

function fetch_book()
{
	$vendor_id=$_SESSION['seller_id'];
	if($con=connection())
	{
		$query="select bk_id,bk_name,author,publisher,publication_year,isbn_13,isbn_10,binding,no_pages,language,subject,category,info,bk_img,price,qnty from books where vendor_id=$vendor_id";
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				$msg=array();
				while($row=mysqli_fetch_row($result))
				{
					array_push($msg,$row);
				}
				return $msg;
			}
			else
			{
				$msg1="No books found which you have inserted.";
				return $msg1;
			}
		}
		else
		{
			$msg1="Query error.";
			return $msg;
		}
	}
}


function fetch_single_book($id)
{
	$vendor_id=$_SESSION['seller_id'];
	$bk_id=trim($id);
	if($con=connection())
	{
		$query="select bk_id,bk_name,author,publisher,publication_year,isbn_13,isbn_10,binding,no_pages,language,subject,category,info,bk_img,price,qnty from books where bk_id=$bk_id and vendor_id=$vendor_id";
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				
				$row=mysqli_fetch_array($result);
				
				return $row;
			}
			else
			{
				$msg1="No books found which you have inserted.";
				return $msg1;
			}
		}
		else
		{
			$msg1="Query error.";
			return $msg1;
		}
	}
}




function update_book($bk_id)
{
	$id=trim($bk_id);
	$errors=array();
	if($con=connection())
	{
		
	$vendor_id=$_SESSION['seller_id'];
	
	$bk_name=mysqli_real_escape_string($con,trim($_POST['bk_name']));
	$author=mysqli_real_escape_string($con,trim($_POST['author']));
	$publisher=mysqli_real_escape_string($con,trim($_POST['publisher']));
	$pub_yr=mysqli_real_escape_string($con,trim($_POST['pub_yr']));
	$isbn_13=mysqli_real_escape_string($con,trim($_POST['isbn_13']));
	$isbn_10=mysqli_real_escape_string($con,trim($_POST['isbn_10']));
	$binding=mysqli_real_escape_string($con,trim($_POST['binding']));
	$no_pages=mysqli_real_escape_string($con,trim($_POST['no_pages']));
	$lang=mysqli_real_escape_string($con,trim($_POST['lang']));
	$subject=mysqli_real_escape_string($con,trim($_POST['subject']));
	$category=$_POST['category'];
	$info=mysqli_real_escape_string($con,trim($_POST['info']));
	$price=mysqli_real_escape_string($con,trim($_POST['price']));
	$qnty=mysqli_real_escape_string($con,trim($_POST['qnty']));
	
	$bk_pre_img=mysqli_real_escape_string($con,trim($_POST['bk_pre_img']));	
	
	if(trim($_FILES['bk_img']['name'])!="")
	{
					$file_name=mysqli_real_escape_string($con,trim($_FILES['bk_img']['name']));
					$file_size=$_FILES['bk_img']['size'];
					$file_tmp=$_FILES['bk_img']['tmp_name'];
					$file_type=$_FILES['bk_img']['type'];
					$ext=explode('.',$file_name);
					$file_ext=strtolower(end($ext));
					$extensions=array('jpeg','jpg','png');
					
					
					if(in_array($file_ext,$extensions)===false)
						$errors[]="Extension not allowed, please choose a jpep or png file.";
					if($file_size>1048576)
						$errors[]="File size must be less than 1MB.";
					
					$query="update books set 
					bk_name='$bk_name',author='$author',publisher='$publisher',publication_year=$pub_yr,
					isbn_13='$isbn_13',isbn_10='$isbn_10',binding='$binding',no_pages=$no_pages,language='$lang',
					subject='$subject',category='$category',info='$info',bk_img='$file_name',price=$price,qnty=$qnty where bk_id=$id";
	}
	else
		$query="update books set 
					bk_name='$bk_name',author='$author',publisher='$publisher',publication_year=$pub_yr,
					isbn_13='$isbn_13',isbn_10='$isbn_10',binding='$binding',no_pages=$no_pages,language='$lang',
					subject='$subject',category='$category',info='$info',price=$price,qnty=$qnty where bk_id=$id";
					
				
	
	
					mysqli_query($con,"SET AUTOCOMMIT=0");
					mysqli_query($con,"START TRANSACTION");
					
					
						if(mysqli_query($con,$query))
						{
							if(empty($errors)==true)
							{
								if(isset($file_name))
								{
								unlink("../cover_pics/".$bk_pre_img);
								move_uploaded_file($file_tmp,"../cover_pics/".$file_name);
								}
							
								mysqli_query($con,"COMMIT");
								return true;
							}
							else
							{
								 mysqli_query($con,"ROLLBACK");
								 $errors[]="Book details updation failed due to query error.";
								 return $errors;
							}
							
						}
						else 
							return $errors;
						
					
	
	
	}
	else
	{
		 $errors[]="Database connection failed.";
		return $errors;
	}
}

function seller_info()
{
	$con=connection();
	if($con)
	{
		$vendor_id=$_SESSION['seller_id'];
		$query="select * from book_vendors where vendor_id=$vendor_id";
		if($result=mysqli_query($con,$query))
		{
			if(mysqli_affected_rows($con))
			{
				$info=mysqli_fetch_array($result,MYSQLI_ASSOC);
				return $info;
			}
			
		}
	}
}

function order_details($id)
{
	$user_id=$id;
	if($con=connection())
	{
		$query="select orders.order_id,orders.order_of_date,orders.order_time,orders.address,orders.payment,
		orders.status,orders.remarks,sub_order.sub_order_id,sub_order.bk_id,sub_order.bk_name,sub_order.qnty,sub_order.price,books.bk_id
		from orders
		inner join sub_order on orders.order_id=sub_order.order_id
		inner join books on books.bk_id=sub_order.bk_id
		where books.vendor_id=$user_id";
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