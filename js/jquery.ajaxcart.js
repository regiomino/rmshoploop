;(function($) {
    
    $.fn.ajaxcart = function (options) {
        
        var settings = {
            loaderColor : 'white',
            singleClick : true
        };
        
        if (options) {
            $.extend({}, settings, options);
        }
        
        return this.each(function(){
            
            var $that = $(this);
            
            $that.on('click', function(e){
                e.preventDefault();
                
                if (settings.singleClick) {
                    if( $that.hasClass('confirm')) {
                        return false;
                    }
                }
                
                $loading = $that.find('.loading'),
                data = new Object,
                callback_url = Drupal.settings.basePath + 'addtocart';
                
                data['nid'] = $that.attr('data-id');
                data['qty'] = 1;
                
                $that.addClass('hide-icon');     
                
                $.ajax({
                    url: callback_url,
                    type: 'POST',
                    data: data,
                    success: function (data, textStatus, jqXHR) {
                    },
                    
                    error: function (http) {
                    },
                    
                    complete: function() {
                   
                        //Der Loader wird wieder versteckt
                        $that.removeClass('hide-icon');
                        $that.addClass('confirm');
                        /*clearTimeout(timeout);
                        var timeout = setTimeout( function(){
                            $that.removeClass('confirm');
                            $that.blur();
                        },1000);*/
                        //Die Anzahl im Warenkorb-Block wird aktualisiert
                        var new_url = Drupal.settings.basePath + 'getcartblocktext';
                        var new_data = new Object;
                        $.ajax({
                            url: new_url,
                            type: 'POST',
                            data: new_data,
                            success: function (data, textStatus, jqXHR) {
                                    $('#block-regiomino-cart-regiomino-cart-block .carttext .sum').html(data);
                            },
                            error: function (http) {
                                   
                            },
                            complete: function() {
                            }
                        });
                    }
                });
            });
            
        });
    };
    
})(jQuery);