<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html">
	<title>Environment Booking Tool</title>
	<META name="description" content=""> 
	<META name="keywords" content=""> 
	<META name="author" content="">
	<link href="<?php echo asset_url(); ?>css/style.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo asset_url(); ?>css/bootstrap.css" rel="stylesheet" type="text/css"  media="screen"/>
	<link href="<?php echo asset_url(); ?>css/bootstrap-responsive.css" rel="stylesheet" type="text/css"media="screen"/>
	<link href="<?php echo asset_url(); ?>css/styles.css" rel="stylesheet" type="text/css" media="screen" />
<?php if($this->session->userdata('validated'))
{
	//This is for logged in user	
	echo "<link href='".asset_url()."js/jquery/jquery-ui.css' rel='stylesheet' type='text/css' media='screen' />";
	echo "<link href='".asset_url()."css/fullcalendar.css' rel='stylesheet' />";
	echo "<link href='".asset_url()."css/fullcalendar.print.css' rel='stylesheet' media='print' />";
	//echo "<link href='".asset_url()."css/noJS.css' rel='stylesheet' type='text/css' media='screen' />";

	echo "<script language='JavaScript' type='text/javascript' src='".asset_url()."js/jquery/external/jquery/jquery.js'></script>";
	echo "<script src='".asset_url()."js/jquery/jquery-ui.min.js'></script>";
	echo "<script src='".asset_url()."js/fullcalendar.min.js'></script>";
}
else
{
	//This is for non-logged in user
	echo "<script language='JavaScript' type='text/javascript' src='".asset_url()."js/jquery-1.3.2.min.js'></script>";
	echo "<script language='JavaScript' type='text/javascript' src='".asset_url()."js/jquery.validate.js'></script>";
}
?>
<script language="JavaScript" type="text/javascript" src="<?php echo asset_url(); ?>js/bootstrap.js"></script>
<body>
<!-- Header Start -->
<header>
	 <div class="row">
		<div class="span4 logo">
			<a href="<?php echo base_url();?>"><H4>Environment Booking Tool</H4></a>
		</div>
		<div class="span8">
			<div class="row-fluid">
				<div class="span12">
				   <?php if($this->session->userdata('validated')) {
					echo "<div class=\"hd-tp\">Welcome ".$this->session->userdata('firstname')." | <a href='".base_url()."main/logout'>Logout</a></div>";
					}
					?>
				</div>
			</div>
		</div>
	 </div>
</header>	
<!-- Header End -->
