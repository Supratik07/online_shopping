<div class="row head-logo">
			<div class="head1">
			<img src="images/bookstore.png" alt="Logo" style="height:125px; width:180px;"/>
			</div>
			
			<div class="head2">
			 <br /><br /><br />
				<form style="border:2px solid #FF571E; padding:0px !important; width:98%;" action="search.php" method="post">
				  				
					   <select name="search" class="form-control" style="width:19.5%;  outline: none; border-color: #fff; float:left;">
					   <option value="Book">Book</option>
					   <option value="Author">Author</option>
					   <option value="Subject">Subject</option>
					   </select>
					
						<label class="sr-only" for="exampleInput">Search by title, author, subject or ISBN here...</label>
						  <input type="text" name="search-item" class="form-control" id="exampleInput" placeholder="Search by title, author, subject or ISBN here..." style="width:61%;  outline: none; border-color:#fff; float:left;">
													
				  <button type="submit" name="submit" style="padding:5px; width:19.5%; background-color:#FF571E; float:left;" >
				  <span class="glyphicon glyphicon-search" aria-hidden="true"></span> &nbsp;
				  Search
				  </button>
				  <br clear="all" />
				</form>
				
			
			</div>
			
			
			<div class="head1">
			<a href="contact.php" class="pull-right">Contact Us</a> &nbsp;
			<?php if(isset($_SESSION['id']) || isset($_SESSION['admin_id']) || isset($_SESSION['seller_id']))
			{
				if(isset($_SESSION['seller_id']))	
				echo '<a href="book_vendors/logout.php" class="">Seller Logout</a> &nbsp;';
				if(isset($_SESSION['admin_id']))	
				echo '<a href="admin/logout.php" class="">Admin Logout</a> &nbsp;';
			}
			else
			{
				?>
			
			<a href="seller.php" class="">Seller Portal</a> &nbsp;
			<a href="admin.php" class="">Admin Portal</a>
			<br />
			<?php 
			}
			?>
			
			
			
			
			<div class="pull-right" style="margin-top:20%; padding-right:20px; font-size:16px; text-decoration:none; "> 
			
			
			
			&nbsp;
				
					<?php 
					if(isset($_SESSION['id']))
					{
						?>
						
						<div class="dropdown"  style="float:left; margin-left:15px; color:#46BBFF; cursor:pointer; ">
						<font class="dropdown-toggle" type="button" data-toggle="dropdown">
						<?php $username=$_SESSION['username'];
						$fname=explode(' ',$username);
						echo "Hi! ".ucfirst($fname[0])	;
						?>
						<span class="caret"></span></font>
						<ul class="dropdown-menu">
						  <li><a href="#" data-toggle="modal" data-target="#profile">Update Profile</a></li>
						  <li><a href="orders.php">Orders</a></li>
						  <li><a href="logout.php">Logout</a></li>
						</ul>
					  </div>
					  
					<a href="cart.php" style="float:left; margin-left:15px;">			
			<span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
			Cart</a>
					  <br clear="all"/>
					<?php
					}
					else if( !isset($_SESSION['admin_id']) && !isset($_SESSION['seller_id']))
					{
						
					?>
					
					<a href="cart.php" style="float:left;">			
			<span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
			Cart</a>
			
			<a href="login.php">
			<span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span>
			Login</a>
			
			<?php
					}
					?>
			
			</div>
			
			
			</div>
		</div>