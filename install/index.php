<?php

//error_reporting(E_ALL); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.

$db_config_path = '../application/config/database.php';

// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


	// Validate the post data
	if($core->validate_post($_POST) == true)
	{

		// First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
		}

		// If no errors, redirect to registration page
		if(!isset($message)) {
		  $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      $redir .= "://".$_SERVER['HTTP_HOST'];
      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
      $redir = str_replace('install/','',$redir); 
			header( 'Location: ' . $redir . 'home' ) ;
		}

	}
	else {
		$message = $core->show_message('error','Not all fields have been filled in correctly. The host, username, password, and database name are required.');
	}
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Install | ELibrary</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css">
      <style>
    	body {
    		/*color: #5a5a5a;*/
    		background-color: #999;
    	}
    	
    	/* wrapper base class */
    	.wrapper {
			position: relative;
			z-index: 10;
			margin-top:20px;
			margin-bottom: -237px;
		}
    	
    	/* signin base class */
    	.form-install {
			max-width: 500px;
			padding: 19px 29px 29px;
			margin: 0 auto 20px;
			background-color: white;
			border: 1px solid #E5E5E5;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
			-moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
			box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
		}
	    
	    /* footer class */
	   footer {
			position: relative;
			z-index: 10;
			margin-top: 250px;
			text-align: center;
			color: #333;
		}
    </style>
  </head>
  <body>
  	
  	<!-- signin form -->
    <div class="container wrapper">
    	<center><h1>Install Database</h1></center>
	    <?php if(is_writable($db_config_path)){?>
	
		<form class="form-horizontal form-install" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<fieldset>
				<legend>Enter database settings</legend>
				<?php if(isset($message)) {echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Warning!</strong> ' . $message . '</div>';}?>
				
				<div class="control-group">
					<label class="control-label" for="hostname">Hostname</label>
					<div class="controls">
						<input type="text" id="hostname" value="localhost" class="input" name="hostname" autocomplete="off" />
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="username">Username</label>
					<div class="controls">
						<input type="text" id="username" class="input" name="username" autocomplete="off" />
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="password">Password</label>
					<div class="controls">
						<input type="password" id="password" class="input" name="password" />
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="database">Database Name</label>
					<div class="controls">
						<input type="text" id="database" class="input uneditable-input" name="database" value="elibrary" />
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<input type="submit" value="Install Database" class="btn btn-primary" />
					</div>
				</div>
			</fieldset>
		</form>
	
		<?php } else { ?>
			<p class="error">Please make the application/config/database.php file writable. <strong>Example</strong>:<br /><br /><code>chmod 777 application/config/database.php</code></p>
		<?php } ?>
    </div>
    
    
    <!-- footer -->
    <div class="container">
    	<footer>
    		<!--<p>ELibrary</p>-->
    	</footer>
    </div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
  </body>
</html>