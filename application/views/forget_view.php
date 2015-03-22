<?php include('header_view.php');
?>	
<!-- Header End -->
<script type="text/javascript">		
			function DropDown(el) {
				this.dd = el;
				this.placeholder = this.dd.children('span');
				this.opts = this.dd.find('ul.dropdown > li');
				this.val = '';
				this.index = -1;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						return false;
					});

					obj.opts.on('click',function(){
						var opt = $(this);
						obj.val = opt.text();
						obj.index = opt.index();
						obj.placeholder.text(obj.val);
					});
				},
				getValue : function() {
					return this.val;
				},
				getIndex : function() {
					return this.index;
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-3').removeClass('active');
				});

			});
	</script>	
<script>
  $(document).ready(function(){
    $("#logForm").validate();
  });
</script>
<!-- Page Start -->
<div class="container page-body">
	<div class="row">
		<div class="span5 offset4">
			<div class="login-frm">
				<form  action="passwordNew" method="post" name="logForm" id="logForm" class="form-horizontal">
					<legend>Security Question<div><i class=" icon-question-sign"></i></div></legend>
						<div class="control-group">
							<label class="control-label" for="inputEmail">Security Question</label>
							<div class="controls">
								<div id="dd" class="" tabindex="1" >
									<select class="">
									<option value="What is your school name?" <?php if($this->data->securityquestion=="What is your school name?"){ echo 'selected'; } else { echo ''; } ?>>What is your school name?</option>
									<option value="What is your first pet name?" <?php if($this->data->securityquestion=="What is your first pet name?"){ echo "selected"; } else { echo ""; } ?>>What is your first pet name?</option>
									<option value="What is your hometown?" <?php if($this->data->securityquestion=="What is your hometown?"){ echo "selected"; } else { echo ""; } ?>>What is your hometown?</option>
									</select>
								</div>	
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputEmail">Answer</label>
							<div class="controls">
								 <div class="input-prepend">
								  <span class="add-on"><i class="icon-ok"></i></span>
								  <input class="span2" id="answer" name="answer" type="text" placeholder="">
								</div> 
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								 <div class="input-prepend">
										<button type="submit" class="btn btn-success">Submit</button>
								</div> 
							</div>
						</div>
				  </div>
				  <input type="hidden" name="email" value="<?php echo $this->security->xss_clean($this->input->post('email'));?>">
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Page End -->
<?php include('footer_view.php');?>