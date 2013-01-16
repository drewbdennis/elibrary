<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		<!-- show this section when user isn't logged in -->
		<!-- notice -->
		<div class="span9 hero-unit"  style="margin-left: 25%; text-align: center;">
			<h2>Register to unleash the power of knowledge!</h2>
			<p>
				An account allows you to loan, reserve, buy a book, and more. These services are only available to current student, and alumni of 
				[school name here].
			</p>
		</div>
		<!-- books -->
		<div class="span9" style="margin-left: 25%;">
			<div id="container" class="thumbnails">
				<div class="item">
					<div class="thumbnail">
						<h4>[Book title]</h4>
	    				<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url();?>assets/img/pics.png">
	    				<div class="caption">
	    					<small>[Price of book]</small>
	    					<p>[Book description]</p>
	    				</div>
	    			</div>
				</div>
				
				<div class="item">
					<div class="thumbnail">
						<h4>[Book title 2]</h4>
	    				<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url();?>assets/img/pics.png">
	    				<div class="caption">
	    					<small>[Price of book]</small>
	    					<p>[Book description]</p>
	    				</div>
	    			</div>
				</div>
				<div class="item">
					<div class="thumbnail">
						<h4>[Book title 3]</h4>
	    				<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url();?>assets/img/pics.png">
	    				<div class="caption">
	    					<small>[Price of book]</small>
	    					<p>[Book description]</p>
	    				</div>
	    			</div>
				</div>
				<div class="item">
					<div class="thumbnail">
						<h4>[Book title 4]</h4>
	    				<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url();?>assets/img/pics.png">
	    				<div class="caption">
	    					<small>[Price of book]</small>
	    					<p>[Book description]</p>
	    				</div>
	    			</div>
				</div>
				<div class="item">
					<div class="thumbnail">
						<h4>[Book title 5]</h4>
	    				<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url();?>assets/img/pics.png">
	    				<div class="caption">
	    					<small>[Price of book]</small>
	    					<p>[Book description]</p>
	    				</div>
	    			</div>
				</div>
				<div class="item">
					<div class="thumbnail">
						<h4>[Book title 6]</h4>
	    				<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url();?>assets/img/pics.png">
	    				<div class="caption">
	    					<small>[Price of book]</small>
	    					<p>[Book description]</p>
	    				</div>
	    			</div>
				</div>
				<div class="item">
					<div class="thumbnail">
						<h4>[Book title 7]</h4>
	    				<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo base_url();?>assets/img/pics.png">
	    				<div class="caption">
	    					<small>[Price of book]</small>
	    					<p>[Book description]</p>
	    				</div>
	    			</div>
				</div>
			</div>
			<!-- #container end -->
			<nav id="page-nav">
			  <a href="<?php echo base_url();?>books/2"></a>
			</nav>
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
			        });
			      });
				
			});
		</script>
		<!-- btn more -->
		<!--<a href="#" class="btn span9" style="margin-left: 25%;">Click to load more books...</a>-->
	</div>
</div>

<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->


