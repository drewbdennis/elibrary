<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		
		<!-- books -->
		<div class="span9" style="margin-left: 25%;">
			<h3><?php echo $title; ?></h3>
			<?php if(empty($rows)): ?>
				<ul class="unstyled">
					<li style="border-bottom:1px solid #999;padding-top:10px;padding-bottom:10px;">
						<div class="pull-right">
							<a href="#">Cancel</a>
						</div>
						[Book Title] [ISBN]
					</li>
					<li style="border-bottom:1px solid #999;padding-top:10px;padding-bottom:10px;">
						<div class="pull-right">
							<a href="#">Cancel</a>
						</div>
						[Book Title] [ISBN]
					</li>
				</ul>
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