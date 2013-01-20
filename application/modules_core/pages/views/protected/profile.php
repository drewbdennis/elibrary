<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		
		<!-- books -->
		<div class="span9" style="margin-left: 25%;">
			<h3><?php echo "$fullname"; ?></h3>
			<!-- new ui -->
			<div class="row" style="margin-left: 1px;">
				<div class="span3">
					<img class="img-rounded pull-left" data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url();?>assets/img/pics.png" />
				</div>
				<div class="span9">
					<ul class="unstyled" style="display:inline-block;">
						<li>
							<b>Gender: </b><?php echo "$gender"; ?> 
						</li>
						<li>
							<b>Email: </b><?php echo "$email"; ?> 
						</li>
						<li>
							<b>Phone: </b><?php echo "$phone"; ?>
						</li>
						<li>
							<b>Fax: </b><?php echo "$fax"; ?>
						</li>
					</ul>
					<ul class="unstyled" style="display:inline-block;margin-left:30px;">
						<li>
							<b>DOB: </b><?php echo "$dob"; ?>
						</li>
						<li>
							<b>Website: </b><?php echo "$website"; ?>
						</li>
						<li>
							<b>Mobile: </b><?php echo "$mobile"; ?>
						</li>
						<li>
							hi
						</li>
					</ul>
				</div>
				<div class="span9">
					<p>
						<b>Address: </b><?php echo $address.', '.$city.', '.$country.', '.$zip.', '.$state; ?>
					</p>
				</div>
			</div>
			<div style="margin-top:5px;">
				<a class="btn btn-inverse" href="<?php echo base_url(); ?>settings/">
					<i class="icon-pencil"></i>
					Edit Profile
				</a>
			</div>
		</div>
	</div>
</div>

<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->


