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
						<?php $cat = $categoryModel->GetCategory($row["cat_name"]); ?>
        				<?php $his = $historyModel->GetBook($row["ISBN"]); ?>
        				<?php $res = $reservationModel->Check($row["ISBN"]); ?>
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
		    					<div class="btn-group">
		    						<?php if(empty($his)) : ?>
		    							<?php if($res == FALSE) : ?>
		    								<a href="<?php echo base_url() . 'loan/'.$row["ISBN"]; ?>" class="btn btn-primary">Loan</a>
		    								<a href="#" class="btn disabled">Reserve</a>
		    							<?php else: ?>
		    								<a href="#" class="btn btn-primary disabled">Loan</a>
		    								<a href="#" class="btn disabled">Reserve</a>
		    							<?php endif; ?>
		    						<?php else: ?>
		    							<?php if($his->returned == 'Y') : ?>
		    								<a href="<?php echo base_url() . 'loan/'.$row["ISBN"]; ?>" class="btn btn-primary">Loan</a>
		    							<?php else: ?>
		    								<a href="#" class="btn btn-primary disabled">Loan</a>
		    							<?php endif; ?>
		    							<?php if($res == false): ?>
		    								<?php if($his->returned == 'N') : ?>
		    									<a href="<?php echo base_url() . 'reserve/'.$row["ISBN"]; ?>" class="btn">Reserve</a>
		    								<?php else: ?>
		    									<a href="#" class="btn disabled">Reserve</a>
		    								<?php endif; ?>
		    							<?php else: ?>
		    								<a href="#" class="btn disabled">Reserve</a>
		    							<?php endif; ?>
		    						<?php endif; ?>
		    					</div>
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


