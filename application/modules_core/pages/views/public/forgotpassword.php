<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		
		<!-- books -->
		<div class="span9" style="margin-left: 25%;">
			<h3>Retrieve Password</h3>
			<p>
                To obtain a new password, please enter your e-mail, or username and an e-mail will be sent to you.
            </p>
            <!-- form below here -->
            <?php echo form_open('retrieve_password','class="form-inline"'); ?>
				<?php
					if($this->session->flashdata('msg')){
						#display notification
						echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">x</a>Please check e-mail for message.</div>';
					}
				?>
				<div style="width: 100%;"><?php echo form_error('username'); ?></div>
				<input type="text" name="username" class="input-xlarge" placeholder="Email/Username" title="Enter email or username.">
				<button type="submit" class="btn btn-primary">Submit</button>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->