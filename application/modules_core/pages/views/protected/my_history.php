<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		
		<!-- books -->
		<div class="span9" style="margin-left: 25%;">
			<div>
				<h3 style="display:inline-block;"><?php echo $title; ?></h3>
				<div class="pull-right">
					<a class="no-underline" href="#" title="Delete All">Delete All</a>
				</div>
			</div>
			<?php if(empty($rows)): ?>
				<ul class="unstyled">
					<li style="border-bottom:1px solid #999;padding-top:10px;padding-bottom:10px;">
						<div class="pull-right">
							<a href="#" title="Delete"><i class="icon-remove-sign"></i></a>
						</div>
						[Book Title] of [ISBN] was borrowed on [Date Out]
					</li>
					<li style="border-bottom:1px solid #999;padding-top:10px;padding-bottom:10px;">
						<div class="pull-right">
							<a href="#" title="Delete"><i class="icon-remove-sign"></i></a>
						</div>
						[Book Title] of [ISBN] was borrowed on [Date Out]
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