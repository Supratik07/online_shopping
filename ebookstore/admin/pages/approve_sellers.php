<?php
if(isset($_POST['id']))
{
	$seller_id=$_POST['id'];
$con=mysqli_connect("localhost","root","","online_book_store");
	if($con)
	{
		$query="update book_vendors set v_status='Approved' where vendor_id=$seller_id";
		if(mysqli_query($con,$query))
		{
			echo "Book vendor has got approval.";
			
		}
		else
		{
			echo "Book vendor did not get approval.";
		}
	}
	else
		echo "Database connection error.";
}


?>