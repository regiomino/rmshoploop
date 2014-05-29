;(function($){
    
    $.fn.rmtabs = function(options) {
        var settings = {};
        
        if (options) {
            $.extend({}, settings, options);
        }
        
        return this.each(function(i) {
            
            var $that = $(this),
                $tabDivs = $that.find('.tabContent >div'),
                $tabNavLinks = $that.find('.tabNav li a');
                
            $tabDivs.hide().filter(':first').show();
            $tabNavLinks.on('click', function(e) {
                var $el = $(this);
                e.preventDefault();
                $tabDivs.hide();
                $tabDivs.filter(this.hash).fadeIn(300);
                $tabNavLinks.removeClass('currentTab');
                $el.addClass('currentTab');
            });
        });
    }
})(jQuery);
 