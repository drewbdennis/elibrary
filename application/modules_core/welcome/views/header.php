<!-- start of header -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap.css'; ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/theme.css'; ?>" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.8.3.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js'; ?>"></script>
</head>
<body>

<header>
	<!-- navigation top bar -->
	<div class="navbar">
	    <div class="nav-collapse">
		    <!-- utility bav -->
		    <div class="row-fluid topnav">
		    	<div class="span5">
					<!--<a id="rolesnav"></a>-->
					<ul class="nav roles">
						<li><a href="/students/">Students</a></li>
						<li><a href="/faculty/">Faculty</a></li>
						<li><a href="/staff/">Staff</a></li>
						<li><a href="/alumni/">Alumni</a></li>
						<li><a href="/parents/">Parents</a></li>
						<li><a href="#">Visitors</a></li>
					</ul>
				</div>
				<div class="span6 pull-right">
					<ul class="nav utility">
						<li><a href="#">Directories</a></li>
						<li><a href="#">Maps</a></li>
						<li><a href="#">Quick Links</a></li>
						<li><a href="#">A-Z</a></li>
						<li><a href="#">My.LUPortal</a></li>
						<!--<li><a href="#">Giving</a></li>-->
					</ul>
					<!-- search form -->
					    <form class="navbar-search pull-right">
					    	<input type="text" class="search-query" placeholder="Search">
					    </form>
					<!-- ends -->
				</div>
		    </div>
		    <div class="row-fluid wordmark">
				<a href="/" class="on"><h1>The University of Chicago</h1></a>
			</div>
		    <div class="row mainnav">
				<div class="container">
			    	<!--<a class="brand" href="#">Title</a>-->
				    <ul class="nav lower-bar">
					    <li id="navabout" rel="d_about"><a href="#">About</a></li>
					    <li id="navadmissions" rel="d_admissions"><a href="#">Admissions & Aids</a></li>
					    <li id="navacademics" rel="d_academics"><a href="#">Academics</a></li>
					    <li id="navresearch" rel="d_research"><a href="#">Research</a></li>
					    <li id="navcivic" rel="d_civic"><a href="#">Civic Engagement</a></li>
					    <li id="navcampus" rel="d_campus"><a href="#">Campus Life</a></li>
				    </ul>
			    </div>
			</div>
	    </div>
    </div>
    <!-- ends -->
    <div id="d_about" class="row drawer">
    	<div class="span12">
    		<ul class="span2">
    			<li>
    				<a href="#">
    					History
    				</a>
    			</li>
    			<li>
    				<a href="#">
    					Accolades
    				</a>
    			</li>
    			<li>
    				<a href="#">
    					University Leadership
    				</a>
    			</li>
    		</ul>
    		<ul class="span2">
    			<li>
    				<a href="#">
    					News
    				</a>
    			</li>
    			<li>
    				<a href="#">
    					Campus Maps
    				</a>
    			</li>
    			<li>
    				<a href="#">
    					Directories
    				</a>
    			</li>
    		</ul>
    		<p class="span5">
    			One of the world’s great intellectual destinations, the University of Chicago empowers scholars and students to ask tough questions, cross disciplinary boundaries, and challenge conventional thinking to enrich human life around the globe.
    		</p>
    		<img class="span4" alt="" src="<?php echo base_url() . 'assets/images/administrative_bldg.gif'; ?>">
    	</div>
    </div>
    <div id="d_admissions" class="row drawer">
    	<div class="span12">
    		<ul class="span2">
    			<h2><a title="Undergraduate Admissions" href="#">Undergraduate</a></h2>
    			<li>
    				<a href="#">
    					Apply
    				</a>
    			</li>
    			<li>
    				<a href="#">
    					Costs & Aid
    				</a>
    			</li>
    			<li>
    				<a href="#">
    					Campus Tours
    				</a>
    			</li>
    		</ul>
    		<ul class="span2">
    			<h2><a title="Graduate Admissions" href="#">Graduate</a></h2>
    			<li>
    				<a href="#">
    					Apply
    				</a>
    			</li>
    			<li>
    				<a href="#">
    					Funding & Aid
    				</a>
    			</li>
    			<li>
    				<a href="#">
    					Graduate Programs
    				</a>
    			</li>
    		</ul>
    		<p class="span5">
    			Join a community of the world’s brightest minds and prepare to tackle its greatest problems. Here, your ideas will be heard, supported, questioned, tested, and honed as you form a network of lifelong friends, colleagues, and collaborators.
    		</p>
    		<img class="span4" alt="" src="<?php echo base_url() . 'assets/images/administrative_bldg.gif'; ?>">
    	</div>
    </div>
    <div id="d_academics" class="row drawer">
    	<div class="span12">
    		<ul class="span2">
    			Coming soon...
    		</ul>
    	</div>
    </div>
    <div id="d_research" class="row drawer">
    	<div class="span12">
    		<ul class="span2">
    			<li>
    				<a href="#">
    					Library
    				</a>
    			</li>
    		</ul>
    	</div>
    </div>
    <div id="d_civic" class="row drawer">
    	<div class="span12">
    		<ul class="span2">
    			Coming soon...
    		</ul>
    	</div>
    </div>
    <div id="d_campus" class="row drawer">
    	<div class="span12">
    		<ul class="span2">
    			Coming soon...
    		</ul>
    	</div>
    </div>
    <script>
    	$(document).ready(function() {
  			var id;
			
			$(".lower-bar li").hover(function() {
				id = "#"+$(this).attr('rel');
				$(".lower-bar li").removeClass("active");
				$(this).addClass("active");
				$(id).show();
			},function() {
				//id = "#"+$(this).attr('rel');
				$(".lower-bar li").removeClass("active");
				$(id).hide();
			});
			
			// d_about
			$("#d_about").mouseenter(function() {
				$("#d_about").show();
				$("#navabout").addClass("active");
			}).mouseleave(function() {
				$(".lower-bar li").removeClass("active");
				$("#d_about").hide();
			});
			
			// d_admissions
			$("#d_admissions").mouseenter(function() {
				$("#d_admissions").show();
				$("#navadmissions").addClass("active");
			}).mouseleave(function() {
				$(".lower-bar li").removeClass("active");
				$("#d_admissions").hide();
			});
			
			// d_academics
			$("#d_academics").mouseenter(function() {
				$("#d_academics").show();
				$("#navacademics").addClass("active");
			}).mouseleave(function() {
				$(".lower-bar li").removeClass("active");
				$("#d_academics").hide();
			});
			
			// d_research
			$("#d_research").mouseenter(function() {
				$("#d_research").show();
				$("#navresearch").addClass("active");
			}).mouseleave(function() {
				$(".lower-bar li").removeClass("active");
				$("#d_research").hide();
			});
			
			// d_civic
			$("#d_civic").mouseenter(function() {
				$("#d_civic").show();
				$("#navcivic").addClass("active");
			}).mouseleave(function() {
				$(".lower-bar li").removeClass("active");
				$("#d_civic").hide();
			});
			
			// d_campus
			$("#d_campus").mouseenter(function() {
				$("#d_campus").show();
				$("#navcampus").addClass("active");
			}).mouseleave(function() {
				$(".lower-bar li").removeClass("active");
				$("#d_campus").hide();
			});
			
		});
    </script>
</header>
<div class="clearfix"></div>
<!-- end of header --> 