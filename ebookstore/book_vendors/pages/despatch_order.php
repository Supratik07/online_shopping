<?php
	if(isset($_POST['id']))
	{
	$order_id=$_POST['id'];
	
	$con=mysqli_connect("localhost","root","","online_book_store");
	if($con)
	{
		$query="update orders set status='Despatched', remarks='Books have been despatched.' where order_id=$order_id";
		if(mysqli_query($con,$query))
			echo "Books have been despatched to the address.";
		else
			echo "Books are at store.";
	}
	else
		echo "Database connection failed.";

	}



?>