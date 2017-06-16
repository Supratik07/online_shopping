<?php
session_start();


if(isset($_SESSION['id']))
{
	$_SESSION=array();
	if(isset($_COOKIE[session_name()]))
	{
	setcookie(session_name(),'',time()-52000,'/');
	}
}
session_destroy();

header("Location:index.php");	

?>