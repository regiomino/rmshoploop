(function($){
    
/*
 * Liste / Dropdown Startseite
 */
    $(".home_news div").hide();
  
    $(".home_news h3").click(function(){
            $(this).next("div").slideToggle("fast").siblings("div:visible").slideUp("fast");
            $(this).toggleClass("active");
            $(this).siblings("h3").removeClass("active");
    });
    
})(jQuery);