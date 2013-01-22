<!-- sidebar -->
<div class="span3" style="position: fixed;">
	<div class="sidebar-nav">
		<?php if($this->session->userdata('role_id') != 9999) : ?>
		<div style="height:450px;">
			<ul class="nav nav-tabs nav-stacked">
				<li class="nav-header">Categories of books</li>
			</ul>
			<div class="nano">
		        <div class="content">
		        	<ul class="nav nav-tabs nav-stacked">
		        		<?php foreach($categories as $cat): ?>
							<li class="<?php if($genre == ucwords($cat->name)){ echo 'active';} ?>"><a href="<?php echo base_url().'genre/'.str_replace(' ','+', strtolower($cat->name)); ?>"><?php echo ucwords($cat->name); ?></a></li>
						<?php endforeach;?>
		        	</ul>
		        </div>
		    </div>
		</div>
		<?php endif; ?>
	</div>
</div>