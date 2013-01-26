<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		
		<!-- books -->
		<div class="sn offset2">
			<h3>Contact Us</h3>
			<?php
				echo validation_errors();
				
				if($this->session->flashdata('sent_success')){
					#display notification
					echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">x</a>Your message was sent, and we will contact you asap. </div>';
				}elseif($this->session->flashdata('sent_error')){
					#display notification
					echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">x</a>Your message was not sent, due to system error. </div>';
				}
			?>
			<div id="contact_us">
				<div class="well" style="background-color:#F5F5F5 !important;">
					<?php
				    	$attributes = array(
				    	//'class' => '',
				    	'style' => 'margin:0px;',
				    	'id' => 'formContact',
				    	'method'=>'post'
						);
				    
				    	echo form_open('contact/',$attributes); ?>
						
						<div class="form-inline" style="margin-bottom:5px;">
							<input name="subject" type="text" class="input" value="<?php echo set_value('subject'); ?>" placeholder="Subject" maxlength="50" style="width:31.7%;">
							<input name="name" type="text" class="input" value="<?php echo set_value('name'); ?>" placeholder="Name" maxlength="50" style="width:31.6%;">
							<input name="email" type="text" class="input" value="<?php echo set_value('email'); ?>" placeholder="Email Address" maxlength="50" style="width:31.7%;">
						</div>
					
						<textarea name="message" cols="30" rows="5" id="message" placeholder="Message" class="span12"><?php echo set_value('message'); ?></textarea>
						<button type="submit" class="btn btn-primary" style="width:100%;">SEND</button>
					<?php echo form_close(); ?>
				</div>
			</div>
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


