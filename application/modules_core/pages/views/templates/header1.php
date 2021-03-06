<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title.' - '.$sitename; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap.min.css'; ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap-responsive.min.css'; ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap-fileupload.min.css'; ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/theme.css'; ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/ticker.css'; ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/nanoscroller.css'; ?>" type="text/css">
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.8.3.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/spin.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.validate.js'; ?>"></script>
  </head>
  <body>
  	<div class="wrapper">
	    <!-- Navbar -->
	    <header>
	    	<div class="navbar navbar-fixed-top">
			  <div class="navbar-inner">
			    <div class="container-fluid">
			    	<a class="brand" href="<?php echo base_url(); ?>"><?php echo $sitename; ?></a>
			    	
			    	<?php if($this->session->userdata('role_id') != 9999) : ?>
				    <ul class="nav">
				      <li class="<?php if($title == 'Home'){ echo 'active';} ?>"><a href="<?php echo base_url(); ?>">Home</a></li>
				      <li class="<?php if($title == 'About'){ echo 'active';} ?>"><a href="<?php echo base_url(); ?>about/">About Us</a></li>
				      <li class="<?php if($title == 'Contact'){ echo 'active';} ?>"><a href="<?php echo base_url(); ?>contact/">Contact Us</a></li>
				    </ul>
				    <!-- search form -->
				    <?php
				    	$attributes = array(
				    	'class' => 'navbar-search pull-left form-search',
				    	'style' => 'display:inline-block;',
				    	'id' => 'mySearch',
				    	'method'=>'get'
						);
				    
				    	echo form_open('search/',$attributes); ?>
				    	<div class="input-append">
							<input name="bk_title" type="text" class="search-query span2" placeholder="search by title">
							<button type="submit" class="btn">Search</button>
						</div>
					<?php echo form_close(); ?>
                    <!-- end search -->
                    <?php endif; ?>
                    <i id="spinner"></i>
                    <!-- drop down -->
                    <ul class="nav pull-right">
                    	<li class="<?php if($title == 'Profile'){ echo 'active';} ?>">
                    		<a href="<?php echo base_url(); ?>profile/"><?php echo ucwords($display_name); ?></a>
                    	</li>
                    	<li class="divider-vertical"></li>
                    	<li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                        	<i class="icon-cog"></i>
	                        </a>
	                        <ul class="dropdown-menu">
	                        	<li><a href="<?php echo base_url(); ?>settings"><i class="icon-cog"></i> Account Settings</a></li>
	                        	<li><a href="<?php echo base_url(); ?>change_password"><i class="icon-edit"></i> Change Password</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url(); ?>login"><i class="icon-off"></i> Log Out</a></li>
	                        </ul>
                    	</li>
                    </ul>
			    </div>
			  </div>
			</div>
	    </header>
	    <div class="clearfix"></div>
    	<!-- navbar end -->
