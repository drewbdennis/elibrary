<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		
		<!-- books -->
		<div class="sn offset2">
			<h3>Change Password</h3>
			<!-- form below here -->
			<?php echo form_open('update_password'); ?>
				<?php
					if($this->session->flashdata('notification')){
						#display notification
						echo '<div class="alert alert-success">Password has been update!</div>';
					}elseif($this->session->flashdata('chg_psw_error')){
						#display error message
						echo '<div class="alert alert-error">Current password is incorrect!</div>';
					}
				?>
				<table class="table border-remove">
					<thead></thead>
					<tbody>
						<tr>
							<td><label>Current Password</label></td>
							<td>
								<?php echo form_password(array('id' => 'old_password', 'name' => 'old_password', 'class' => 'input input-xlarge'),set_value('old_password')); ?>
								<div style="width: 48%;"><?php echo form_error('old_password'); ?></div>
							</td>
						</tr>
						<tr>
							<td><label>New Password</label></td>
							<td>
								<?php echo form_password(array('id' => 'new_password1', 'name' => 'new_password1', 'class' => 'input input-xlarge'),set_value('new_password1')); ?>
								<div style="width: 48%;"><?php echo form_error('new_password1'); ?></div>
							</td>
						</tr>
						<tr>
							<td><label>Repeat Password</label></td>
							<td>
								<?php echo form_password(array('id' => 'new_password2', 'name' => 'new_password2', 'class' => 'input input-xlarge')); ?>
								<div style="width: 48%;"><?php echo form_error('new_password2'); ?></div>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<?php echo form_submit(array('name' => 'submit','class' => 'btn btn-primary'), 'Change Password'); ?>
							</td>
						</tr>
					</tbody>
				</table>
			<?php echo form_close(); ?>
		</div>
		
		<div class="span2">
			Advertisment
		</div>
	</div>
</div>

<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->