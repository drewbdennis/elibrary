<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		
		<!-- books -->
		<div class="span9" style="margin-left: 25%;">
			<h3><?php echo $title; ?></h3>
			<?php 
				$attributes = array(
		    	//'class' => '',
		    	'style' => 'margin:0;',
		    	'id' => 'sendForm',
		    	'method'=>'get'
				);
						
				echo form_open('send_sms/',$attributes); ?>
				  <fieldset>
					<legend>New SMS Message</legend>
					<p>
						<textarea onkeypress="check_length('sms_msg');" onkeyup="check_length('sms_msg');" id="sms_msg" name="sms_msg" rows="4" cols="80" style="word-wrap: break-word" wrap="soft" maxlength="459" class="span12"></textarea>
					</p>
					<p>
						<span>Characters left: <input type="text" id="characters" name="characters" value="459" maxlength="3" readonly="readonly">&nbsp;|&nbsp;
						SMS used: <input type="text" id="sms_used" name="sms_used" value="0" maxlength="1" readonly="readonly"></span>
					</p>
				</fieldset>
				<fieldset>
					<legend>To mobile phone numbers</legend>
					<p>
						<span>Enter numbers separated by commas without space. Include the country code with no leading zeroes e.g. 60140000000,60140000001</span>
						<textarea id="sms_to" name="sms_to" rows="3" cols="80" autocomplete="off" class="span12"></textarea>
					</p>	
					<p>
						<span style="width: 110px;">Add contacts from: </span>
						<a id="btn_phone" name="btn_phone" href="#" class="btn">Phonebook</a>
					</p>
				</fieldset>
				<input id="inpSelectedContacts" type="hidden" name="contacts" value="">
				<!-- Phonebook/contacts here -->
				
				<!-- Phonebook/contacts end -->
				<strong class="pull-right">
					<input id="btn_send" name="btn_send" type="submit" value="Send Now" class="btn btn-primary">
				</strong>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/msg_counter.js'; ?>"></script>
<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->