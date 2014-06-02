jQuery(document).ready(function($) {
   $('.product-grid .image img').unveil(200, function(){
         $(this).load(function() {
            $(this).parents('.preloaded').removeClass('preloaded');
            
         });
    
    }); 
    $('.cart').add('.touch-cart').ajaxcart();
    
/*
 * Product Grid Hover
 */
 
    if(!Modernizr.touch) {
        
        if(!Modernizr.opacity) {
            $('.hover_buttons').css({
                opacity : 0
            })
        }
        
        $('ul.product-grid li').hover(
              
            function(){
                $(this).find('.image').stop().animate({
                    opacity : '0.4'
                },150, function(){
                    var $hoverButtons = $(this).parent().find('.hover_buttons');
                    $hoverButtons.stop().animate({
                        opacity  : '1',
                        marginTop  : '-19px'
                    },200); 
                });
            },
            
            function(){
                $(this).find('.image').stop().animate({
                    opacity : '1'
                },200,function(){
                    var $hoverButtons = $(this).parent().find('.hover_buttons');
                    $hoverButtons.stop().animate({
                              opacity  : '0',
                              marginTop  : '0px'
                    },350);
                });
            }
        );
    }
    
    
});