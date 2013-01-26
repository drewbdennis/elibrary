<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		
		<!-- books -->
		<div class="sn offset2">
			<!-- show this section when user isn't logged in -->
			<!-- notice -->
			<div class="hero-unit"  style="text-align: center;">
				<h2>Register to unleash the power of knowledge!</h2>
				<p>
					An account allows you to loan, reserve, buy a book, and more. These services are only available to current student, and alumni of 
					[school name here].
				</p>
			</div>
			
			<?php
				if($this->session->flashdata('noti_request_success')){
					#display notification
					echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">x</a>Your request have been received. </div>';
				}elseif($this->session->flashdata('noti_request_error')){
					#display notification
					echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">x</a>Your request was not received due to system error. </div>';
				}elseif($this->session->flashdata('account_blocked')){
					#display notification
					echo '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a><strong>Account is blocked!</strong>
					 Please contact the administrator.</div>';
				}
			?>
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
						<a class="thumbnail">
							<!--<h4><?php echo $row["title"]; ?></h4>-->
							<?php if(!empty($row["image_url"])): ?>
							<img class="img-rounded" data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url().'assets/img/books/'.$row["image_url"];?>" />
							<?php else: ?>
							<img class="img-rounded" data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url();?>assets/img/pics.png" />
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
		    			</a>
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
		<!-- book section end -->
		
		<div class="span2">
			Advertisment
		</div>
		
		<script>
			var i = 10;
			$(function(){
				var $container = $('#container');
				$container.imagesLoaded(function(){
					$container.masonry({
					    // options
					    itemSelector : '.item',
					    columnWidth : function( containerWidth ) {return containerWidth / 5;},
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


