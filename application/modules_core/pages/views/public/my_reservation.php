<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		
		<!-- books -->
		<div class="sn offset2">
			<h3><?php echo $title; ?></h3>
			<?php if(!empty($rows)): ?>
				<ul class="unstyled">
					<?php foreach($rows as $row) : ?>
						<?php $book = $bookModel->Get($row["ISBN"]); ?>
						<li style="border-bottom:1px solid #999;padding-top:10px;padding-bottom:10px;">
							<div class="pull-right">
								<a href="#">Cancel</a>
							</div>
							<?php echo $book->title.' - '.$book->ISBN; ?>
						</li>
					<?php endforeach; ?>
				</ul>
				<?php echo $this->pagination->create_links(); ?>
			<?php else: ?>
				<p>No data to display...</p>
			<?php endif; ?>
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