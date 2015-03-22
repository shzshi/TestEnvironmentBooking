<?php include('header_view.php');?>
<!-- Page Start -->
<script type="text/javascript">             
	$(function() {
		
		//var dd = new DropDown( $('#dd') );
		
		$('.icon-edit').click(function() {
			// all dropdowns
			//alert('I m in');
			var ID = $(this).attr("id");
			var dataString = 'scheduleId=' + ID;
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>approval/approvalschedule",
				data: dataString,
				cache: false,
				success: function(response){
				$("#modal-body").html(response);	
				$('#test').click();
				$( "#datepicker" ).datepicker({gotoCurrent: true});
				$( "#datepicker1" ).datepicker({gotoCurrent: true});
				 }
				 });		
		return false;
		});			
	});

	function showIFrame(url)
	{
	var container = document.getElementById('container');
	var iframebox = document.getElementById('iframebox');
	iframebox.src=url;
	container.style.display = 'block';
	}
	
</script>
<div class="container page-body">
	<div class="row">
		<div class="span11">
			<div class="content1">
				<ul class="nav nav-tabs">
				<li><a href="<?php echo base_url().'schedule'?>">Reservation Calendar</a></li>
				<li class="active"><a href="<?php echo base_url().'approval'?>">Approval</a></li>
				<li><a href="<?php echo base_url().'environment'?>">Environment</a></li>
				<li><a href="<?php echo base_url().'user'?>">Users</a></li>				
				</ul>
			 <div class="border"></div>
			  <div class="tab-content">
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
						$this->table->set_heading('Reservation Name', 'Environment Name', 'Reservation Type', 'Start Time','End Time', 'Created By', 'Status', 'Action');

						foreach ($this->data as $value => $key)
						{
							// Build edit/delete action links.
							//$actionedit = anchor("home/edit/".$key['courseid']."/", "Edit ");
							//$actiondelete = anchor("home/delete/".$key['courseid']."/", " Delete", array('onClick' => "return confirm('Are you sure you want to delete?')"));
							$actiontag = "
							<div class=\"btn-toolbar\">
							  <div class=\"btn-group\">
								<a class=\"btn\" href=\"#\"><i title=\"Edit\" class=\"icon-edit\" ID='".$key['calendarid']."'></i></a>
								<a class=\"btn\" href=\"".base_url()."approval/delete/".$key['calendarid']."\" onClick=\"return confirm('Are you sure you want to delete?')\"><i title=\"Delete\" class=\"icon-trash\"></i></a>
							  </div>
							</div>";
							// Add the new row to table.
							$startdate=date("m-d-Y", strtotime($key['starttime']));
							$enddate=date("m-d-Y", strtotime($key['endtime']));
							$this->table->add_row($key['reservename'], $key['envname'],$key['reservetype'], $startdate,$enddate,$key['firstname']." ".$key['lastname'],$key['status'], $actiontag);
						} 
						echo $this->table->generate();

						echo $this->pagination->create_links();
					?>
					<div class="c_action">												
	         			<!-- Button to trigger modal -->
						<a style="display:none;" href="#myModal" role="button" id='test' class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="icon-calendar icon-white"></i>  Create Reservation</a>
						 
												<!-- Modal -->

						<div class="modal hide fade" id="myModal">

						  <div class="modal-header">

							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

							<h3>Add Schedule</h3>

						  </div>
							<div class="modal-body" id="modal-body">
								<?php 
								$attributes = array ('name'=> 'addEnviromentForm','id'=>'addEnviromentForm','class'=>'form-inline');
								echo form_open_multipart('schedule/addSchedule',$attributes);
								//if(! is_null($this->data['msg'])) echo $this->data['msg'];
								?>
								  <input type="text" name="reservename" class="input-medium" placeholder="Reservation Name" />
								  <?php
									 $dropDownGroups=$this->schedule_model->getEnvforDropdown();
								  ?>
								  <select name="envtype">
									<option value="none" selected>--Environment Type--</option>
									<?php 
										foreach($dropDownGroups as $row){
											echo "<option value='".$row->envid."'>".$row->envname."</option>";
										}
									?>
								  </select><br/><br/>
								  <select name="reservetype">
								    <option value="" selected>--Reservation Type--</option>
									<option value="generic">Generic</option>
									<option value="release">Release</option>
									<option value="maintainance">Maintainance</option>
								  </select><br/><br/>
								  <input type="text" name="start" id="datepicker" class="input-medium" placeholder="Planned From" />
								  <input type="text" name="end" id="datepicker1" class="input-medium" placeholder="Planned To" />
								 
							<div class="modal-footer">
								<a href="#" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</a>
								<button type="submit" name="test" class="btn btn-success" id="test">Add Reservation</button>
						    </div>
						</form>
						</div>
						</div>
					</div>
					<div id="container" style="display:none;">
					   <iframe src="" name="iframe" id="iframebox" frameborder="0" height="100%" width="100%"/>
					</div>
				</div>
			   </div>
   			</div>
		</div>
	</div>
</div>
<!-- Page End -->
<?php include('footer_view.php');?>