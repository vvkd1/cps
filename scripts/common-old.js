

$(document).ready(function(){
	sizeChangeCallback();
	$("#txt_search").autocomplete("a_msearch.php", {
		width: 190, max: 8, highlight: false, scroll: true,
		//width: 230, highlight: false, scroll: true,
		scrollHeight: 300, formatItem: function(data, i, n, value) {
			return '<img src="' + value.split("::")[1] + '" align="left" class="rgtmargin" /><span style="padding-left:5px;">' + 
			value.split("::")[0] + ' ('+value.split("::")[7]+')</span><br />';
		},
		formatResult: function(data, value) {
			return value.split("::")[0];
		}
	});
	$("#txt_search").result(function(event, data, formatted) {	
		$("#txt_movie_id").val(formatted.split("::")[6]);		
	});			
	add_autocomplete();
	$(".add_auto").click(function(){
		add_autocomplete();
	});
	$(".remove_auto").click(function(){
		$(":input").unautocomplete();
	});
	
	$(".invite_frnd").click(function(){	
		var app_id = $(this).attr("rel");
		FB.init({appId: app_id, status: true, cookie: true,xfbml: true});
			var userObj='yes';			
			if(userObj=='yes'){
				FB.login(function(response) {
				  if (response.session) {
					if (response.perms) {					
						//FB.Canvas.scrollTo(0,0);
						FB.api('/me', function(response) {
							$("#loggedin_userid").val(response.id);
							$("#loggedin_email").val(response.email);
							$("#loggedin_location").val(response.location.name);
							$("#loggedin_username").val(response.name);
							
							 // alert ("Welcome " + response.email + ": Your UID is " + response.id); 
						 });	
						
						FbRequest('I just voted for my favorite Movie in flicboxing. Join me in making a difference, vote today!','4d5da07acbbb0');
					} else {			
		
					}
			
				  }else{
		
				  }
			   }, {perms:'publish_stream,user_location,email'});
			}else{
		
			}	
	});	
	
});
function FbRequest(message, data){
		FB.ui({method:'apprequests',message:message,data:data,title:'Share this site with your friends'},
				function(response){
						/*
						alert("Data to be submitted.");
						alert("Logged in user value "+ response.request_ids);
						// response.request_ids holds an array of user ids that received the request
						$.ajax({type: "POST", url: "post_invite.php", dataType: 'json', data: {"do":"add_invite", "uids": response.request_ids, "user_id":$("#loggedin_userid").val() },
							success: function(resObj, statusText) {
								if(resObj.status) {				
									alert("User ids stored.");
									return true;			
								} else {
									alert("Error.");
									return true;
								}
							}
						});
						*/
				}
		);
}
function add_autocomplete() {
	$("#txt_search_big").autocomplete("a_msearch.php", {
		width: 475, max: 8, highlight: false, scroll: true,
		//width: 230, highlight: false, scroll: true,
		scrollHeight: 300, formatItem: function(data, i, n, value) {
			return '<img src="' + value.split("::")[1] + '" align="left" class="rgtmargin" /><span style="padding-left:5px;">' + 
			value.split("::")[0] + ' ('+value.split("::")[7]+')</span><br />';
		},
		formatResult: function(data, value) {
			return value.split("::")[0];
		}
	});
	$("#txt_search_big").result(function(event, data, formatted) {	
		$("#txt_movie_id").val(formatted.split("::")[6]);		
	});
}
function shareFacebook(){	
	var p = popitup('share.php?rtype=fb', 'Facebook_Share');
	return false;
}
function popitup(url, title) {
	//var left   = (screen.width  - width)/2;
	//var top    = (screen.height - height)/2;
	 var width  = 550;
	 var height = 300;
	 var left   = (screen.width  - width)/2;
	 var top    = (screen.height - height)/2;
	 var params = 'width='+width+', height='+height;
	 params += ', top='+top+', left='+left;
	 params += ', directories=no';
	 params += ', location=no';
	 params += ', menubar=no';
	 params += ', resizable=yes';
	 params += ', scrollbars=yes';
	 params += ', status=no';
	 params += ', toolbar=no';
	newwindow=window.open(url,title,params);
	//if (window.focus) { newwindow.focus() }
	 newwindow.focus();
	return false;
} 