jQuery(document).ready(function($) {
    
    $('.fancybox').fancybox();
		
		var myLatlng = new google.maps.LatLng(Drupal.settings.COMMERCIAL_PROFILE_LAT, Drupal.settings.COMMERCIAL_PROFILE_LON);
		var map = new google.maps.Map(document.getElementById("commercial-map"), {
			center: myLatlng,
			zoom: 14,
			mapTypeId: 'roadmap'
		});
		
		var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
		});
    
});