<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title.' - '.$sitename; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap.min.css'; ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap-responsive.min.css'; ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/theme.css'; ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/nanoscroller.css'; ?>" type="text/css">
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.8.3.min.js'; ?>"></script>
  </head>
  <body>
  	<div class="wrapper">
	    <!-- Navbar -->
	    <header>
	    	<div class="navbar navbar-fixed-top">
			  <div class="navbar-inner">
			    <div class="container-fluid">
			    	<a class="brand" href="<?php echo base_url(); ?>"><?php echo $sitename; ?></a>
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
                    
                    <!-- drop down -->
                    <ul class="nav pull-right">
                    	<li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                        	<i class="icon-user"></i>
	                        	<b>Login</b>
	                        	<b class="caret"></b>
	                        </a>
	                        <div class="dropdown-menu login">
	                        	<!-- #login -->
	                        	<?php echo form_open('login/'); ?>
	                        		<?php
										if($this->session->flashdata('blank_error')){
											#display notification
											echo '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Username or Password is blank.</div>';
										}elseif($this->session->flashdata('login_error')){
											#display notification
											echo '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a>Username or Password is invalid.</div>';
										}
									?>
	                        		<?php echo form_input(array('id'=>'username','name'=>'login_detail[username]','class'=>'input','placeholder'=>'Username')); ?>
	                        		<?php echo form_password(array('id'=>'password','name'=>'login_detail[password]','class'=>'input','placeholder'=>'Password')); ?>
	                        		<?php echo form_submit(array('name'=>'submit','class'=>'btn btn-primary'),'Login'); ?>
	                        		<a href="<?php echo base_url(); ?>forgotpassword/" style="display:inline-block;color:#08C;padding: 3px 15px;">Forgot password?</a>
	                        	<?php echo form_close(); ?>
	                        </div>
                    	</li>
                    </ul>
			    </div>
			  </div>
			</div>
	    </header>
	    <div class="clearfix"></div>
    	<!-- navbar end -->
