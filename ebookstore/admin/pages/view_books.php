<?php

$result=fetch_books();
if(is_array($result))
{
	$table1='<table class="" id="edit_book">
<tr style="font-weight:bold;">
	<td>Sl no.</td>
	<td>Book Name</td>
	<td>Author</td>
	<td>Publisher</td>
	<td>Publication Year </td>
	<td>ISBN-13</td>
	<td>ISBN-10</td>
	<td>Binding</td>
	<td>No. of Pages</td>
	<td>Language</td>
	<td>Subject</td>
	<td>Category</td>
	<td>Book Info</td>
	<td>Cover Photo</td>
	<td>Price</td>
	<td>Qnty</td>
	
	
</tr>';
		if(count($result))
	{
		echo "<h3 style='text-align:center; color:#42EAF0;'><u>Books your have added into store</u></h3><br />";
		echo $table1;
		for($i=0;$i<count($result);$i++)
		{
			$n=$i+1;
			echo "<tr>";
			echo "<td>".$n."</td>";
			for($j=1;$j<count($result[$i]);$j++)
			{
				if($result[$i][$j]==$result[$i][13])
					echo "<td><img src=\"../cover_pics/".$result[$i][$j]." \" alt=\"Book Cover\" height=\"100\" width=\"100\" /></td>";
				else if($result[$i][$j]==$result[$i][12])
				echo "<td>".substr($result[$i][$j],0,50)."...</td>";
				else if($result[$i][$j]==$result[$i][14])
				continue;	
				else
				echo "<td>".$result[$i][$j]."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
}
else
{
	echo "<center><h3 style='color:red; margin-top:30px;'>$result</h3></center>";
}


?>