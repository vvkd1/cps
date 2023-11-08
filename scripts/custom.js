jQuery(document).ready( function () {	
	jQuery('#slider-imgs').cycle({ 
		fx:     'fade', 
		timeout: 5000, 
		pager:  '#slider-controls' 
	});
	

});
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