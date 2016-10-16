<?php include('header_view.php');?>
<script>

	//actually cursor position

	var currentMousePos = {

		x: -1,

		y: -1

	};



	//check if cursor is in trash 

    function isElemOverDiv() {

        var trashEl = jQuery('#calendarTrash');



        var ofs = trashEl.offset();



        var x1 = ofs.left;

        var x2 = ofs.left + trashEl.outerWidth(true);

        var y1 = ofs.top;

        var y2 = ofs.top + trashEl.outerHeight(true);



        if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&

            currentMousePos.y >= y1 && currentMousePos.y <= y2) {

            return true;

        }

        return false;

    }

	

	$(document).ready(function() {

	

	   //set actually cursor pos

		jQuery(document).ready(function () {



			jQuery(document).on("mousemove", function (event) {

				currentMousePos.x = event.pageX;

				currentMousePos.y = event.pageY;

			});



		});

	

	   /* initialize the external events

		-----------------------------------------------------------------*/

	

		$('#external-events div.external-event').each(function() {

		

			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)

			// it doesn't need to have a start or end

			var eventObject = {

				title: $.trim($(this).text()), // use the element's text as the event title

				courseid: $(this).attr('id')

			};

			

			// store the Event Object in the DOM element so we can get to it later

			$(this).data('eventObject', eventObject);

			

			// make the event draggable using jQuery UI

			$(this).draggable({

				zIndex: 999,

				revert: true,      // will cause the event to go back to its

				revertDuration: 0  //  original position after the drag

			});

			

		});

	

	

		var date = new Date();

		var d = date.getDate();

		var m = date.getMonth();

		var y = date.getFullYear();

		

		$('#calendar').fullCalendar({

			editable: true,

			events: "schedule/events",

			dragRevertDuration: 0,

			editable: false,

			droppable: false, // this allows things to be dropped onto the calendar !!!
			
			eventRender: function(event, element) {
				$(element).popover({html:true,title: event.title, content: event.description, trigger: 'hover', placement: 'auto right', container:'body', delay: {"hide": 300 }});             
			},

			drop: function(date, allDay) {

			

			//var title = prompt('Course Title:');

			 

			 // retrieve the dropped element's stored Event Object

			var originalEventObject = $(this).data('eventObject');

			

			// we need to copy it, so that multiple events don't have a reference to the same object

			var copiedEventObject = $.extend({}, originalEventObject);

			 

			 if (copiedEventObject.title) {

			 //start: new Date(y, m, d),

			 //end: new Date(y, m, d),

			

			var groupid=$("#groupName").val(); 

			var d = date.getDate();

			var m = date.getMonth()+1;

			var y = date.getFullYear();



			var startDate = y+"-"+m+"-"+d+" 00:00:00";

			var endDate = y+"-"+m+"-"+d+" 00:00:00";

			

			 

			var dataString = 'courseid='+ copiedEventObject.courseid +'&groupid='+ groupid +'&start='+ startDate +'&end='+ endDate;

			

			$.ajax({

				type: "POST",

				url: "http://192.168.33.11/TestEnvironmentBooking/schedule/addSchedule",

				data: dataString,

				cache: false,

				success:function(response){

				//$('#result').html(response);

				}	

			});

			 

			// assign it the date that was reported

			copiedEventObject.start = date;

			copiedEventObject.allDay = allDay;

			    

			 

			 // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)

			 $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

				

			 }

			 calendar.fullCalendar('unselect');

			},

			

			//fullcalendar mouseover callback

			eventMouseover: function (event, jsEvent) {

				$(this).mousemove(function (e) {

					var trashEl = jQuery('#calendarTrash');

					if (isElemOverDiv()) {

						if (!trashEl.hasClass("to-trash")) {

							trashEl.addClass("to-trash");

						}

					} else {

						if (trashEl.hasClass("to-trash")) {

							trashEl.removeClass("to-trash");

						}

					}

				});

			},



			//fullcalendar eventdragstop callback

			eventDragStop: function (event, jsEvent, ui, view) {

				if (isElemOverDiv()) {

					

					jQuery('#calendar').fullCalendar('removeEvents', event.id);



					var trashEl = jQuery('#calendarTrash');

					if (trashEl.hasClass("to-trash")) {

						trashEl.removeClass("to-trash");

					}

				}

			},

			

			loading: function (bool) {

			if (!bool) {

					//jQuery('.fc-header-left').append('<div id="calendarTrash" class="calendar-trash"><img src="assets/images/trash.png"></img></div>');

				}

			},

			

		});

	

	//jQuery('.fc-header-left').append('<div id="calendarTrash" class="calendar-trash"><img src="'+ <?php echo asset_url(); ?>+'images/cal-trash.png"></img></div>');

//i

	});

	$(function() {
    $( "#datepicker" ).datepicker();
	$( "#datepicker1" ).datepicker();
	});
        
        //form validation 

 /*       $('#addUser').click(function (e) {
            var isValid = true;
            $('#reservename,#envtype,#reservetype').each(function () {
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

        }); */
   
</script>

<script>
jQuery(document).ready(function(){
  jQuery(".fc-event .fc-event-hori .fc-event-draggable .fc-event-start .fc-event-end .ui-draggable").dblclick(function(){
  jQuery(".fc-event .fc-event-hori .fc-event-draggable .fc-event-start .fc-event-end .ui-draggable").hide().css("visibility", "hidden !important");
  });


       $('#addUser').click(function (e) {
            var isValid = true;
            $('#reservename,#envtype,#reservetype,#datepicker,#datepicker1').each(function () {
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

				<li class="active"><a href="<?php echo base_url().'schedule'?>">Reservation Calendar</a></li>
				<li><a href="<?php echo base_url().'approval'?>">Approval</a></li>
				<li><a href="<?php echo base_url().'environment'?>">Environment</a></li> 
				<li><a href="<?php echo base_url().'user'?>">Users</a></li>
				</ul>

			 <div class="border"></div>

			 <div class="tab-content">

				<div class="tab-pane active">	

				<br/><div class="external-events">

						<!-- Button to trigger modal -->

						<a href="#myModal" role="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#myModal"><i class="icon-calendar icon-white"></i>Create Reservation</a>

						 

						<!-- Modal -->

						<div class="modal hide fade" id="myModal">

						  <div class="modal-header">

							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

							<h3>Create Reservation</h3>

						  </div>

						  <?php 
								$attributes = array ('name'=> 'addEnviromentForm','id'=>'addEnviromentForm','class'=>'form-inline');
								echo form_open_multipart('schedule/addSchedule',$attributes);
								//if(! is_null($this->data['msg'])) echo $this->data['msg'];
						  ?>
						  <div class="modal-body">
								  <input type="text" name="reservename" id="reservename" class="input-medium" placeholder="Reservation Name" />
								  <?php
									 $dropDownGroups=$this->schedule_model->getEnvforDropdown();
								  ?>
								  <select name="envtype" id="envtype">
									<option value=" " selected>--Environment Type--</option>
									<?php 
										foreach($dropDownGroups as $row){
											echo "<option value='".$row->envid."'>".$row->envname."</option>";
										}
									?>
								  </select><br/><br/>
								  <select name="reservetype" id="reservetype">
								    <option value=" " selected>--Reservation Type--</option>
									<option value="generic">Generic</option>
									<option value="release">Release</option>
									<option value="maintainance">Maintainance</option>
								  </select><br/><br/>
								  <input type="text" name="start" id="datepicker" class="input-medium" placeholder="Planned From" />
								  <input type="text" name="end" id="datepicker1" class="input-medium" placeholder="Planned To" />
								  
						  </div>
							<div class="modal-footer">
								<a href="#" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</a>
								<button type="submit" name="addUser" class="btn btn-success" id="addUser">Add Reservation</button>
						    </div>
						</form>
						</div>					

	         		</div>

					<div id='calendar' ></div>

					<div class='clearfix'></div>
				</div>

			  </div>

			

   			</div>

		</div>

	</div>

</div>

<?php include('footer_view.php');?>
