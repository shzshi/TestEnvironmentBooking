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
													<option value="apache">Apache</option>
													<option value="dotnet">DOTNET</option>
													<option value="jboss">JBoss</option>
													<option value="mobile">Mobile</option>
													<option value="sharepoint">Sharepoint</option>
													<option value="weblogic">Weblogic</option>
												</optgroup>
												<optgroup label="Databases">
													<option value="oracle">Oracle</option>
													<option value="sqlserver">SQL Server</option>
													<option value="mysql">MySQL</option>
													<option value="mongodb">MongoDB</option>
													<option value="postgress">Postgress</option>
												</optgroup>
												<optgroup label="MiddleWare">
													<option value="soa">SOA</option>
													<option value="camel">Camel</option>
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
							 
						</div>
					</div>
   			</div>
		</div>
	</div>
</div>
<!-- Page End -->
<?php include('footer_view.php');?>
