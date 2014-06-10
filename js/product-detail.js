jQuery(document).ready(function($) {
    /*
 * Productdetail
 */ 
 
 
 
    $('#edit-submit--4').on('click', function(e){
        e.preventDefault();
        
        var $this = $(this),
            $confirmContainer = $('#add2CartConfirm'),
            productID = $('.title', $confirmContainer).data('id'),
            selectedQty = parseInt($('#edit-qty option:selected').attr('value'),10),
            selectedInterval = parseInt($('#edit-frequency option:selected').attr('value'),10),
            selectedDetailsText = $('#edit-qty option:selected').text() + ", ",
            $loaderDiv = $('<div/>', {
                'class' : 'loader'
            }),
            data = new Object,
            oriTxt = $this.attr('value'),
            callback_url = Drupal.settings.basePath + 'addtocart';
            
            $this.parent().append($loaderDiv);
            $this.attr({
                value : 'Lade...',
                disabled : 'disabled'
            });
            
            selectedDetailsText += $('#edit-frequency option:selected').text();
            $('.selected-details',$confirmContainer).text(selectedDetailsText);
            
            data['nid'] = productID;
            data['qty'] = selectedQty;
            data['frq'] =  selectedInterval;
            
        $.ajax({
                    url: callback_url,
                    type: 'POST',
                    data: data,
                    success: function (data, textStatus, jqXHR) {
                    },
                    
                    error: function (http) {
                    },
                    
                    complete: function() {
                        $this.attr('value', oriTxt);
                        $this.removeAttr('disabled');
                        $this.parent().find('.loader').remove();
                         $.fancybox.open($confirmContainer);
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
    
    $('#add2CartConfirm .close').click(function(e) {
        e.preventDefault();
         $.fancybox.close();
    });
    
    
      
        
var $moveableSource = $('#moveableSource');
var $moveableTarget = $('#moveableTarget');
var ratio = 1200 / 896;
var activeArea = null;
var etalage = null;
var moreThanOne = ( $('#etalage').find('li').length > 1 ) ? true : false;
var alignment = (moreThanOne)? 'left' : 'bottom';
var mobileImageW = (moreThanOne) ?  225 : 300;
var mobileImageH = mobileImageW / ratio;
var timeout;
var windowSize = $.fn.viewport();
var etalageSettings = {
    
    superlarge : {
        thumb_image_width: 658,
        thumb_image_height: 494,
        zoom_area_width: 400,
        zoom_area_height: 651,
        source_image_width: 1200,
        source_image_height: 896,
        zoom_area_distance: 20,
        small_thumbs: 4,
        smallthumbs_position:'bottom',
        zoom_easing: true,
        click_to_zoom: false,
        smallthumb_inactive_opacity: 0.6,
        click_callback: function(image_anchor, instance_id){
            $.fancybox({
                href: image_anchor
            });
        }
    },
    
    large : {
        thumb_image_width: 558,
        thumb_image_height: 419,
        zoom_area_width: 340,
        zoom_area_height: 558,
        source_image_width: 1200,
        source_image_height: 896,
        zoom_area_distance: 20,
        small_thumbs: 4,
        smallthumbs_position:'bottom',
        zoom_easing: true,
        click_to_zoom: false,
        smallthumb_inactive_opacity: 0.6,
        click_callback: function(image_anchor, instance_id){
            $.fancybox({
                href: image_anchor
            });
        }
    },
    
    tabletp : {
        thumb_image_width: 438,
        thumb_image_height: 329,
        zoom_area_width: 327,
        zoom_element : '#zoom',
        zoom_area_height: 580,
        source_image_width: 1200,
        source_image_height: 896,
        zoom_area_distance: 18,
        small_thumbs: 4,
        smallthumbs_position:'bottom',
        zoom_easing: true,
        click_to_zoom: false,
        magnifier_opacity: 1,
        smallthumb_inactive_opacity: 0.6,
        click_callback: function(image_anchor, instance_id){
            $.fancybox({
                href: image_anchor
            });
        }
    },
    
    mobilels : {
        thumb_image_width: 398,
        thumb_image_height : 297,
        zoom_area_width: 340,
        zoom_element : '#zoom',
        zoom_area_height: 580,
        source_image_width: 1200,
        source_image_height: 896,
        zoom_area_distance: 18,
        small_thumbs: 4,
        smallthumbs_position:'bottom',
        zoom_easing: true,
        click_to_zoom: false,
        autoplay : false,
        magnifier_opacity: 1,
        smallthumb_inactive_opacity: 0.6,
        click_callback: function(image_anchor, instance_id){
            $.fancybox({
                href: image_anchor
            });
        }
    },
    
    mobilep : {
        thumb_image_width: mobileImageW,
        thumb_image_height :mobileImageH, 
        zoom_element : '#zoom',
        zoom_area_width: 340,
        zoom_area_height: 495,
        source_image_width: 1200,
        source_image_height: 896,
        zoom_area_distance: 18,
        autoplay:false,
        small_thumbs: 2,
        smallthumbs_position: alignment,
        zoom_easing: true,
        click_to_zoom: false,
        magnifier_opacity: 1,
        smallthumb_inactive_opacity: 0.6,
        click_callback: function(image_anchor, instance_id){
            $.fancybox({
                href: image_anchor,
            });
        }
    }

};

  if(windowSize.width >= 960 && windowSize.width <= 1119  ) {
        activeArea = "large";
        etalage = $('#etalage').etalage(etalageSettings.large);
    
    } else if (windowSize.width >= 768 && windowSize.width <=959  ) {
        activeArea = "tabletp";
        etalage = $('#etalage').etalage(etalageSettings.tabletp);
    
    } else if (windowSize.width >= 480 && windowSize.width <= 767) {
        activeArea = "mobilels";
        etalage =  $('#etalage').etalage(etalageSettings.mobilels);
    }
        
    else if (windowSize.width <= 479) {
        activeArea = "mobilep";
        etalage =  $('#etalage').etalage(etalageSettings.mobilep);
    }
        
    else { 
        activeArea = "superlarge";
        etalage =   $('#etalage').etalage(etalageSettings.superlarge);
    }
   
    if ($('#etalage').length) { 
        $(window).on('resize.etalage',$.fn.debounce(function(){
           var size = $.fn.getViewportArea();
           if(size !== activeArea) {
                activeArea = size;
                etalage.reload(etalageSettings[activeArea]);
           }
        },1500));
    }
        
  
    $(window).on('resize.rearrange', function(){
        
       var size = $.fn.viewport();
       var $rows = $moveableSource.find('.row');
       var $i;
       var numRows = $rows.length;
       
       if ( size.width <= 766 ) {
            
            if (numRows > 1) {
                $rows.not(':first').each(function () {
                    $i = $(this).detach();
                    $i.appendTo($moveableTarget);
                }); 
            }
            
       } else {
        
            $moveableTarget.find('.row').not(':first').each(function(){
                $i = $(this).detach();
                $i.appendTo($moveableSource);
            });  
       }
    }).resize();
    
    
 /*
 * Tabs
 */
 
 $('#tabs').rmtabs();
     
}); 