<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		
		<!-- books -->
		<div class="sn offset2">
			<h3>Edit Settings</h3>
			<!-- form below here -->
			<?php echo form_open('update_profile'); ?>
				<?php
					if($this->session->flashdata('notification')){
						#display notification
						echo '<div class="alert alert-success">Settings have been updated!</div>';
					}elseif($this->session->flashdata('chg_pro_error')){
						#display error message
						echo '<div class="alert alert-error">Settings was not updated. Please try again...</div>';
					}
				?>
				<table class="table border-remove">
					<thead></thead>
					<tbody>
						<tr>
							<td><b>Fullname</b></td>
							<td>
								<?php echo form_input(array('id' => 'usr_fullname', 'name' => 'usr_fullname', 'class' => 'input input-xlarge'),"$fullname"); ?>
								<div style="width: 48%;"><?php echo form_error('usr_fullname'); ?></div>
							</td>
						</tr>
						<tr>
							<td><b>Email</b></td>
							<td>
								<?php echo form_input(array('id' => 'usr_email', 'name' => 'usr_email', 'class' => 'input input-xlarge'),"$email"); ?>
								<div style="width: 48%;"><?php echo form_error('usr_email'); ?></div>
							</td>
						</tr>
						<tr>
							<td><b>Phone</b></td>
							<td>
								<?php echo form_input(array('id' => 'usr_phone', 'name' => 'usr_phone', 'class' => 'input input-xlarge'),"$phone"); ?>
							</td>
						</tr>
						<tr>
							<td><b>Mobile</b></td>
							<td>
								<?php echo form_input(array('id' => 'usr_mobile', 'name' => 'usr_mobile', 'class' => 'input input-xlarge'),"$mobile"); ?>
							</td>
						</tr>
						<tr>
							<td><b>DOB</b></td>
							<td>
								<?php echo form_input(array('id' => 'usr_dob', 'name' => 'usr_dob', 'class' => 'input input-xlarge'),"$dob"); ?>
							</td>
						</tr>
						<tr>
							<td><b>Gender</b></td>
							<td>
								<?php echo form_input(array('id' => 'usr_gender', 'name' => 'usr_gender', 'class' => 'input input-xlarge'),"$gender"); ?>
							</td>
						</tr>
						<tr>
							<td><b>Address</b></td>
							<td>
								<?php echo form_input(array('id' => 'usr_address', 'name' => 'usr_address', 'class' => 'input input-xlarge'),"$address"); ?>
							</td>
						</tr>
						<tr>
							<td><b>Country</b></td>
							<td>
								<?php echo form_input(array('id' => 'usr_country', 'name' => 'usr_country', 'class' => 'input input-xlarge'),"$country"); ?>
							</td>
						</tr>
						<tr>
							<td><b>City</b></td>
							<td>
								<?php echo form_input(array('id' => 'usr_city', 'name' => 'usr_city', 'class' => 'input input-xlarge'),"$city"); ?>
							</td>
						</tr>
						<tr>
							<td><b>State</b></td>
							<td>
								<?php echo form_input(array('id' => 'usr_state', 'name' => 'usr_state', 'class' => 'input input-xlarge'),"$state"); ?>
							</td>
						</tr>
						<tr>
							<td><b>Zip/Postal Code</b></td>
							<td>
								<?php echo form_input(array('id' => 'usr_zip', 'name' => 'usr_zip', 'class' => 'input input-xlarge'),"$zip"); ?>
							</td>
						</tr>
						<tr>
							<td><b>Fax</b></td>
							<td>
								<?php echo form_input(array('id' => 'usr_fax', 'name' => 'usr_fax', 'class' => 'input input-xlarge'),"$fax"); ?>
							</td>
						</tr>
						<tr>
							<td><b>Website</b></td>
							<td>
								<?php echo form_input(array('id' => 'usr_website', 'name' => 'usr_website', 'class' => 'input input-xlarge'),"$website"); ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<?php echo form_submit(array('name' => 'submit','class' => 'btn btn-primary'), 'Save Changes'); ?>
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


