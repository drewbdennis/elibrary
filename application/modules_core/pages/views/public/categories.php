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
				}elseif($this->session->flashdata('noti_update')){
					#display notification
					echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">x</a>Category was updated successful!</div>';
				}elseif($this->session->flashdata('error')){
					#display notification
					echo '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a><b>Adding New Category:</b> Category Name is required!</div>';
				}
			?>
			
			<div>
				<h3 style="display:inline-block;">Manage Categories</h3>
				<div class="pull-right height35">
					<?php echo form_open('categories/','style="display:inline-block;"'); ?>
					  <input name="cat_name" type="text" class="input-medium" placeholder="search by title">
					  <!--<button type="submit" class="btn">Search</button>-->
					<?php echo form_close(); ?>
					<a href="#" title="Find User"><i class="icon-search"></i></a>
					<a href="#myModal" data-toggle="modal" title="Add New Category"><i class="icon-plus-sign"></i></a>
				</div>
			</div>
			<!-- Modal for add category -->
			<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			    <h3 id="myModalLabel">Add New Category</h3>
			  </div>
			  <?php echo form_open('add_category/','style="margin:0;"'); ?>
				  <div class="modal-body">
				    <label>Category Name</label>
					<?php echo form_input(array('id' => 'cat_name', 'name' => 'cat_name', 'class' => 'input input-xlarge'),set_value('cat_name')); ?>
					
					<label>Category Description</label>
					<?php echo form_textarea(array('id' => 'cat_description', 'name' => 'cat_description', 'cols'=>'30', 'rows'=>'5','class'=>'span12'),set_value('cat_description')); ?>
				  </div>
				  <div class="modal-footer">
				    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				    <?php echo form_submit(array('name' => 'submit','class' => 'btn btn-primary'), 'Add New Category'); ?>
				  </div>
			  <?php echo form_close(); ?>
			</div>
			<!-- Modal ends -->
			
			<!-- Modal for update category -->
			<div id="editModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			    <h3 id="myModalLabel">Update Category</h3>
			  </div>
			  <?php echo form_open('update_category/','id="formUpdate" style="margin:0;"'); ?>
				  
			  <?php echo form_close(); ?>
			</div>
			<!-- Modal ends -->
			
			
			<?php if(!empty($rows)): ?>
			<ul class="media-list">
				<?php foreach($rows as $row) : ?>
				<li class="media" style="border-bottom:1px solid #999;">
					<div style="margin-left: 110px;">
						<div class="pull-right" >
							<a href="#editModal" data-toggle="modal" onclick="update_category('<?php echo $row['id']; ?>'); return false;" class="btn-link">Update</a>
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
<script>
	function update_category(id){
	   	var cat_id = id;
	   	
	   	$.post('<?php echo base_url();?>edit_category',{ 'cat_id': cat_id}, function(data) {
			$('#formUpdate').html(data);
			//alert('Load was performed.');
		});
	 }
	 
</script>

<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->


