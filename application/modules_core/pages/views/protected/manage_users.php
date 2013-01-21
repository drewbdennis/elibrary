<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		
		<!-- books -->
		<div class="span9" style="margin-left: 25%;">
			<?php
				if($this->session->flashdata('notification')){
					#display notification
					echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">x</a>User was added successful!</div>';
				}elseif($this->session->flashdata('error')){
					#display notification
					echo '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a><b>Adding New User:</b> All fields are required!</div>';
				}
			?>
			
			<div>
				<h3 style="display:inline-block;">Manage Users</h3>
				<div class="pull-right height35">
					<?php echo form_open('manage_users/','style="display:inline-block;"'); ?>
					  <input name="usrname" type="text" class="input-medium" placeholder="search by fullname">
					  <!--<button type="submit" class="btn">Search</button>-->
					<?php echo form_close(); ?>
					<a href="#" title="Find User"><i class="icon-search"></i></a>
					<a href="#myModal" data-toggle="modal" title="Add New User"><i class="icon-plus-sign"></i></a>
				</div>
			</div>
			<!-- Modal -->
			<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			    <h3 id="myModalLabel">Add New User</h3>
			  </div>
			  <?php echo form_open('add_user/','style="margin:0;"'); ?>
				  <div class="modal-body">
				    <label>First Name</label>
					<?php echo form_input(array('id' => 'fname', 'name' => 'fname', 'class' => 'input input-xlarge'),set_value('fname')); ?>
					
					<label>Last Name</label>
					<?php echo form_input(array('id' => 'lname', 'name' => 'lname', 'class' => 'input input-xlarge'),set_value('lname')); ?>
					
					<label>Email</label>
					<?php echo form_input(array('id' => 'usr_email', 'name' => 'usr_email', 'class' => 'input input-xlarge'),set_value('usr_email')); ?>
					
					<label>Username</label>
					<?php echo form_input(array('id' => 'username', 'name' => 'username', 'class' => 'input input-xlarge'),set_value('username')); ?>
					
					<label>Password</label>
					<?php echo form_password(array('id' => 'new_password1', 'name' => 'new_password1', 'class' => 'input input-xlarge'),set_value('new_password1')); ?>
					
					<label>Repeat Password</label>
					<?php echo form_password(array('id' => 'new_password2', 'name' => 'new_password2', 'class' => 'input input-xlarge')); ?>
					
					<label>Role</label>
					<select id="usr_role" name="usr_role" style="width:280px;">
						<option value="" selected="selected">Please select</option>
						<option value="1">Member</option>
						<option value="9999">Superuser</option>
					</select>
					
				  </div>
				  <div class="modal-footer">
				    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				    <?php echo form_submit(array('name' => 'submit','class' => 'btn btn-primary'), 'Add New User'); ?>
				  </div>
			  <?php echo form_close(); ?>
			</div>
			<!-- Modal ends -->
			<?php if(!empty($rows)): ?>
			<ul class="media-list">
				<?php foreach($rows as $row) : ?>
				<li class="media" style="border-bottom:1px solid #999;">
					<img class="pull-left" alt="pic" src="<?php echo base_url();?>assets/img/pics.png" style="width:90px;height:90px;padding-bottom:10px;" />
					<div>
						<a class="pull-right" href="#">Disable</a>
					</div>
					<table class="table border-remove" style="width:90%;margin-bottom:0;">
						<tbody>
							<tr>
								<td><b>Fullname:</b> <?php echo $row["fullname"]; ?></td>
								<td><b>Gender:</b>
									<?php
										if(!empty($row["gender"])){
											echo $row["gender"];
										}else{
											echo 'N/A';
										} 
									?>
								</td>
								<td><b>Email:</b> <?php echo $row["email"]; ?></td>
								<td><b>Phone:</b> <?php echo $row["phone"]; ?></td>
								<td><b>Mobile:</b> <?php echo $row["mobilephone"]; ?></td>
							</tr>
							<tr>
								<td colspan="5"><b>Address:</b>
									<?php 
										if(!empty($row["address"])){
											echo $row["address"].', '.$row["city"].', '.$row["country"].', '.$row["zip"];
										}else{
											echo 'N/A';
										}
										
										if(strtoupper($row["state"]) != "N/A"){
											echo ', '.$row["state"];
										}
									?>
								</td>
							</tr>
						</tbody>
					</table>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php echo $this->pagination->create_links(); ?>
			<?php else: ?>
				<p>No data to display...</p>
			<?php endif; ?>
		</div>
	</div>
</div>

<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->


