<!-- main content -->
<div class="container-fluid">
	<div class="row-fluid">
		<!-- sidebar -->
		<?php include_once('sidebar.php'); ?>
		
		<!-- books -->
		<div class="sn offset2">
			<?php
				if($this->session->flashdata('success_payment')){
					#display notification
					echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a>Payment was successful!</div>';
				}elseif($this->session->flashdata('cancel_payment')){
					#display notification
					echo '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><b>Payment warning:</b> You canceled the payment.</div>';
				}
			?>
			<h3>Outstanding Fines</h3>
			<?php 
				$attributes = array(
		    	//'class' => '',
		    	//'style' => 'margin:0;',
		    	'id' => 'payFines',
		    	'method'=>'post'
				);
				
				echo form_open('payment/',$attributes);
			?>
				<table class="table">
					<caption style="color:red;">Account will be block if outstanding exceeds RM250.</caption>
					<thead style="background-color: #f9f9f9;">
						<tr>
							<th>#</th>
							<th>Title of Book</th>
							<th>Outdstanding</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								1
							</td>
							<td>Cats and Dogs</td>
							<td>RM200</td>
						</tr>
						<tr>
							<td>
								2
							</td>
							<td>The Road to Riches</td>
							<td>RM50</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td>
								
							</td>
							<td><b>Total Outstanding</b></td>
							<td>
								<div class="input-prepend">
								  <span class="add-on">RM</span>
								  <input name="total" class="span2" type="text" placeholder="Amount" value="250">
								</div>
								<input class="btn btn-primary" type="submit" value="Make Payment">
							</td>
						</tr>
					</tfoot>
				</table>
			<?php echo form_close(); ?>
		</div>
		
		<div class="span2">
			Advertisment
		</div>
	</div>
</div>

<div class="push"></div>
</div>
<div class="clearfix"></div>
<!-- content end -->