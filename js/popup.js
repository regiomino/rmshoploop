jQuery(document).ready(function($) {

  $('#tabContent').royalSlider({
   autoHeight: true,
    arrowsNav: false,
    fadeinLoadedSlide: true,
    controlNavigationSpacing: 0,
    controlNavigation: 'tabs',
    imageScaleMode: 'none',
    imageAlignCenter:false,
    loop: false,
    loopRewind: true,
    numImagesToPreload: 1,
    keyboardNavEnabled: true,
    usePreloader: true,
    sliderDrag : true,
    navigateByClick : false,
  });
  
   var slider = $('#tabContent');
    slider.before(slider.find('.rsNav'));

/*
 * Pop-up
 */
   /* $('.popup-tabs').fitVids();
    $('.popup-tabs').rmtabs();
    
    */
    }); 