<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		<!-- books -->
		<div class="span9" style="margin-left: 25%;">
			<?php
            	if($this->session->flashdata('noti_app')){
					#display notification
					echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">x</a>Loaning book was successful!</div>';
				}elseif($this->session->flashdata('noti_apps')){
					#display notification
					echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">x</a>Cancelling reserved book was successful!</div>';
				}elseif($this->session->flashdata('book_error')){
					#display notification
					echo '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Loaning was unsuccessful!</div>';
				}elseif($this->session->flashdata('reserved')){
					#display notification
					echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">x</a>Reservation was successful!</div>';
				}elseif($this->session->flashdata('book_max')){
					#display notification
					echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">x</a>You are only allow to loan 3 books at a time. </div>';
				}elseif($this->session->flashdata('reserve_max')){
					#display notification
					echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">x</a>You are only allow to reserve 2 books at a time. </div>';
				}elseif($this->session->flashdata('noti_request_success')){
					#display notification
					echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">x</a>Your request have been received. </div>';
				}elseif($this->session->flashdata('noti_request_error')){
					#display notification
					echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">x</a>Your request was not received due to system error. </div>';
				}
			?>
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
			<nav id="page-nav">
			  <a href="<?php echo base_url();?>books/10"></a>
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
		</script>
	</div>
</div>

<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->


