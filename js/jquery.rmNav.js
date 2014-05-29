
;(function($, window, document, undefined) {
    
    var rmNav = function (elem, options) {
        this.elem = this,
        this.$elem = $(elem);
        this.options = options;
        this.$win = $(window);
        this.numItems = this.$elem.find('li').length;
        this.$navContainer = $('#mainNav');
        this.$menuButton = $('#block-regiomino-menu-regiomino-menu-block').find('.menu-button');
    };
    
    rmNav.prototype = {
        
        defaults : {
            moreLinkClass : '.more',
            submenuColClass : '.submenu-col',
            moreLayout : 'more-list', // altern. 'more-list',
            moreChunks : 9,
            hoverTimeout :200
        },
        
        init : function() {
            var _self = this;
            _self.config = $.extend({}, _self.defaults, _self.options);
            _self.setEventHandlers();
        },
        
        resizer : function(){
            var _self = this;
            _self.resetMenu(); 
            _self.adjustMenu();
        },
        
        showDropdown : function() {
                $el = $(this);
                
            $el.addClass('active'); 
        },
        
        hideDropdown : function(){
            $(this).removeClass('active'); 
        },
        
        setEventHandlers:  function(){
            var _self = this;
             
            //resize
            
            _self.$menuButton.on('click.menuButton', function(){
                _self.$elem.toggleClass('active');
             
            });
            
            _self.$elem.on('click.touchButton','.touch-button', function(){
                $elParent = $(this).parent();
                _self.$elem.find('li').not($elParent).removeClass('active');
                $elParent.toggleClass('active');
             
            });
            
            $(window).on("resize.rm-nav", function() {
                var mobileMenu = (_self.$menuButton.css('display') === 'none')? false : true;
                
                if (mobileMenu) {
                    _self.resetMenu();
                    _self.$elem.find('li').off();
                }
                
                else {
                    _self.$elem.removeClass('active');
                    _self.$elem.find('li').removeClass('active');
                    _self.resizer();
                    _self.fitSubMenu();
                    _self.$elem.find('li').hoverIntent({
                        over: _self.showDropdown,
                        out: _self.hideDropdown,
                        timeout: _self.config.hoverTimeout,
                        
                    });
                }
            }).resize();
        },
        
        fitSubMenu : function(){
            var _self = this,
                wNav = _self.$navContainer.offset().left + _self.$navContainer.outerWidth(),
                $items = _self.$elem.find('li .submenu-wrapper');
  
            $items.each(function(){ 
                var $el =$(this),
                    wEl = $el.offset().left + $el.width();
                    
                if (wEl > wNav) {
                   
                    $el.addClass('right');
                }
                 
            });
        },
        
        reorderMoreCols : function($el){
            var _self = this;
            if(_self.config.moreLayout == 'more-column') { 
                $el.find('.submenu-col').each(function () {
                    $a = $(this);
                    $el.prepend($a);
                });
            }
        },
        
        resetMenu : function(){
            var _self = this;
            
            if (_self.$elem.find('.more').length == 0) { return false;}
            var $more = _self.$elem.find('li.more');
                
            if(_self.config.moreLayout == 'more-column') {
                var $cols = $more.find('.submenu-col');
                $cols.each(function(){
                    var $that = $(this),
                        $li = $('<li/>'),
                        $catItem = $that.find('a.category-item'),
                        numCols = parseInt($that.data('initialcols'),10);
                       
                    $li.append($catItem);
                      
                    if (numCols > 0) {
                       
                        var $items = $that.find('a').not('a.category-item'), 
                            chunks = parseInt($that.data('initialchunks'),10),   
                            $submenu = $('<div class="submenu-wrapper col-'+ numCols +' clearfix"> </div>').attr('data-cols',numCols).attr('data-chunks',chunks);
                            
                            
                        if (numCols == 1) {
                            var $subcol = $('<div/>', {
                                'class' : 'submenu-col'    
                            });
                            $subcol.append($items);
                            $submenu.append($subcol);
                        }
                        
                        else {
                             
                            for (var z = 0, itemsLength = $items.length; z < itemsLength; z += chunks) {
                                var $subcol = $('<div/>', {
                                    'class' : 'submenu-col'    
                                });
                                $subcol.append($items.slice(z,z + chunks));
                                $submenu.append($subcol);
                            }
                        }
                        
                        $li.append($submenu).addClass('wSub');
                    }
                    
                   _self.$elem.append($li);
                });
            }
            
            else if(_self.config.moreLayout == 'more-list') {
                var $categories = $more.find('a.category-item');
                    
                $categories.each(function(){
                    var $el = $(this),
                        $li = $('<li/>'),
                        name = $el.data('name'),
                        $childs = $more.find('a[data-parent="'+name+'"]'),
                        numChilds = $childs.length,
                        numCols = parseInt($el.data('initialcols'),10),
                        chunks = parseInt($el.data('initialchunks'),10);
                        
                    $li.append($el);
                    
                    if(numCols > 0) { 
                        $li.append('<span class="touch-button"></span>');
                    }
                    
                    if (numChilds > 0) {
                        var $submenu = $('<div class="submenu-wrapper col-'+ numCols +' clearfix"> </div>').attr('data-cols',numCols).attr('data-chunks',chunks);
                        for (var z = 0; z < numChilds; z += chunks) {
                                var $subcol = $('<div/>', {
                                    'class' : 'submenu-col'    
                                });
                                $subcol.append($childs.slice(z,z + chunks));
                                $submenu.append($subcol);
                                
                        }
                        $li.append($submenu).addClass('wSub');
                    } 
                     _self.$elem.append($li);
                   
                });
            }
            $more.remove();
       },
        
        adjustMenu : function() {
            var _self = this,
                $lastItemFirstRound = _self.$elem.find('li:last-child'),
                keeplooking = true,
                colsCounter = 0;

            if (_self.menuRequired($lastItemFirstRound)) {
                var $submenu = $('<div/>', {
                    'class' : 'submenu-wrapper '+_self.config.moreLayout
                });
                  
                for (var i = _self.numItems; i > 1; i--) {
                    
                    var $lastChild = (i == _self.numItems)? $lastItemFirstRound : _self.$elem.find('li:last-child'),
                        $catItem = $lastChild.find('.category-item'),
                        catName = $.trim($catItem.text()).replace(/ /g,'').toLowerCase(),
                        hasSub =  ($lastChild.find('.submenu-wrapper').length > 0)? true : false,
                        numCols = 0,
                        numChunks = 0,
                        keepLooking = _self.menuRequired($lastChild);
                   
                    if (hasSub) {
                        
                        var $subWrapper = $lastChild.find('.submenu-wrapper');
                        numCols = $subWrapper.data('cols');
                        numChunks = $subWrapper.data('chunks');
                    }
                     
                     if(_self.config.moreLayout == 'more-column') {
                            var $newCol = $('<div/>', {
                                'class' : 'submenu-col',
                                'data-initialchunks' : ''+numChunks+'' ,
                                'data-initialcols' : ''+numCols+''
                            });
                           
                            $newCol.append($catItem);
                        }
                        
                        else if (_self.config.moreLayout == 'more-list') {
                             $catItem.attr({
                                'data-initialchunks' : numChunks,
                                'data-initialcols': numCols,
                                'data-name' : catName
                             });
                                
                            $submenu.append($catItem);
                        }
                    
                    if (hasSub ) {
                        
                        if(_self.config.moreLayout == 'more-column') { 
                            $subWrapper.find('a').each(function(i){
                                $(this).appendTo($newCol);
                            });
                        }
                        else if(_self.config.moreLayout == 'more-list') {
                          
                             $subWrapper.find('a').each(function(i){
                                $(this).attr('data-parent',catName).appendTo($submenu);
                           
                            });
                        }
                    }
                    
                    if(_self.config.moreLayout == 'more-column') {
                        $submenu.append($newCol);
                    }
                   
                    $lastChild.remove();
                    
                    if (!keepLooking) {
                        break;
                    }
                }
                
                if(_self.config.moreLayout == 'more-list') {
                    
                    var $categories = $submenu.find('a.category-item');
                        $categories.each(function(){
                            var $parent = $(this),
                                name = $parent.data('name'),
                                $childs =  $submenu.find('a[data-parent="'+name+'"]'),
                                $family = $parent.add($childs);
                            $submenu.prepend($family);
                            });
                    var $anchors = $submenu.find('a');
                        
                    for (var z = 0, length = $anchors.length; z < length; z +=_self.config.moreChunks) {
                        var $newCol = $('<div/>', {
                            'class' : 'submenu-col',
                        });
                        
                        var $subset = $anchors.slice(z, z + _self.config.moreChunks);
                        
                        $subset.appendTo($newCol);
                        $newCol.appendTo($submenu);
                    }
                }
                
                var $more = _self.insertMoreLink();
                
                // check if more link got pushed down
                /*if (_self.menuRequired($more)) {
                    var $lastChild = _self.$elem.find('li:nth-last-child(2)'),
                        $catItem = $lastChild.find('.category-item'),
                        hasSub = ($lastChild.has('.submenu-wrapper'))? true : false,
                        numCols = 0,
                        numChunks = 0;
                    
                    if (hasSub) {
                        var $subWrapper = $lastChild.find('.submenu-wrapper');
                        numCols = $subWrapper.data('cols');
                        numChunks = $subWrapper.data('chunks');
                    }
                    
                    var $newCol = $('<div/>', {
                        'class' : 'submenu-col',
                        'data-initialchunks' : numChunks,
                        'data-initialcols' : numCols
                    });
                    
                    $newCol.append($catItem);
                        
                    if (hasSub) {
                        $subWrapper.find('a').each(function(i){
                            $(this).appendTo($newCol);
                        });
                    }
                    
                    $submenu.append($newCol);
                    
                    $lastChild.remove();
                }
                */
                _self.reorderMoreCols($submenu);
                var cols = $submenu.find('.submenu-col').length;
                var colClass = 'col-'+cols;
                $submenu.addClass(colClass);
                $more.append($submenu);
            }
            
            else {
                return false;
            }
        },
        
        menuRequired : function($item2Check){
            var _self = this,
                $firstItem = this.$elem.find('li:first-child'),
                firstItemHeight = Math.floor($firstItem.outerHeight(true)),
                firstItemTop = Math.floor($firstItem.offset().top),
                result = (Math.ceil($item2Check.offset().top) >= (firstItemTop + firstItemHeight)) ? true : false;
                       
                return result;
        },
        
        insertMoreLink : function() {
            var _self = this;
            _self.$elem.append('<li class="more wSub"><a class="more-link " href="#" > Mehr...</a> </li>');
            var $moreItem = _self.$elem.find('li.more');
            return $moreItem;
        },
        
    };
    
    rmNav.defaults = rmNav.prototype.defaults;

    $.fn.rmNav = function(options) {
             
            return this.each(function() {
                    new rmNav(this, options).init();
            });
    };
    
})(jQuery, window , document);  
    
    
    
    
    
    
    
    
  