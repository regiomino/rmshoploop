jQuery(document).ready(function($) {
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