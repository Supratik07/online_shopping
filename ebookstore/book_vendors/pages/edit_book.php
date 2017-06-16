



<?php
require_once("functions.php");






if(isset($_GET['pid']) && !isset($_GET['bk_id']))
{
echo "<br /><br />";

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
	<td>Edit</td>
</tr>';

$result=fetch_book();
if(is_array($result))
{
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
				else
				echo "<td>".$result[$i][$j]."</td>";
			}
			echo "<td><a href=\"index.php?pid=2&bk_id=".$result[$i][0]."\">Edit</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else
	{
		echo "<h3 style='color:red; text-align:center;'>No book details found. <br /><br />
	<a href='index.php' class='btn btn-lg btn-default'>Back</a>
	.</h3>";
		
	}
}
else
{
	echo "<h3 style='color:red; text-align:center;'>$result <br /><br />
	<a href='index.php' class='btn btn-lg btn-default'>Back</a>
	.</h3>";
	
}

}
else if(isset($_GET['pid']) && isset($_GET['bk_id']) && !isset($_POST['update_book']))
{
	if($_GET['bk_id']=='' || !is_numeric($_GET['bk_id']))
		header("Location:index.php");
	
	$id=$_GET['bk_id'];
	
	$info=fetch_single_book($id);
	if(!is_array($info))
		header("Location:index.php");	
		
	$options=array(
	"Arts & Photography",
	"Biography",
	"Business & Investing",
	"Children Books",
	"College Text & Reference",
	"Computer & Internet",
	"Cooking & Food",
	"Eductional and Professional",
	"Entertainment",
	"Competitive Exams"
	);
?>
<center>
<h3><u>Edit book details </u></h3><br />

<form action="<?php echo $_SERVER['PHP_SELF']."?pid=2&bk_id=$id" ?>" method="post" enctype="multipart/form-data" id="add_book">
<table>
<tr>
	<td>Book Name</td>
	<td><input type="text" name="bk_name" value="<?php echo $info[1]; ?>" required /></td>
</tr>
<tr>
	<td>Author</td>
	<td><input type="text" name="author" value="<?php echo $info[2]; ?>" required /></td>
</tr>
<tr>
	<td>Publisher</td>
	<td><input type="text" name="publisher" value="<?php echo $info[3]; ?>" required /></td>
</tr>
<tr>
	<td>Publication Year</td>
	<td><input type="text" name="pub_yr" value="<?php echo $info[4]; ?>" required /></td>
</tr>
<tr>
	<td>ISBN-13</td>
	<td><input type="text" name="isbn_13" value="<?php echo $info[5]; ?>" required /></td>
</tr>
<tr>
	<td>ISBN-10</td>
	<td><input type="text" name="isbn_10" value="<?php echo $info[6]; ?>" required /></td>
</tr>
<tr>
	<td>Binding</td>
	<td><input type="text" name="binding" placeholder="Paperback"  value="<?php echo $info[7]; ?>" required /></td>
</tr>
<tr>
	<td>No. of Pages</td>
	<td><input type="number" name="no_pages" value="<?php echo $info[8]; ?>" required /></td>
</tr>
<tr>
	<td>Language</td>
	<td><input type="text" name="lang" value="<?php echo $info[9]; ?>" required /></td>
</tr>
<tr>
	<td>Subject</td>
	<td><input type="text" name="subject" value="<?php echo $info[10]; ?>" required /></td>
</tr>
<tr>
	<td>Category</td>
	<td>
	<select name="category" id="" style="padding:3px;">
	<?php 
	foreach($options as $cat)
	{
		if($cat==$info[11])
			echo "<option value=\"$cat\" style=\"color:#155895; background-color:#F6FFAA; font-weight:bold; \" selected>$cat</option>";
		else 
			echo "<option value=\"$cat\" >$cat</option>";
	}
	?>
	</select>
	
	</td>
</tr>
<tr>
	<td>Info :</td>
	<td><textarea name="info" cols="25" rows="3" style="resize:none;" required ><?php echo $info[12]; ?></textarea></td>
</tr>
<tr>
	<td>Cover Image :</td>
	<td><img src="../cover_pics/<?php echo $info[13]; ?>" alt="Book Cover" height="100" width="100" />
	<input type="hidden" name="bk_pre_img" value="<?php echo $info[13]; ?>" />
	
	<input type="file" name="bk_img" class="btn btn-default" /></td>
</tr>
<tr>
	<td>Price(INR) </td>
	<td><input type="number" name="price" value="<?php echo $info[14]; ?>"  required /></td>
</tr>
<tr>
	<td>Quantity :</td>
	<td><input type="number" name="qnty" value="<?php echo $info[15]; ?>"  required /></td>
</tr>
<tr>
	<td><input type="submit" value="Update Book" name="update_book" class="btn" /></td>
	<td><input type="reset" value="Reset" class="btn" /></td>
</tr>


</table>
</form>
</center>



<?php
}
else if(isset($_GET['pid']) && isset($_GET['bk_id']) && isset($_POST['update_book']))
{
	if($_GET['bk_id']=='' || !is_numeric($_GET['bk_id']))
		header("Location:index.php");
	
	$msg=update_book($_GET['bk_id']);
	if($msg===true)
	{
		echo "<h3 style='padding-top:20px'>Book details successfully updated in database. </h3>";
	}
	else
	{
		for($i=0;$i<count($msg);$i++)
		{
		echo "<h3 style='padding-top:20px'>$msg[$i]</h3>";
		}
	}
	echo "<a href='index.php?pid=2' class='btn btn-lg btn-primary'>Back</a>";
}
else
{
	header("location:index.php");
}
?>
