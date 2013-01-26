<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar2.php'); ?>
		
		<!-- books -->
		<div class="span9" style="margin-left: 25%;">
			<div>
				<h3 style="display:inline-block;"><?php echo $title; ?></h3> - <small><?php echo $genre; ?></small>
			</div>
			<div id="container" class="thumbnails">
				<?php if(!empty($rows)): ?>
					<?php foreach($rows as $row) : ?>
						<?php $cat = $categoryModel->GetCategory($row["cat_name"]); ?>
        				<?php $his = $historyModel->GetBook($row["ISBN"]); ?>
        				<?php $res = $reservationModel->Check($row["ISBN"]); ?>
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
							<img class="img-rounded" data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url().'assets/img/books/'.$row["image_url"];?>" />
							<?php else: ?>
							<img class="img-rounded" data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url();?>assets/img/pics.png" />
							<?php endif; ?>
		    				<div class="caption">
		    					<!--<b><small>RM<?php echo $row["price"]; ?></small></b>
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
		    				</p>-->
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
			<!-- #container end -->
			<nav id="page-nav">
			  <a href="<?php echo base_url();?>genres/10"></a>
			</nav>
		</div>
		<script>
			var i = 10;
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
				
				$container.infinitescroll({
			      navSelector  : '#page-nav',    // selector for the paged navigation 
			      nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
			      itemSelector : '.item',     // selector for all items you'll retrieve
			      loading: {
			          finishedMsg: 'No more pages to load.',
			          img: '<?php echo base_url();?>assets/img/loading.gif'
			        }
			      },
			      // trigger Masonry as a callback
			      function( newElements ) {
			        // hide new items while they are loading
			        var $newElems = $( newElements ).css({ opacity: 0 });
			        // ensure that images load before adding to masonry layout
			        $newElems.imagesLoaded(function(){
			          // show elems now they're ready
			          $newElems.animate({ opacity: 1 });
			          $container.masonry( 'appended', $newElems, true );
			          // change page 10
			          i = i + 10;
			          $('#page-nav').html('<a href="/elibrary/books/'+i+'"></a>');
			        });
			      });
				
			});
			
			$('.item').hover(function(){
				$('.book-tab',this).toggle();
			});
		</script>
	</div>
</div>

<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->