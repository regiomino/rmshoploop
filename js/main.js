jQuery(document).ready(function($) {

 /*
 * Bewerben für Region im Popup
 */
 
	$('#region-request').click(function() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(geolocationSuccessFunction, geolocationErrorFunction);
		}
		return false;
	});
	
	function geolocationSuccessFunction(position) {
		var data = new Object;
		data['lat'] = position.coords.latitude;
		data['lng'] = position.coords.longitude;
		data['time'] = position.timestamp;
		var callback_url = Drupal.settings.basePath + 'region-request';
		$.ajax({
			url: callback_url,
			type: 'POST',
			data: data,
		});
		alert('Vielen Dank für Ihr Interesse an Regiomino. Wir haben Ihren Standort gespeichert und werden alle Anstrengungen unternehmen um bald auch Produkte aus Ihrer Region anbieten zu können.');
	}
	
	function geolocationErrorFunction() {
		alert('Bitte erlauben Sie Ihrem Browser Ihren Standort freizugeben');
	}

 /*
 * erstes Element im User Menu entfernen
 */
 $("#block-system-user-menu").find('li.first').remove();
 
$.fn.debounce = function(func, wait, immediate) {
     
    var timeout;
    return function() {
            var context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
            }, wait);
            if (immediate && !timeout) func.apply(context, args);
    };
};

$.fn.getViewportArea = function() {
    
    var vp = $.fn.viewport();
    
    if( vp.width >= 960 && vp.width <= 1119 ) {
        return "large";
    }
    
    else if( vp.width >= 768 && vp.width  <= 959 ) {
        
        return "tabletp";
    }
    
    else if( vp.width >= 480 && vp.width <= 767 ) {
        return "mobilels";
    }
    
    else if(vp.width <= 479) {
        return "mobilep"
    }
    
    else {
        return "superlarge";
    }
}

$.fn.viewport =function () {
    var e = window, a = 'inner';
    if (!('innerWidth' in window )) {
        a = 'client';
        e = document.documentElement || document.body;
    }
    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
}
 
 
    
}); 

 