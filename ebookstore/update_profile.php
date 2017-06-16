<?php

$con=mysqli_connect("localhost","root","","online_book_store");
	if($con)
	{
		
		$userid=mysqli_real_escape_string($con,trim($_POST['user_id']));
		$name=mysqli_real_escape_string($con,trim($_POST['name']));
		$address=mysqli_real_escape_string($con,trim($_POST['address']));
		$email=mysqli_real_escape_string($con,trim($_POST['email']));
		$old_email=mysqli_real_escape_string($con,trim($_POST['old_email']));
		$phone=mysqli_real_escape_string($con,trim($_POST['mob']));
		$pass=mysqli_real_escape_string($con,trim($_POST['pass']));
		$password=md5($pass);
		$new_pass=mysqli_real_escape_string($con,trim($_POST['new_pass']));
		$new_password=md5($new_pass);
		
		if(strcasecmp($email,$old_email)==0)
			goto cont;
		
		$query1="select * from user where email='$email'";
					if(mysqli_query($con,$query1))
					{
						if(mysqli_affected_rows($con))
						{
							echo "Email can not be changed as it is already registered.";
						}
						else
						{
							cont:
						$query="select * from user where user_id=$userid and password='$password'";
						if(mysqli_query($con,$query))
						{
							if(mysqli_affected_rows($con))
							{
								if($new_pass=='')
								$query2="update user set name='$name',address='$address',phone=$phone,email='$email' where user_id=$userid";
								else
								$query2="update user set name='$name',address='$address',phone=$phone,email='$email',password='$new_password' where user_id=$userid";
							
								if(mysqli_query($con,$query2))
								{
									echo "Profile details successfully updated.";
									
								}
								else
								{
									echo "Oops! profile not updated.";
									
								}
							}
							else
							{
							echo "Your account password did not match.";
							}
						}
						else 
						{
							echo "Oops! Query could not process.";
							
						}
						}
					}
				else
				{
					echo "Oops! Query could not process for email varification.";
					
				}
	}
	else
	{
		echo "Database connection failed.";
	}

?>