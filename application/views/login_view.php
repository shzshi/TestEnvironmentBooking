<?php include('header_view.php');?>
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
					<?php 
					$attributes = array ('name'=> 'logForm','id'=>'logForm','class'=>'form-horizontal');
					echo form_open('main/login_validation',$attributes);
					//if(! is_null($msg)) echo $msg;
					if(!is_null($this->session->flashdata('flashMsg'))) echo $this->session->flashdata('flashMsg');
					?>
					<legend>LOGIN<div><i class="icon-user"></i></div></legend>
				  <div class="control-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
						 <div class="input-prepend">
						  <span class="add-on"><i class="icon-envelope"></i></span>
						  <input class="required email" id="usr_email" name="email" type="text" placeholder="Email">
						</div> 
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label" for="inputPassword">Password</label>
					<div class="controls">
						<div class="input-prepend">
						  <span class="add-on"><i class=" icon-asterisk"></i></span>
						  <input class="required password" name="password" type="password" id="txtbox" placeholder="Password">
						</div>
					</div>
				  </div>
				  <div class="control-group">
					<div class="controls">
					  <p><a href="register/forgotEmail">Forget Password</a> | <a href="#">Remember Me</a></p>					
					  <button type="submit" name="doLogin" class="btn-success" id="doLogin3">Sign in</button>
					 <br/><br/>
					  <button type="button" name="doRegister" class="btn btn-primary" onclick="javascript:window.location='register'">New User</button>
					</div>
				  </div>
				  <?php echo form_close();?>
			</div>
		</div>
	</div>
</div>
<!-- Page End -->
<?php include('footer_view.php');?>