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
					echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">x</a>Book was added successful!</div>';
				}elseif($this->session->flashdata('error')){
					#display notification
					echo '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">x</a><b>Adding New Book:</b> All fields are required!</div>';
				}
			?>
			
			<div>
				<h3 style="display:inline-block;">Manage Books</h3>
				<div class="pull-right">
					<?php echo form_open('manage_books/','style="display:inline-block;"'); ?>
					  <input name="bk_title" type="text" class="input-medium" placeholder="search by ISBN or title">
					  <!--<button type="submit" class="btn">Search</button>-->
					<?php echo form_close(); ?>
					<a href="#" title="Find User"><i class="icon-search"></i></a>
					<a href="#myModal" data-toggle="modal" title="Add New Book"><i class="icon-plus-sign"></i></a>
				</div>
			</div>
			<!-- Modal -->
			<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			    <h3 id="myModalLabel">Add New Book</h3>
			  </div>
			  <?php echo form_open('add_books/','style="margin:0;"'); ?>
				  <div class="modal-body">
				  	load image here...
				  	
				  	<label>ISBN</label>
					<?php echo form_input(array('id' => 'fname', 'name' => 'fname', 'class' => 'input input-xlarge'),set_value('fname')); ?>
					
				    <label>Title of Book</label>
					<?php echo form_input(array('id' => 'fname', 'name' => 'fname', 'class' => 'input input-xlarge'),set_value('fname')); ?>
					
					<label>Name of Author</label>
					<?php echo form_input(array('id' => 'lname', 'name' => 'lname', 'class' => 'input input-xlarge'),set_value('lname')); ?>
					
					<label>Name of Publisher</label>
					<?php echo form_input(array('id' => 'usr_email', 'name' => 'usr_email', 'class' => 'input input-xlarge'),set_value('usr_email')); ?>
					
					<label>Year Published</label>
					<?php echo form_input(array('id' => 'username', 'name' => 'username', 'class' => 'input input-xlarge'),set_value('username')); ?>
					
					<label>Quantity</label>
					<?php echo form_input(array('id' => 'new_password1', 'name' => 'new_password1', 'class' => 'input input-xlarge'),set_value('new_password1')); ?>
					
					<label>Price</label>
					<?php echo form_input(array('id' => 'new_password2', 'name' => 'new_password2', 'class' => 'input input-xlarge')); ?>
					
					<label>Genre</label>
					<?php echo form_input(array('id' => 'fname', 'name' => 'fname', 'class' => 'input input-xlarge'),set_value('fname')); ?>
				
					<label>Description</label>
					<?php echo form_textarea(array('id' => 'lname', 'name' => 'lname', 'cols'=>'30', 'rows'=>'5','class'=>'span12'),set_value('lname')); ?>
				
				</div>
				  <div class="modal-footer">
				    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				    <?php echo form_submit(array('name' => 'submit','class' => 'btn btn-primary'), 'Add New Book'); ?>
				  </div>
			  <?php echo form_close(); ?>
			</div>
			<!-- Modal ends -->
			<?php if(!empty($rows)): ?>
			<ul class="media-list">
				<?php foreach($rows as $row) : ?>
					<?php $author = $authorModel->Get($row["author_id"]); ?>
					<?php $publisher = $publisherModel->Get($row["pub_id"]); ?>
				<li class="media" style="border-bottom:1px solid #999;">
					<?php if(!empty($row["image_url"])): ?>
					<img class="pull-left" alt="pic1" src="<?php echo base_url().'assets/img/books/'.$row["image_url"];?>" style="width:90px;height:90px;padding-bottom:10px;" />
					<?php else: ?>
					<img class="pull-left" alt="pic" src="<?php echo base_url();?>assets/img/pics.png" style="width:90px;height:90px;padding-bottom:10px;" />
					<?php endif; ?>
					<div style="margin-left: 110px;">
						<b>ISBN:</b> <?php echo $row["ISBN"]; ?>
						
						<div class="pull-right" >
							<a href="#">Update</a> | <a href="#">Disable</a>
						</div>
					</div>
					<table class="table border-remove" style="width:90%;margin-bottom:0;">
						<tbody>
							<tr>
								<td><b>Title:</b> <?php echo $row["title"]; ?></td>
								<td><b>Author:</b>
									<?php
										if(!empty($row["author_id"])){
											echo $author->au_fname." ".$author->au_lname;
										}else{
											echo 'N/A';
										} 
									?>
								</td>
								<td><b>Publisher:</b> <?php echo $publisher->pub_name; ?></td>
								<td><b>Year:</b> <?php echo $row["year"]; ?></td>
								<td><b>Quantity:</b> <?php echo $row["quantity"]; ?></td>
							</tr>
							<tr>
								<td colspan="5"><b>Description:</b>
									<?php 
										if(!empty($row["description"])){
											echo $row["description"];
										}else{
											echo 'N/A';
										}
									?>
								</td>
							</tr>
						</tbody>
					</table>
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


