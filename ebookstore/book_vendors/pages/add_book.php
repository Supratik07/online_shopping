<br /><br />
<center>

<?php 
if(isset($_POST['add_book']))
{
	require_once("functions.php");
	$msg=add_book();
	if($msg===true)
	{
		echo "<h3 style='padding-top:20px'>Book details successfully stored in database. </h3>";
	}
	else
	{
		for($i=0;$i<count($msg);$i++)
		{
		echo "<h3 style='padding-top:20px'>$msg[$i]</h3>";
		}
	}
	echo "<a href='index.php?pid=1' class='btn btn-lg btn-primary'>Back</a>";
}
else
{
?>




<h3><u>Add new book</u></h3><br />

<form action="<?php echo $_SERVER['PHP_SELF']."?pid=1" ?>" method="post" enctype="multipart/form-data" id="add_book">
<table>
<tr>
	<td>Book Name</td>
	<td><input type="text" name="bk_name" required /></td>
</tr>
<tr>
	<td>Author</td>
	<td><input type="text" name="author" required /></td>
</tr>
<tr>
	<td>Publisher</td>
	<td><input type="text" name="publisher" required /></td>
</tr>
<tr>
	<td>Publication Year</td>
	<td><input type="text" name="pub_yr" required /></td>
</tr>
<tr>
	<td>ISBN-13</td>
	<td><input type="text" name="isbn_13" value="---" required /></td>
</tr>
<tr>
	<td>ISBN-10</td>
	<td><input type="text" name="isbn_10" value="---" required /></td>
</tr>
<tr>
	<td>Binding</td>
	<td><input type="text" name="binding" placeholder="Paperback" required /></td>
</tr>
<tr>
	<td>No. of Pages</td>
	<td><input type="number" name="no_pages" required /></td>
</tr>
<tr>
	<td>Language</td>
	<td><input type="text" name="lang" required /></td>
</tr>
<tr>
	<td>Subject</td>
	<td><input type="text" name="subject" required /></td>
</tr>
<tr>
	<td>Category</td>
	<td>
	<select name="category" id="" style="padding:3px;">
	<option value="Arts & Photography">Arts & Photography</option>
	<option value="Biography">Biography</option>
	<option value="Business & Investing">Business & Investing</option>
	<option value="Business & Investing">Children Books</option>
	<option value="College Text & Reference">College Text & Reference</option>
	<option value="Computer & Internet">Computer & Internet</option>	
	<option value="Cooking & Food">Cooking & Food</option>
	<option value="Eductional and Professional">Eductional and Professional</option>
	<option value="Entertainment">Entertainment</option>
	<option value="Competitive Exams">Competitive Exams</option>
	</select>
	
	</td>
</tr>
<tr>
	<td>Info :</td>
	<td><textarea name="info" cols="25" rows="3" style="resize:none;" required ></textarea></td>
</tr>
<tr>
	<td>Cover Image :</td>
	<td><input type="file" name="bk_img" class="btn btn-default" required /></td>
</tr>
<tr>
	<td>Price(INR) </td>
	<td><input type="number" name="price" required /></td>
</tr>
<tr>
	<td>Quantity :</td>
	<td><input type="number" name="qnty" required /></td>
</tr>
<tr>
	<td><input type="submit" value="Add Book" name="add_book" class="btn" /></td>
	<td><input type="reset" value="Reset" class="btn" /></td>
</tr>


</table>
</form>


<?php
}
?>

</center>