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
						<div class="book-tab">
							<ul class="inline">
								<li>
									<a href="#">Full Detail</a>
								</li>
								<li class="pull-right">
									<span class="badge">20+</span>
								</li>
							</ul>
						</div>
						<div class="thumbnail">
							<!--<h4><?php echo $row["title"]; ?></h4>-->
							<?php if(!empty($row["image_url"])): ?>
							<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url().'assets/img/books/'.$row["image_url"];?>" />
							<?php else: ?>
							<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url();?>assets/img/pics.png" />
							<?php endif; ?>
		    				<!--<div class="caption">
		    					<b><small>RM<?php echo $row["price"]; ?></small></b>
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
		    				</div>-->
		    			</div>
					</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="span12 well" style="background-color:#eee !important;">
						<div class="row-fluid">
							<div class="span7">
								<h4>Result not found</h4>
								<p>
									But do you want us to add the book to our collection? If yes, please fill in the required information and submit the form.
								</p>
							</div>
							<div class="span5">
								<small style="padding-left:10px;color:red;">
									<b style="color:#000;">Required:</b> Name of Author
								</small>
								<!-- request form -->
							    <?php
							    	$attributes = array(
							    	//'class' => 'navbar-search pull-left',
							    	'style' => 'padding-left:10px;border-left: 1px solid #000;',
							    	'id' => 'myRequest',
							    	'method'=>'post'
									);
							    
							    	echo form_open('request/',$attributes); ?>
									<input name="bk_name" value="<?php echo $bk_name; ?>" type="text" class="input input-xlarge" placeholder="Name of Book" readonly="readonly">
									<input name="bk_author" type="text" class="input input-xlarge" placeholder="Name of Author">
									<div>
										<a class="btn" href="<?php echo base_url(); ?>">Cancel</a>
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								<?php echo form_close(); ?>
			                    <!-- end request -->
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<!-- #container end -->
		</div>
	</div>
</div>
<script>
	$(function(){
				var $container = $('#container');
				$container.imagesLoaded(function(){
					$container.masonry({
					    // options
					    itemSelector : '.item',
					    columnWidth : function( containerWidth ) {return containerWidth / 4;},
					    isAnimated: true
					});
				});
	});
	
	$('.item').hover(function(){
		$('.book-tab',this).toggle();
	});
</script>
<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->


