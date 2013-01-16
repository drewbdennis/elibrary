<!-- sidebar -->
<div class="span3" style="position: fixed;">
	<div class="well sidebar-nav">
		<!-- show this section when user is logged in -->
		<?php if($this->session->userdata('role_id') == 9999) : ?>
			<!-- admin options -->
			<ul class="nav nav-list">
				<li class="nav-header">Main Menu</li>
				<li class="<?php if($title == 'Manage_users'){ echo 'active';} ?>"><a href="<?php echo base_url(); ?>manage_users/">Manage Users</a></li>
				<li class="<?php if($title == 'Manage_books'){ echo 'active';} ?>"><a href="<?php echo base_url(); ?>manage_books/">Manage Books</a></li>
				<li class="<?php if($title == 'Manage_categories'){ echo 'active';} ?>"><a href="<?php echo base_url(); ?>categories/">Manage Categories</a></li>
				<li class="<?php if($title == 'Send_sms'){ echo 'active';} ?>"><a href="<?php echo base_url(); ?>sms/">Send SMS</a></li>
			</ul>
		<?php else: ?>
			<!-- student options -->
			<ul class="nav nav-list">
				<li class="nav-header">Main Menu</li>
				<li class="<?php if($title == 'Outstanding_fines'){ echo 'active';} ?>"><a href="<?php echo base_url(); ?>about/">Outstanding Fines</a></li>
				<li class="<?php if($title == 'My_reservation'){ echo 'active';} ?>"><a href="<?php echo base_url(); ?>about/">My Reservation</a></li>
				<li class="<?php if($title == 'My_history'){ echo 'active';} ?>"><a href="<?php echo base_url(); ?>about/">My Library History</a></li>
			</ul>
		<?php endif; ?>
		<?php if($this->session->userdata('role_id') != 9999) : ?>
		<div style="height:250px;">
			<ul class="nav nav-list">
				<li class="divider"></li>
				<li class="nav-header">Categories of books</li>
			</ul>
			<div class="nano">
		        <div class="content">
		        	<ul class="nav nav-list">
		        		<?php foreach($categories as $cat): ?>
							<li><a href="#"><?php echo ucwords($cat->name); ?></a></li>
						<?php endforeach;?>
		        	</ul>
		        </div>
		    </div>
		</div>
		<?php endif; ?>
	</div>
</div>