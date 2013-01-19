<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		<!-- books -->
		<div class="span9" style="margin-left: 25%;">
			<div id="container" class="thumbnails">
				<?php if(!empty($rows)): ?>
					<?php foreach($rows as $row) : ?>
					<div class="item">
						<div class="thumbnail">
							<h4><?php echo $row["title"]; ?></h4>
							<?php if(!empty($row["image_url"])): ?>
							<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url().'assets/img/books/'.$row["image_url"];?>" />
							<?php else: ?>
							<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url();?>assets/img/pics.png" />
							<?php endif; ?>
		    				<div class="caption">
		    					<!--<b><small>RM<?php echo $row["price"]; ?></small></b>-->
		    					<p>
		    						<?php 
										if(!empty($row["description"])){
											if(strlen($row["description"])>150){
											    $text=substr($row["description"],0,150).'... <a href="#">Read more</a>';
											    echo $text;
											}
										}else{
											echo 'N/A';
										}
									?>
		    					</p>
		    				</div>
		    			</div>
					</div>
					<?php endforeach; ?>
				<?php else: ?>
					<p>No data to display...</p>
				<?php endif; ?>
			</div>
			<?php //echo $this->pagination->create_links(); ?>
			<!-- #container end -->
		</div>
	</div>
</div>

<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->


