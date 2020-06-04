// wall.js

var bSuppressScroll = false;

$(document).ready(function()
{

$('#update').keydown(function(e) {      
if(e.keyCode == 13) 
{        
e.preventDefault(); // Makes no difference      
$(this).parent().submit(); // Submit form it belongs to    
} }); 

// Update Status
$(".update_button").click(function() 
{
var updateval = $("#update").val();
var dataString = 'update='+ updateval;
if(updateval=='')
{
alert("Please Enter Some Text");
}
else
{
$("#flash").show();
$("#flash").fadeIn(400).html('Loading Update...');
$.ajax({
type: "POST",
url: "message_ajax.php",
data: dataString,
cache: false,
success: function(html)
{
$("#flash").fadeOut('slow');
$("#files").html('');
//$("#mulimgupload").slideToggle('slow');
$("#mulimgupload").slideUp('slow');
$("#content").prepend(html);
$("#update").val('');	
$("#update").focus();
    	

$("#stexpand").oembed(updateval);

}



 });
}
return false;
	});
	
//commment Submit

$('.comment_button').live("click",function() 
{

var ID = $(this).attr("id");

var comment= $("#ctextarea"+ID).val();
var dataString = 'comment='+ comment + '&msg_id=' + ID;

if(comment=='')
{
alert("Please Enter Comment Text");
}
else
{
$.ajax({
type: "POST",
url: "comment_ajax.php",
data: dataString,
cache: false,
success: function(html){
$("#commentload"+ID).append(html);
$("#ctextarea"+ID).val('');
$("#ctextarea"+ID).focus();
 }
 });
}
return false;
});
// commentopen 
$('.commentopen').live("click",function() 
{
var ID = $(this).attr("id");
$("#commentbox"+ID).slideToggle('slow');
return false;
});	

// delete comment
$('.stcommentdelete').live("click",function() 
{
var ID = $(this).attr("id");
var dataString = 'com_id='+ ID;

if(confirm("Sure you want to delete this update? There is NO undo!"))
{

$.ajax({
type: "POST",
url: "delete_comment_ajax.php",
data: dataString,
cache: false,
success: function(html){
 $("#stcommentbody"+ID).slideUp();
 }
 });

}
return false;
});
	// delete update
$('.stdelete').live("click",function() 
{
var ID = $(this).attr("id");
var dataString = 'msg_id='+ ID;
if(confirm("Sure you want to delete this update? There is NO undo!"))
{

$.ajax({
type: "POST",
url: "delete_message_ajax.php",
data: dataString,
cache: false,
success: function(html){
 $("#"+ID).slideUp();
 }
 });
}
return false;
});

//scroll update
function last_msg_funtion() 
		{			
           var ID=$(".stbody:last").attr("id");
			$('div#last_msg_loader').html('<img src="images/bigLoader.gif">');
			$.post("index.php?action=get&last_msg_id="+ID,
			
			function(data){
				if (data != "") {
					$(".stbody:last").after(data);
					window.bSuppressScroll = false;
				}
				
				$('div#last_msg_loader').empty();
				
			});
			//exit();
		};  
		
		$(window).scroll(function(){
		//alert('shashi');
			//alert("scrolltop "+Math.round(parseInt($(window).scrollTop()) / 2));
			//alert("document height "+parseInt($(document).height() - $(window).height())+" scroll top "+parseInt($(window).scrollTop()-1));
			//alert("window height "+Math.round((parseInt($(document).height() - $(window).height())/2)));
			//|| parseInt($(window).scrollTop()) == parseInt($(document).height() - $(window).height()-1) || parseInt($(window).scrollTop()-1) == parseInt($(document).height() - $(window).height())
			if($(window).scrollTop() == $(document).height() - $(window).height() && window.bSuppressScroll == false)
			{				 
				 last_msg_funtion();
				 last_search_function();
				 window.bSuppressScroll = true;
			}
		});
		
//scroll update for 
function last_search_function() 
		{			
           var ID=$(".stsearch:last").attr("id");
		   //var gender=$('#gender').attr('checked');
		   var gender=$('input:radio[name=gender]:checked').val(); 
		   var ageFrom=$('#ageFrom').val();
		   var ageTo=$('#ageTo').val();
		   //alert(gender);
		   //alert(ageFrom);
		   
			$('div#last_search_loader').html('<img src="images/bigLoader.gif">');
			$.post("search.php?action=get&last_search_id="+ID+"&gender="+gender+"&ageFrom="+ageFrom+"&ageTo="+ageTo,
			function(data){
				if (data != "") {
					$(".stsearch:last").after(data);
					window.bSuppressScroll = false;
				}
				
				$('div#last_search_loader').empty();
				
			});
			//exit();
		};  
		
	//When you click on a link with class of poplight and the href starts with a # 
$('a.poplight[href^=#]').click(function() {
    var popID = $(this).attr('rel'); //Get Popup Name
    var popURL = $(this).attr('href'); //Get Popup href to define size

    //Pull Query & Variables from href URL
    var query= popURL.split('?');
    var dim= query[1].split('&');
    var popWidth = dim[0].split('=')[1]; //Gets the first query string value

    //Fade in the Popup and add close button
    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>');

    //Define margin for center alignment (vertical   horizontal) - we add 80px to the height/width to accomodate for the padding  and border width defined in the css
    var popMargTop = ($('#' + popID).height() + 80) / 2;
    var popMargLeft = ($('#' + popID).width() + 80) / 2;

    //Apply Margin to Popup
    $('#' + popID).css({
        'margin-top' : -popMargTop,
        'margin-left' : -popMargLeft
    });

    //Fade in Background
    $('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
    $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer - .css({'filter' : 'alpha(opacity=80)'}) is used to fix the IE Bug on fading transparencies 

    return false;
});


$('a.popphoto[href^=#]').click(function() {
    var popID = $(this).attr('rel'); //Get Popup Name
    var popURL = $(this).attr('href'); //Get Popup href to define size

    //Pull Query & Variables from href URL
    var query= popURL.split('?');
    var dim= query[1].split('&');
    var popWidth = dim[0].split('=')[1]; //Gets the first query string value

    //Fade in the Popup and add close button
    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>');

    //Define margin for center alignment (vertical   horizontal) - we add 80px to the height/width to accomodate for the padding  and border width defined in the css
    var popMargTop = ($('#' + popID).height() + 80) / 2;
    var popMargLeft = ($('#' + popID).width() + 80) / 2;

    //Apply Margin to Popup
    $('#' + popID).css({
        'margin-top' : -popMargTop,
        'margin-left' : -popMargLeft
    });

    //Fade in Background
    $('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
    $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer - .css({'filter' : 'alpha(opacity=80)'}) is used to fix the IE Bug on fading transparencies 

    return false;
});


//Close Popups and Fade Layer
$('a.close, #fade').live('click', function() { //When clicking on the close or fade layer...
    $('#fade , .popup_block').fadeOut(function() {
        $('#fade, a.close').remove();  //fade them both out
    });
    return false;
});

//Tab menu...
$(".tab_content").hide(); //Hide all content
$("ul.tabs li:first").addClass("active").show(); //Activate first tab
$(".tab_content:first").show(); //Show first tab content

//On Click Event
$("ul.tabs li").click(function() {

	$("ul.tabs li").removeClass("active"); //Remove any "active" class
	$(this).addClass("active"); //Add "active" class to selected tab
	$(".tab_content").hide(); //Hide all tab content

	var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
	$(activeTab).fadeIn(); //Fade in the active ID content
	return false;
});

// multiple Image Upload div toggle 
$('.imageOpen').live("click",function() 
{
$("#mulimgupload").slideToggle('slow');
return false;
});

// like for messages
		
$('.LikeThis').livequery("click",function(e){
	
var likeFor = $(this).attr('id').substr(0,7);
var getID   =  $(this).attr('id').replace(likeFor,'');
var dataString = 'postId=' + getID + '&postType=' + likeFor;
	
$("#like-loader-"+likeFor+"-"+getID).html('<img src="images/loader.gif" alt="" />');
	
$.ajax({
 type: "POST",
 url: "like_ajax.php",
 data: dataString,
 cache: false,
 success:function(response){
		$('#like-stats-'+likeFor+'-'+getID).html(response);		
		$('#like-panel-'+likeFor+'-'+getID).html('<a href="javascript: void(0)" id="'+likeFor+getID+'" class="Unlike">Unlike</a>');		
		$('#like-loader-'+likeFor+'-'+getID).html('');
	}	
  });
});	
		
// unlike 
		
$('.Unlike').livequery("click",function(e){
	
var likeFor = $(this).attr('id').substr(0,7);
var getID   =  $(this).attr('id').replace(likeFor,'');
var dataString = 'postId=' + getID + '&postType=' + likeFor;
	
$("#like-loader-"+likeFor+"-"+getID).html('<img src="images/loader.gif" alt="" />');
	
$.ajax({
 type: "POST",
 url: "unlike_ajax.php",
 data: dataString,
 cache: false, 
 success:function(response){
		$('#like-stats-'+likeFor+'-'+getID).html(response);
		$('#like-panel-'+likeFor+'-'+getID).html('<a href="javascript: void(0)" id="'+likeFor+getID+'" class="LikeThis">Like</a>');
		$('#like-loader-'+likeFor+'-'+getID).html('');
		}
	});
  });
  
//interested in profile 

$('.interestedInProfile').live("click",function(e){

var getID = $(this).attr('id');
var dataString = 'uID=' + getID;
	
$("#search-loader-"+getID).html('<img src="images/loader.gif" alt="" />');
	
$.ajax({
 type: "POST",
 url: "showinterest_ajax.php",
 data: dataString,
 cache: false, 
 success:function(response){
		$('#message-panel-'+getID).html('Interest Sent');
		$("#search-loader-"+getID).html(response);
		}
	});
});

//Adding 
/*$(document).ready(function(){*/
//});

/*jQuery(function($){

var ID = $(this).attr("id");
var comment= $("#ctextarea"+ID).val();

$(comment).Watermark("What's up?");
   });
 
$(function() 
{

$("#comment").focus(function()
{
$(this).animate({"height": "85px",}, "fast" );
$("#button_block").slideDown("fast");
return false;
});

$("#cancel").click(function()
{
$("#content").animate({"height": "30px",}, "fast" );
$("#button_block").slideUp("fast");
return false;
});

});*/

//jQuery("textarea[class*=expand]").TextAreaExpander();

});

// multiple image upload 
$(function()
{
	var btnUpload=$('#upload');
	var status=$('#status');
	new AjaxUpload(btnUpload, {
	action: 'upload_file_ajax.php',
	name: 'imagefile',
	onSubmit: function(file, ext)
	{
	 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
     // extension is not allowed 
	status.text('Only JPG, PNG or GIF files are allowed');
	return false;
	}status.text('Uploading...');
	},
	
	onComplete: function(file, response)
	{
		//On completion clear the status
		status.text('');
		//Add uploaded file to list
		var bb=response.substr(0,7)
		var idd=response.replace('success','');
		var idb =idd.replace(/^\s*|\s*$/g,'');
		if(bb==="success")
		{
			$('<span id='+idd+'></span>').appendTo('#files').html('<img src="'+idd+'" alt="" width="120" height="120" style="margin:5px;" /><br>').addClass('success');
		}
		else 
		{
			$('<span></span>').appendTo('#files').text(response).addClass('error');
		}
	}});
});

function deleteFile(id)
{
	var aurl="delete-file.php?imageid="+id;
	var result=$.ajax({
		type:"GET",
		data:"stuff=1",
		url:aurl,
		async:false
	}).responseText;
	if(result!="")
	{
		$("#"+id).load("index.php");	
	}
}

//expanding textarea function 
//(function($) {

	// jQuery plugin definition
	//$.fn.TextAreaExpander = function(minHeight, maxHeight) {

		//var hCheck = !($.browser.msie || $.browser.opera);

		// resize a textarea
		//function ResizeTextarea(e) {

			// event or initialize element?
			//e = e.target || e;

			// find content length and box width
			//var vlen = e.value.length, ewidth = e.offsetWidth;
			//if (vlen != e.valLength || ewidth != e.boxWidth) {

				//if (hCheck && (vlen < e.valLength || ewidth != e.boxWidth)) e.style.height = "0px";
				//var h = Math.max(e.expandMin, Math.min(e.scrollHeight, e.expandMax));

				//e.style.overflow = (e.scrollHeight > h ? "auto" : "hidden");
				//e.style.height = h + "px";

				//e.valLength = vlen;
				//e.boxWidth = ewidth;
			//}

			//return true;
		//};

		// initialize
		//this.each(function() {

			// is a textarea?
			//if (this.nodeName.toLowerCase() != "textarea") return;

			// set height restrictions
			//var p = this.className.match(/expand(\d+)\-*(\d+)*/i);
			//this.expandMin = minHeight || (p ? parseInt('0'+p[1], 10) : 0);
			//this.expandMax = maxHeight || (p ? parseInt('0'+p[2], 10) : 99999);

			// initial resize
			//ResizeTextarea(this);

			// zero vertical padding and add events
			//if (!this.Initialized) {
				//this.Initialized = true;
				//$(this).css("padding-top", 0).css("padding-bottom", 0);
				//$(this).bind("keyup", ResizeTextarea).bind("focus", ResizeTextarea);
			//}
		//});

		//return this;
	//};

//})(jQuery);