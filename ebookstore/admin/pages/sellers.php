<?php
$seller_info=sellers();
if(is_array($seller_info))
{
	echo "<center><h3 style='color:green; margin-top:30px;'>Registered Book Vendors</h3></center>";
	echo "<br /><table class='table'>
	<tr>
		<td>Seller Name</td>
		<td>Address</td>
		<td>Email</td>
		<td>Phone</td>
		<td>Status</td>
		<td></td>
		<td></td>
	</tr>";
	for($i=0;$i<count($seller_info);$i++)
	{
		$seller_id=$seller_info[$i]['vendor_id'];
		
		if($seller_info[$i]['v_status']=='Pending')
			$approve="<button class='btn btn-success approve' value='$seller_id'>Approve</button>";
		else
			$approve="";
		echo "<tr>
		<td>".$seller_info[$i]['v_name']."</td>
		<td>".$seller_info[$i]['v_address']."</td>
		<td>".$seller_info[$i]['v_email']."</td>
		<td>".$seller_info[$i]['v_phone']."</td>
		<td>".$seller_info[$i]['v_status']."</td>
		<td>$approve</td>
		<td></td>
	</tr>";
	}
	echo "</table>";
}
else
{
	echo "<center><h3 style='color:red; margin-top:30px;'>$seller_info</h3></center>";
}
?>