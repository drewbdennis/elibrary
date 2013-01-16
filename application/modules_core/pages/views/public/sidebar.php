<!-- sidebar -->
<div class="span3" style="position: fixed;">
	<div class="well sidebar-nav">
		<div style="height:550px;">
			<ul class="nav nav-list">
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
	</div>
</div>