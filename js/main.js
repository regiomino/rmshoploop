jQuery(document).ready(function($) {

	$('#messages').fancybox();

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

 