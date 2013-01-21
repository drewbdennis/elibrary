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
					echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a>Book was added successful!</div>';
				}elseif($this->session->flashdata('error')){
					#display notification
					echo '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><b>Adding New Book:</b> Make sure all required fields are filled!</div>';
				}elseif($this->session->flashdata('noti_update')){
					#display notification
					echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a>Booking was updated successful!</div>';
				}elseif($this->session->flashdata('upload_error')){
					#display notification
					echo '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a>
							Something when wrong. Please make sure file was selected. (gif,jpg,png) are allowed.
						</div>';
				}
			?>
			
			<div>
				<h3 style="display:inline-block;">Manage Books</h3>
				<div class="pull-right height35">
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
			  <?php echo form_open_multipart('add_book/','style="margin:0;" class="form-horizontal"'); ?>
				  <div class="modal-body">
				  	<div>
						<div class="fileupload fileupload-new" data-provides="fileupload" style="display: inline-block;">
							<div class="input-append">
								<div class="uneditable-input span3">
									<i class="icon-file fileupload-exists"></i>
									<span class="fileupload-preview"></span>
								</div>
								<span class="btn btn-file">
									<span class="fileupload-new">Select file</span>
									<span class="fileupload-exists">Change</span>
									<?php echo form_upload(array('type'=>'file','id' => 'userfile', 'name' => 'userfile', 'class' => 'input'),set_value('userfile')); ?>
								</span>
								<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
							</div>
						</div>
						<span class="label label-important">Required</span>
					</div>
				  	
				  	<div style="padding-bottom: 10px;">
					    <?php echo form_input(array('id' => 'ISBN', 'name' => 'ISBN', 'class' => 'input input-xlarge','placeholder'=>'ISBN', 'maxlength'=>'9'),set_value('ISBN')); ?>
						<span class="label label-important">Required</span>
					</div>
					
					<div style="padding-bottom: 10px;">
				    	<?php echo form_input(array('id' => 'bk_title', 'name' => 'bk_title', 'class' => 'input input-xlarge','placeholder'=>'Title of Book', 'maxlength'=>'150'),set_value('bk_title')); ?>
						<span class="label label-important">Required</span>
					</div>
					
					<div style="padding-bottom: 10px;">
						<select id="bk_author" name="bk_author" style="width:280px;">
							<option value="" selected="selected">Please select author</option>
							<?php if(!empty($authors)): ?>
								<?php foreach($authors as $author): ?>
									<option value="<?php echo $author->id; ?>"><?php echo $author->au_fname.' '.$author->au_lname; ?></option>
								<?php endforeach;?>
							<?php endif; ?>
						</select>
						<span class="label label-important">Required</span>
					</div>
					
					<div style="padding-bottom: 10px;">
						<select id="bk_publisher" name="bk_publisher" style="width:280px;">
							<option value="" selected="selected">Please select publisher</option>
							<?php if(!empty($publishers)): ?>
								<?php foreach($publishers as $publisher): ?>
									<option value="<?php echo $publisher->id; ?>"><?php echo $publisher->pub_name; ?></option>
								<?php endforeach;?>
							<?php endif; ?>
						</select>
						<span class="label label-important">Required</span>
					</div>
					
					<div style="padding-bottom: 10px;">
						<?php echo form_input(array('id' => 'bk_year', 'name' => 'bk_year', 'class' => 'input input-xlarge','placeholder'=>'Year Published', 'maxlength'=>'4'),set_value('bk_year')); ?>
						<span class="label label-important">Required</span>
					</div>
					
					<div style="padding-bottom: 10px;">
						<?php echo form_input(array('id' => 'bk_quantity', 'name' => 'bk_quantity', 'class' => 'input input-xlarge','placeholder'=>'Quantity', 'maxlength'=>'10'),set_value('bk_quantity')); ?>
						<span class="label label-important">Required</span>
					</div>
					
					<div style="padding-bottom: 10px;">
						<div class="input-prepend">
							<span class="add-on span4">RM</span>
							<?php echo form_input(array('id' => 'bk_price', 'name' => 'bk_price', 'class' => 'input input-xlarge span12','placeholder'=>'Price', 'maxlength'=>'10'),set_value('bk_price')); ?>
						</div>
					</div>
					
					<div style="padding-bottom: 10px;">
						<select id="bk_category" name="bk_category" style="width:280px;">
							<option value="" selected="selected">Please select genre</option>
							<?php if(!empty($categories)): ?>
								<?php foreach($categories as $category): ?>
									<option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
								<?php endforeach;?>
							<?php endif; ?>
						</select>
						<span class="label label-important">Required</span>
					</div>
				
					<label>Description</label>
					<?php echo form_textarea(array('id' => 'bk_description', 'name' => 'bk_description', 'cols'=>'30', 'rows'=>'5','class'=>'span12'),set_value('bk_description')); ?>
				
				</div>
				  <div class="modal-footer">
				    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				    <?php echo form_submit(array('name' => 'submit','class' => 'btn btn-primary'), 'Add New Book'); ?>
				  </div>
			  <?php echo form_close(); ?>
			</div>
			<!-- Modal ends -->
			
			<!-- Modal -->
			<div id="editModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			    <h3 id="myModalLabel">Update Book</h3>
			  </div>
			  <?php echo form_open_multipart('update_book/','id="formUpdate" style="margin:0;" class="form-horizontal"'); ?>
				  
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
							<a href="#editModal" data-toggle="modal" onclick="update_book('<?php echo $row['ISBN']; ?>'); return false;">Update</a> | <a href="#">Disable</a>
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
<script>
	function update_book(id){
	   	var book_id = id;
	   	
	   	$.post('<?php echo base_url();?>edit_book',{ 'book_id': book_id}, function(data) {
			$('#formUpdate').html(data);
			//alert('Load was performed.');
		});
	 }
	 
</script>

<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->


