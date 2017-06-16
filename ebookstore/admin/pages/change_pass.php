<?php if(isset($_POST['change_password']))
{
	$con=mysqli_connect("localhost","root","","online_book_store");
	if($con)
	{
		$username=mysqli_real_escape_string($con,trim($_POST['username']));
		$old_password=mysqli_real_escape_string($con,trim($_POST['old_password']));
		$old=md5($old_password);
		$new_password=mysqli_real_escape_string($con,trim($_POST['new_password']));
		$password=md5($new_password);
		$query1="select * from admin where username='$username' and password='$old'";
		if($result=mysqli_query($con,$query1))
		{
			if(mysqli_affected_rows($con))
			{
				$query="update admin set password='$password' where username='$username'";
				if(mysqli_query($con,$query))
				{
					if(mysqli_affected_rows($con))
						echo "Password successfully updated.";
					else
						echo mysqli_error($con);
				}
				else
					echo "Oops! query error.";
			}
			else 
				echo "Account password did not match.";
		}
		else
			echo "Oops! query error.";
		
	}
	else
		echo "Database connection failed.";
}

	?>