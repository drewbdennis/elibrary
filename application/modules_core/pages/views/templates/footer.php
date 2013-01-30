    <!-- footer -->
    <footer>
    	<div class="container-fluid">
    		<p class="credit muted">
    			&copy; 2013 <a href="<?php echo base_url(); ?>"><?php echo $sitename; ?></a> All Rights Reserved. <a href="<?php echo base_url(); ?>terms">Terms</a> & <a href="<?php echo base_url(); ?>privacy">Privacy</a> <span class="pull-right">Power by: <a href="#">BevennyCreations</a></span>
    		</p>
    	</div>
    </footer>
    <script>
    	var opts = {
			lines: 11, // The number of lines to draw
			length: 7, // The length of each line
			width: 4, // The line thickness
			radius: 8, // The radius of the inner circle
			corners: 1, // Corner roundness (0..1)
			rotate: 0, // The rotation offset
			color: '#000', // #rgb or #rrggbb
			speed: 0.9, // Rounds per second
			trail: 60, // Afterglow percentage
			shadow: false, // Whether to render a shadow
			hwaccel: false, // Whether to use hardware acceleration
			className: 'spinner', // The CSS class to assign to the spinner
			zIndex: 2e9, // The z-index (defaults to 2000000000)
			top: 'auto', // Top position relative to parent in px
			left: 'auto' // Left position relative to parent in px
		};
		var target = document.getElementById('spinner');
		var spinner = new Spinner(opts).spin();
		
		$(document).ready(function(){
			spinner.spin(target);
		});
		
		$(window).bind("load", function() {
		   spinner.stop();
		});
    </script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.masonry.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.infinitescroll.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.nanoscroller.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap-fileupload.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap-typeahead.min.js'; ?>"></script>
	<!-- functions -->
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/functions.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/ticker.js'; ?>"></script>
    <script>
    	$(".nano").nanoScroller();
    </script>
  </body>
</html>