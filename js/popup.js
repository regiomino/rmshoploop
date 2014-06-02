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
    video : { 
        youTubeCode : '<iframe src="https://www.youtube.com/embed/%id%?rel=0&autoplay=1&showinfo=0" frameborder="no"></iframe>'
    }
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