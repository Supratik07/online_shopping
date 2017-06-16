
<form action="pages/change_pass.php" method="post" id="update_password">
<table>
	<tr>
		<td>Username</td>
		<td><input type="text" name="" value="<?php echo $_SESSION['admin_id']; ?>" disabled/>
		<input type="hidden" name="username" value="<?php echo $_SESSION['admin_id']; ?>" />
		</td>
	</tr>
	<tr>
		<td>Old Password</td>
		<td><input type="password" name="old_password" id="" /></td>
	</tr>
	<tr>
		<td>New Password</td>
		<td><input type="password" name="new_password" id="new_pass" /></td>
	</tr>
	<tr>
		<td>Confirm Password</td>
		<td><input type="password" name="confirm_password" id="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td><input type="reset" class="btn btn-primary" value="Reset" /></td>
		<td><input type="submit" class="btn btn-primary" name="change_password" value="Update password" /></td>
	</tr>
</table>



</form>

<br /><br />
<span id="msg" style="color:green; font-size:15px; "></span>
