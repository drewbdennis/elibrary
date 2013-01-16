<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		
		<!-- books -->
		<div class="span9" style="margin-left: 25%;">
			<h3>User Profile</h3>
			<!-- form below here -->
			<div>
				<div class="pull-right" style="padding-bottom:10px;">
					<a href="<?php echo base_url(); ?>settings/">
						<i class="icon-pencil"></i>
						Edit
					</a>
				</div>
				<table class="table border-remove">
					<thead></thead>
					<tbody>
						<tr>
							<td><b>Fullname</b></td>
							<td>
								<?php echo "$fullname"; ?>
							</td>
						</tr>
						<tr>
							<td><b>Email</b></td>
							<td>
								<?php echo "$email"; ?>
							</td>
						</tr>
						<tr>
							<td><b>Phone</b></td>
							<td>
								<?php echo "$phone"; ?>
							</td>
						</tr>
						<tr>
							<td><b>Mobile</b></td>
							<td>
								<?php echo "$mobile"; ?>
							</td>
						</tr>
						<tr>
							<td><b>DOB</b></td>
							<td>
								<?php echo "$dob"; ?>
							</td>
						</tr>
						<tr>
							<td><b>Gender</b></td>
							<td>
								<?php echo "$gender"; ?>
							</td>
						</tr>
						<tr>
							<td><b>Address</b></td>
							<td>
								<?php echo "$address"; ?>
							</td>
						</tr>
						<tr>
							<td><b>Country</b></td>
							<td>
								<?php echo "$country"; ?>
							</td>
						</tr>
						<tr>
							<td><b>City</b></td>
							<td>
								<?php echo "$city"; ?>
							</td>
						</tr>
						<tr>
							<td><b>State</b></td>
							<td>
								<?php echo "$state"; ?>
							</td>
						</tr>
						<tr>
							<td><b>Zip/Postal Code</b></td>
							<td>
								<?php echo "$zip"; ?>
							</td>
						</tr>
						<tr>
							<td><b>Fax</b></td>
							<td>
								<?php echo "$fax"; ?>
							</td>
						</tr>
						<tr>
							<td><b>Webmember</b></td>
							<td>
								<?php echo "$website"; ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->


