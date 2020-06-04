<?php include('header_view.php');?>
<script>
  $(document).ready(function(){
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or underscore.");

    $("#regForm").validate();
  });
</script>
<!-- Page Start -->
<div class="container page-body">
	<div class="row">
		<div class="span5 offset3">
			<div class="login-frm">
				<?php 
					$attributes = array ('name'=> 'regForm','id'=>'regForm','class'=>'form-horizontal');
					echo form_open('register/register_user',$attributes);
					if(! is_null($msg)) echo $msg;
				?>
					<legend>REGISTRATION</legend>
					  <div class="control-group">
						<label class="control-label" for="inputEmail">Your Email/Username</label>
						<div class="controls">
							 <div class="input-prepend">
							  <span class="add-on"><i class="icon-envelope"></i></span>
							  <input class="required email" id="usr_email3" name="usr_email" type="text" placeholder="Your Email">
							</div> 
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="inputEmail">Your First Name</label>
						<div class="controls">
							 <div class="input-prepend">
							  <span class="add-on"><i class="icon-user"></i></span>
							  <input class="required" id="first_name" name="first_name" type="text" placeholder="">
							</div> 
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="inputEmail">Your Last Name</label>
						<div class="controls">
							 <div class="input-prepend">
							  <span class="add-on"><i class="icon-user"></i></span>
							  <input class="required" id="last_name" name="last_name" type="text" placeholder="">
							</div> 
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="inputPassword">Password</label>
						<div class="controls">
							<div class="input-prepend">
							  <span class="add-on"><i class=" icon-asterisk"></i></span>
							  <input class="required password" name="pwd" type="password" minlength="8" id="pwd" placeholder="Password">
							</div>
						</div>
					  </div> 
					  <div class="control-group">
						<label class="control-label" for="inputPassword">Confirm Password</label>
						<div class="controls">
							<div class="input-prepend">
							  <span class="add-on"><i class=" icon-asterisk"></i></span>
							  <input class="required password" name="pwd2" type="password"id="pwd2" placeholder="Re-Type Password" minlength="8" equalto="#pwd">
							</div>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="inputEmail">Organisation</label>
						<div class="controls">
							 <div class="input-prepend">
							  <span class="add-on"><i class="icon-briefcase"></i></span>
							  <input class="required" id="organisation" name="organisation" type="text" placeholder="">
							</div> 
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="inputEmail">Designation</label>
						<div class="controls">
							 <div class="input-prepend">
							  <span class="add-on"><i class="icon-briefcase"></i></span>
							  <input class="required" id="designation" name="designation" type="text" placeholder="">
							</div> 
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="inputEmail">Security Question</label>
						<div class="controls">
							<div id="dd" class="" tabindex="1" >
								<span>Select Question</span>
								<select class="dropdown" id="securityQuestion" name="securityQuestion">
									<option class="icon-envelope icon-large" value="What is your school name?">What is your school name?</option>
									<option class="icon-envelope icon-large" value="What is your first pet name?">What is your first pet name?</option>
									<option class="icon-envelope icon-large" value="What is your hometown?">What is your hometown?</option>
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
							  <input class="span2" id="securityAnswer" name="securityAnswer" type="text" placeholder="">
							</div> 
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="inputEmail">Phone Number</label>
						<div class="controls">
							 <div class="input-prepend">
							  <span class="add-on"><i class="icon-align-center"></i></span>
							  <input class="required" id="phone" name="phone" type="text" placeholder="">
							</div> 
						</div>
					  </div>
					  <div class="control-group">
						<div class="controls">
							 <button class="btn btn-success" type="submit" name="doRegister" class="btn-success" id="doRegister">Register</button>
						</div>
					  </div>
					 <!--<div class="control-group">
						<label class="control-label" for="inputPassword">Date Of Birth</label>
						<div class="controls">
							<div class="input-append datepicker" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
							<input class="span2" size="16" type="text" id="datepicker" value="12-02-2012">
							</div>
						</div>
					  </div> -->
				<?php echo form_close();?>
			</div>
		</div>
	</div>
</div>
<!-- Page End -->
<?php include('footer_view.php');?>