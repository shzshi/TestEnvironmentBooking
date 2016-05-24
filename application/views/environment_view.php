<?php include('header_view.php');?>
<!-- Page Start -->
<script type="text/javascript">
$(function() {
		$('.icon-edit').click(function() {
					// all dropdowns					
					var ID = $(this).attr("id");					
					var dataString = 'envID=' + ID;
					var fullUrl = '<?php echo base_url(); ?>environment/environmentdiv';
					$.ajax({
						type: "POST",
						url: fullUrl,
						data: dataString,
						cache: false,
						success: function(response){
						$("#modal-body").html(response);	
						$('#adduser').click();
						 }
						 });				
				return false;
		});

                $('#addEnv').click(function (e) {
                   var isValid = true;
                   $('#envname').each(function () {
                 if ($.trim($(this).val()) == '') {
                    isValid = false;
                    $(this).css({
                        "border": "1px solid red",
                        "background": "#FFCECE"
                    });
                }
                else {
                    $(this).css({
                        "border": "",
                        "background": ""
                    });
                }
            });

            if (isValid == false)
                e.preventDefault();

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
				<li class="active"><a href="<?php echo base_url().'environment'?>">Environment</a></li> 
				<li><a href="<?php echo base_url().'user'?>">Users</a></li>
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
						$this->table->set_heading('Environment Name', 'Environment Type', 'Action');
						
						foreach ($this->data as $value => $key)
						{
							// Build edit/delete action links.
							//$actionedit = anchor("admin/environment/edit/".$key['envid']."/", "Edit ");
							//$actiondelete = anchor("admin/environment/delete/".$key['envid']."/", " Delete", array('onClick' => "return confirm('Are you sure you want to delete?')"));
							
							$actiontag = "
							<div class=\"btn-toolbar\">
							  <div class=\"btn-group\">
								<a class=\"btn\" href=\"".base_url()."environment/edit/".$key['envid']."/\"><i title=\"Edit\" class=\"icon-edit\" id='".$key['envid']."'></i></a>
								<a class=\"btn\" href=\"".base_url()."environment/delete/".$key['envid']."\" onClick=\"return confirm('Are you sure you want to delete?')\"><i title=\"Delete\" class=\"icon-trash\"></i></a>
							  </div>
							</div>";

							// Add the new row to table.
							$this->table->add_row($key['envname'], $key['envtype'], $actiontag);
						} 
						echo $this->table->generate();
						
						echo $this->pagination->create_links();
						?>
						
						<div class="c_action">
							<!-- Button to trigger modal -->
							<a href="#myModal1" role="button" id='adduser' class="btn btn-success" data-toggle="modal" data-target="#myModal1"><i class="icon-folder-close icon-white"></i>Add Environment</a>
							 
							<!-- Modal -->
							<div class="modal hide fade" id="myModal1">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h3>Add A New Environment</h3>
							  </div>
							  <div class="modal-body" id="modal-body">
										  <?php 
											$attributes = array ('name'=> 'addEnviromentForm','id'=>'addEnviromentForm');
											echo form_open_multipart('environment/add',$attributes);
											//if(! is_null($this->data['msg'])) echo $this->data['msg'];
											?>
											  <input type="text" name="envname" class="input-medium" placeholder="Environment Name" />
											  <select name="envtype">
												<option value="none">None</option>
												<option value="development" selected>Development</option>
												<option value="non-production">Non-Production</option>
												<option value="production">Production</option>
											  </select><br/>
											  <select name="componentGroup[]" multiple="multiple" style="width: 400px !important; min-width: 350px; max-width: 380px;">
												<optgroup label="Application">
													<option value="C++ / C#">Apache</option>
													<option value="Java">DOTNET</option>
													<option value="Objective-C">JBoss</option>
													<option value="C++ / C#">Mobile</option>
													<option value="Java">Sharepoint</option>
													<option value="Objective-C">Weblogic</option>
												</optgroup>
												<optgroup label="Databases">
													<option value="JavaScript">Oracle</option>
													<option value="JavaScript">SQL Server</option>
													<option value="JavaScript">MySQL</option>
													<option value="JavaScript">MongoDB</option>
													<option value="JavaScript">Postgress</option>
												</optgroup>
												<optgroup label="MiddleWare">
													<option value="Perl">SOA</option>
													<option value="PHP">Camel</option>
												</optgroup>										
											</select> </br>
											Press Ctrl to select Multiple Options</BR>
										<br/><br/>
									<div class="modal-footer">
								<a href="#" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</a>
								<button type="submit" name="addUser" class="btn btn-success" id="addEnv">Add Environment</button>
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
