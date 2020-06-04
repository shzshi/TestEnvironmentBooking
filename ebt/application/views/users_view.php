<?php include('header_view.php');?>
<!-- Page Start -->
<script type="text/javascript">
$(function() {
		$('.icon-edit').click(function() {
					// all dropdowns					
					var ID = $(this).attr("id");					
					var dataString = 'userID=' + ID;
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>user/userdiv",
						data: dataString,
						cache: false,
						success: function(response){
						$("#modal-body").html(response);	
						$('#adduser').click();
						 }
						 });				
				return false;
		});
});
</script>				
<div class="container page-body">
	<div class="row">
		<div class="span11">
			<div class="content1">
				<ul class="nav nav-tabs">
				<li><a href="<?php echo base_url().'schedule'?>">Reservation Calendar</a></li>
				<li><a href="<?php echo base_url().'approval'?>">Approval</a></li>
				<li><a href="<?php echo base_url().'environment'?>">Environment</a></li>
				<li class="active"><a href="<?php echo base_url().'user'?>">Users</a></li>
				</ul>
			 <div class="border"></div>
			  <div class="tab-pane active">
			  <?php 
						$tmpl = array ( 'table_open'  => '<table class="table table-bordered">', 
						  'heading_row_start'   => '<tr>',
						  'heading_row_end'     => '</tr>',
                          'heading_cell_start'  => '<th>',
                          'heading_cell_end'    => '</th>',

						  'row_start'           => '<tr class="info">',
						  'row_end'             => '</tr>',
						  'cell_start'          => '<td>',
						  'cell_end'            => '</td>',

						  'row_alt_start'       => '<tr>',
						  'row_alt_end'         => '</tr>',
						  'cell_alt_start'      => '<td>',
						  'cell_alt_end'        => '</td>',

						  'table_close'         => '</table>'						 
						);
						$this->table->set_template($tmpl);
						// Set the table headings.
						$this->table->set_heading('First Name', 'Last Name', 'Organization', 'Designation', 'Action');

						foreach ($this->data as $value => $key)
						{
							// Build edit/delete action links.
							//$actionedit = anchor("admin/users/edit/".$key['userid']."/", "Edit ");
							//$actiondelete = anchor("admin/users/delete/".$key['userid']."/", " Delete", array('onClick' => "return confirm('Are you sure you want to delete?')"));
							
							$actiontag = "
							<div class=\"btn-toolbar\">
							  <div class=\"btn-group\">
								<a class=\"btn\" href=\"".base_url()."users/edit/".$key['userid']."/\"><i title=\"Edit\" class=\"icon-edit\" id='".$key['userid']."'></i></a>";
								if($this->session->userdata('usertype'))
								$actiontag.="<a class=\"btn\" href=\"".base_url()."user/delete/".$key['userid']."\" onClick=\"return confirm('Are you sure you want to delete?')\"><i title=\"Delete\" class=\"icon-trash\"></i></a>
							  </div>
							</div>";

							// Add the new row to table.
							$this->table->add_row($key['firstname'], $key['lastname'],$key['organization'], $key['designation'], $actiontag);
						} 
						echo $this->table->generate();
						
						echo $this->pagination->create_links();
						?>
						
						<div class="c_action">
							<!-- Button to trigger modal -->
							<a style="display:none;" href="#myModal1" id='adduser' class="btn btn-success" data-toggle="modal" data-target="#myModal1"><i class="icon-folder-close icon-white"></i>Add Users</a>
							 
							<!-- Modal -->
							<div class="modal hide fade" id="myModal1">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h3>Add and Update Users Details</h3>
							  </div>
							  <div class="modal-body" id="modal-body">
							  <?php 
								$attributes = array ('name'=> 'uploadUserForm','id'=>'uploadUserForm','class'=>'form-inline');
								echo form_open_multipart('user/add',$attributes);
								//if(! is_null($this->data['msg'])) echo $this->data['msg'];
								?>
								  <input type="text" name="envname" class="input-medium" placeholder="Users Name" />
								  <select name="parentCourse">
									<option value="none">None</option>
									<option value="dev" selected>Development</option>
									<option value="nonprod">Non-Production</option>
									<option value="prod">Production</option>
								  </select><br/><br/>
									<div class="modal-footer">
								<a href="#" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</a>
								<button type="submit" name="addUser" class="btn btn-success" id="addUser">Add Users</button>
							  </div>
							  </form>
							  </div>
							</div>
							<!-- Button to trigger modal -->
							 
							<!-- Modal -->
							<div class="modal hide fade" id="myModal2">
								<?php 
									$attributes = array ('name'=> 'uploadUserForm','id'=>'uploadUserForm','class'=>'form-horizontal');
									echo form_open_multipart('user/bulkUpload',$attributes);
									//if(! is_null($this->data['msg'])) echo $this->data['msg'];
								?>			
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h3>Upload the User List </h3>
							  </div>
							  <div class="modal-body">
								 
									<div class="control-group">
										<label class="control-label" for="">Select User List</label>
										<div class="controls">
												<p><input type="file" name="userfile" /></p>
										</div>
									</div>
							   </div>
							  <div class="modal-footer">
								<a href="#" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</a>
								<button type="submit" name="uploadUser" class="btn btn-success" id="uploadUser">Upload selected list</button>
							  </div>
							  </form>
							</div>
						</div>
					</div>
   			</div>
		</div>
	</div>
</div>
<!-- Page End -->
<?php include('footer_view.php');?>
