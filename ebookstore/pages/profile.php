<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="profile" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="profile">Update Profile</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<form action="update_profile.php" method="post" id="update_profile">
			<input type="hidden" name="user_id"  value="<?php echo $profile_details['user_id']; ?>" />
					<table>
					<tr>
						<td>Your Name</td>
						<td><input type="text" name="name" class="form-control" value="<?php echo $profile_details['name']; ?>" /></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><textarea name="address" class="form-control" style="resize:none;"> <?php echo $profile_details['address']; ?> </textarea></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" name="email" class="form-control"  value="<?php echo $profile_details['email']; ?>" /></td>
						<input type="hidden" name="old_email" class="form-control"  value="<?php echo $profile_details['email']; ?>" /></td>
					</tr>
					<tr>
						<td>Mobile No.</td>
						<td><input type="text" name="mob" class="form-control"  value="<?php echo $profile_details['phone']; ?>"  /></td>
					</tr>
					<tr>
						<td>Old Password</td>
						<td><input type="password" name="pass" id="pass" class="form-control"  /></td>
					</tr>
					<tr>
						<td>New Password</td>
						<td><input type="password" name="new_pass" class="form-control"  /> &nbsp;
						 [ If you want to change ]
						</td>
					</tr>
					
					
					</table>
					
					
					<br />
				
				<span id="msg" style="font-size:18px; color:#D85C1E; ">
				
				</span>
				
							
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="update_btn" name="update_profile" class="btn btn-primary">Save changes</button>
		</form>
      </div>
    </div>
  </div>
</div>