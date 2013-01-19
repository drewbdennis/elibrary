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
		</script>
	</div>
</div>

<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->