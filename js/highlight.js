jQuery(document).ready(function($) {
    console.info($('#highlight .image-slide').length);
    if ($('#highlight .image-slide').length > 0) { 
        $('#highlight').royalSlider({
            autoHeight: true,
            arrowsNav: true,
            fadeinLoadedSlide: true,
            controlNavigationSpacing: 0,
            controlNavigation: 'bullets',
            imageScaleMode: 'none',
            imageAlignCenter:false,
            loopRewind: true,
            numImagesToPreload: 1,
            usePreloader: true,
            arrowsNavHideOnTouch : true,
            keyboardNavEnabled: true,
            controlsInside : false,
            autoPlay: {
    		enabled: true,
    		pauseOnHover: true,
                delay :	6000,
                stopAtAction : false
            }
        });
    }
    
    
}); 