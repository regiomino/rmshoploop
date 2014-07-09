jQuery(document).ready(function($) {
    
    $('.fancybox').fancybox();
		
		var myLatlng = new google.maps.LatLng(Drupal.settings.SELLER_PROFILE_LAT, Drupal.settings.SELLER_PROFILE_LON);
		var map = new google.maps.Map(document.getElementById("seller-map"), {
			center: myLatlng,
			zoom: 14,
			mapTypeId: 'roadmap'
		});
		
		var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
		});
		
/*
 * Tooltip
 */

    $('.richtooltip').each(function() {
        
            $(this).tooltipster({
            content: $('.tooltip', this).html(),
            contentAsHTML : true,
            interactive:false,
            position: 'right',
            theme : 'rm-light',
            onlyOne : true,
            maxWidth : 210,
            offsetX : -12,
            iconTouch : false,
            animation: 'fade',
            touchDevices : false,
            });
    });
    
    
});