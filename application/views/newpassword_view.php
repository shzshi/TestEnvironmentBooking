<?php include('header_view.php');?>
<!-- Page Start -->
<div class="container page-body">
	<div class="row">
		<div class="span5 offset4">
			<div class="login-frm">
				<form  action="updatePassword" method="post" name="logForm" id="logForm" class="form-horizontal">
					<legend>Create New Password<div><i class="icon-asterisk"></i></div></legend>
						<div class="control-group">
						<label class="control-label" for="inputPassword">New Password</label>
						<div class="controls">
							<div class="input-prepend">
							  <span class="add-on"><i class=" icon-asterisk"></i></span>
							  <input class="span2" name="password" type="password" id="password" name="password" placeholder="Password">
							</div>
						</div>
					  </div> 
					  <div class="control-group">
						<label class="control-label" for="inputPassword">Confirm Password</label>
						<div class="controls">
							<div class="input-prepend">
							  <span class="add-on"><i class=" icon-asterisk"></i></span>
							  <input class="span2 required password" name="pwd" type="password" id="prependedInput txtbox" placeholder="Re-Type Password">
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