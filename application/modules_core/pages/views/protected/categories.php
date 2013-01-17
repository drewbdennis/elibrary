<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		
		<!-- books -->
		<div class="span9" style="margin-left: 25%;">
			<?php
				if($this->session->flashdata('notification')){
					#display notification
					echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">x</a>Category was added successful!</div>';
				}elseif($this->session->flashdata('error')){
					#display notification
					echo '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a><b>Adding New Category:</b> All fields are required!</div>';
				}
			?>
			
			<div>
				<h3 style="display:inline-block;">Manage Categories</h3>
				<div class="pull-right">
					<?php echo form_open('categories/','style="display:inline-block;"'); ?>
					  <input name="cat_name" type="text" class="input-medium" placeholder="search by title">
					  <!--<button type="submit" class="btn">Search</button>-->
					<?php echo form_close(); ?>
					<a href="#" title="Find User"><i class="icon-search"></i></a>
					<a href="#myModal" data-toggle="modal" title="Add New Category"><i class="icon-plus-sign"></i></a>
				</div>
			</div>
			<!-- Modal -->
			<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			    <h3 id="myModalLabel">Add New Category</h3>
			  </div>
			  <?php echo form_open('add_category/','style="margin:0;"'); ?>
				  <div class="modal-body">
				    <label>Category Name</label>
					<?php echo form_input(array('id' => 'fname', 'name' => 'fname', 'class' => 'input input-xlarge'),set_value('fname')); ?>
					
					<label>Category Description</label>
					<?php echo form_textarea(array('id' => 'lname', 'name' => 'lname', 'cols'=>'30', 'rows'=>'5','class'=>'span12'),set_value('lname')); ?>
				  </div>
				  <div class="modal-footer">
				    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				    <?php echo form_submit(array('name' => 'submit','class' => 'btn btn-primary'), 'Add New Category'); ?>
				  </div>
			  <?php echo form_close(); ?>
			</div>
			<!-- Modal ends -->
			<?php if(!empty($rows)): ?>
			<ul class="media-list">
				<?php foreach($rows as $row) : ?>
				<li class="media" style="border-bottom:1px solid #999;">
					<div style="margin-left: 110px;">
						<div class="pull-right" >
							<a href="#">Update</a>
						</div>
					</div>
					<b>Name: </b><?php echo $row["name"]; ?>
					<p>
						<b>Description: </b><?php echo $row["description"]; ?>
					</p>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php echo $this->pagination->create_links(); ?>
			<?php else: ?>
				<p>No data to display...</p>
			<?php endif; ?>
		</div>
	</div>
</div>

<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->


