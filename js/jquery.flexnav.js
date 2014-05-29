(function($) {
//martin was here
  $.fn.flexNav = function(options) {
    
    var $nav = $(this),
        $menuButton = $('#block-regiomino-menu-regiomino-menu-block').find('.menu-button'),
        adjustMenu,
        mobileMenu,
        count,
        nav_percent,
        nav_width,
        resetMenu,
        resizer,
        settings,
        showMenu,
        toggle_selector,
        touch_selector;

    settings = $.extend({
        'animationSpeed': 250,
        'transitionOpacity': true,
        'buttonSelector': '.menu-button',
        'hoverIntent': false,
        'hoverIntentTimeout': 150,
        'calcItemWidths': false,
        'hover': true
    }, options);
 
    if (settings.transitionOpacity === true) {
        $nav.addClass('opacity');
    }
    
    $nav.find("li").each(function() {
        if ($(this).has("ul").length) {
            return $(this).addClass("item-with-ul").find("ul").hide();
        }
    });
    
    
    
    adjustMenu = function(reset){
  
        var $firstItem = $nav.find('li:first-child'),
            $lastItem = $nav.find('>li:last-child'),
            numItems = $nav.find('li').length,
            firstItemTop = Math.floor($firstItem.offset().top),
            firstItemHeight = Math.floor($firstItem.outerHeight(true)),
            keepLooking;
            
         var needsMenu = function($itemOfInterest) {
            var result = (Math.ceil($itemOfInterest.offset().top) >= (firstItemTop + firstItemHeight)) ? true : false;
            return result;
         }
        
        if ( needsMenu($lastItem) && !reset ) {
            
            var $sublist = $('<ul class="submenu flex"> </ul>');
            
            for (i = numItems; i > 1; i--) {
                $lastChild = $nav.find('>li:last-child');
                keepLooking = (needsMenu($lastChild));
                $lastChild.appendTo($sublist);
                
                if (!keepLooking) {
                    break;
                }
            }
        
            $nav.append('<li class="item-with-ul more"><a href="#" > Mehr...</a></li>');
            $moreItem = $nav.find('li.more');
            
            if (needsMenu($moreItem)) {
                 
                $nav.find('li:nth-last-child(2)').appendTo($sublist);
            }
            $sublist.children().each(function (i, li) {
                    $sublist.prepend(li);
            });
            
            $moreItem.append($sublist);
        }
        
        else if ($nav.find('ul.flex') && reset) {
             
            $menu = $nav.find('ul.flex');
            numToRemove = $menu.find('>li').length;
            for (i = 1; i <= numToRemove; i++) {
                    $menu.find('>li:first-child').appendTo($nav);
            }
            $menu.remove();
            $nav.find('.more').remove();
         }
      
    },
    
    
    showMenu = function() {
        
      if ($nav.hasClass('lg-screen') === true && settings.hover === true) {
        if (settings.transitionOpacity === true) {
          return $(this).find('>ul').addClass('flexnav-show').stop(true, true).animate({
            height: ["toggle", "swing"],
            opacity: "toggle"
          }, settings.animationSpeed);
        } else {
          return $(this).find('>ul').addClass('flexnav-show').stop(true, true).animate({
            height: ["toggle", "swing"]
          }, settings.animationSpeed);
        }
      }
    };
    resetMenu = function() {
      if ($nav.hasClass('lg-screen') === true && $(this).find('>ul').hasClass('flexnav-show') === true && settings.hover === true) {
        if (settings.transitionOpacity === true) {
          return $(this).find('>ul').removeClass('flexnav-show').stop(true, true).animate({
            height: ["toggle", "swing"],
            opacity: "toggle"
          }, settings.animationSpeed);
        } else {
          return $(this).find('>ul').removeClass('flexnav-show').stop(true, true).animate({
            height: ["toggle", "swing"]
          }, settings.animationSpeed);
        }
      }
    };
    resizer = function() {
       
        var selector;
        
        mobileMenu = ($menuButton.css('display') === 'none')? false : true;
        
        
        if (mobileMenu) {
           
            if($nav.find('ul.flex')) {
                var  $menu = $nav.find('ul.flex');
                var numToAdd = $menu.find('>li').length;
                
                for (var i = 1; i <= numToAdd; i++) {
                    $menu.find('>li:first-child').appendTo($nav);
            }
            $menu.remove();
            $nav.find('.more').remove();
            }
            $nav.removeClass("lg-screen").addClass("sm-screen");
            
            selector = settings['buttonSelector'] + ', ' + settings['buttonSelector'] + ' .touch-button';
            $(selector).removeClass('active');
            
        
        }
        else {
            
            //adjustMenu(true);
            adjustMenu(false);
    
            $nav.removeClass("sm-screen").addClass("lg-screen");
        
            $nav.removeClass('flexnav-show').find('.item-with-ul').on();
            
            
            $('.item-with-ul').find('ul').removeClass('flexnav-show').hide();
            resetMenu();
            if (settings.hoverIntent === true ) {
              return $('.item-with-ul',$nav).hoverIntent({
                over: showMenu,
                out: resetMenu,
                timeout: settings.hoverIntentTimeout
              });
            
            } else if (settings.hoverIntent === false ) {
                $('.item-with-ul').unbind('mouseenter').unbind('mouseleave');
              return $('.item-with-ul',$nav).on('mouseenter', showMenu).on('mouseleave', resetMenu);
            }
            
           
        } 
    };
    
    $(settings['buttonSelector']).data('navEl', $nav);
    
    touch_selector = '.item-with-ul, ' + settings['buttonSelector'];
    $(touch_selector).append('<span class="touch-button"></span>');
    
    //menu button
    
    toggle_selector = settings['buttonSelector'] + ', ' + settings['buttonSelector'] + ' .touch-button';
    
    $(toggle_selector).on('click', function(e) {
        var $btnParent, $thisNav, bs;
        $(toggle_selector).toggleClass('active');
        e.preventDefault();
        e.stopPropagation();
        bs = settings['buttonSelector'];
        $btnParent = $(this).is(bs) ? $(this) : $(this).parent(bs);
        $thisNav = $btnParent.data('navEl');
        return $thisNav.toggleClass('flexnav-show');
    });
    
    //touch button
    
    $('.touch-button').on('click', function(e) {
        var $sub, $touchButton;
        $sub = $(this).parent('.item-with-ul').find('>ul');
        $touchButton = $(this).parent('.item-with-ul').find('>span.touch-button');
        
        if ($nav.hasClass('lg-screen') === true) {
            $(this).parent('.item-with-ul').siblings().find('ul.flexnav-show').removeClass('flexnav-show').hide();
        }
        
        if ($sub.hasClass('flexnav-show') === true) {
            $sub.removeClass('flexnav-show').slideUp(settings.animationSpeed);
            return $touchButton.removeClass('active');
        }
        
        else if ($sub.hasClass('flexnav-show') === false) {
            $sub.addClass('flexnav-show').slideDown(settings.animationSpeed);
            return $touchButton.addClass('active');
        }
    });
    
    $nav.find('.item-with-ul *').focus(function() {
      $(this).parent('.item-with-ul').parent().find(".open").not(this).removeClass("open").hide();
      return $(this).parent('.item-with-ul').find('>ul').addClass("open").show();
    });
    resizer();
   return $(window).on('resize', resizer);
  };

})(jQuery);
