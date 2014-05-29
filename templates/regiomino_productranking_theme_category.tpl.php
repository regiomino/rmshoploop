
<div class="four columns">
    <div class="row">
        <div class="subcategories filter">
            <h3 data-id="1"> <?php echo t('filter by @filtername', array('@filtername' => t('Categories'))); ?></h3>
            <div class="list-wrapper">
                <ul>
                <?php if(isset($vars['subcatitems']) && !empty($vars['subcatitems'])):
                    foreach($vars['subcatitems'] as $childid=>$childinfo): ?>
                        <li class="filteritem<?php if($childinfo['active']) echo ' selected'; ?>" id="tid<?php echo $childid; ?>" data-filter=".tid<?php echo $childid; ?>"> <a href="<?php if($childinfo['active']) { echo $childinfo['removelink']; } else { echo $childinfo['link']; } ?>"> <?php if(mb_strlen($childinfo['name']) > 29)#
                        { echo mb_substr($childinfo['name'], 0, 29) . '...'; } else { echo $childinfo['name']; } ?> <span>(<?php echo $childinfo['amount']; ?>)</span></a></li>
                <?php endforeach; endif; ?>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="labels filter">
            <h3 data-id="2"><?php echo t('filter by @filtername', array('@filtername' => t('Quality labels'))); ?></h3>
            <div class="list-wrapper">
                <?php if(isset($vars['qualitylabels']) && !empty($vars['qualitylabels'])): ?>
                    <ul>
                        <?php foreach($vars['qualitylabels'] as $labelid=>$labelinfo): ?>
                            <li class="filteritem<?php if($labelinfo->selected) echo ' selected'; ?>" id="tid<?php echo $labelid; ?>" data-filter=".label<?php echo $labelid; ?>"><a href="<?php if($labelinfo->selected) { echo $labelinfo->removelink; } else { echo $labelinfo->link; } ?>"><img src="<?php echo image_style_url('minilabel', $labelinfo->field_image[LANGUAGE_NONE][0]['uri']); ?>"
                                    title="<?php echo $labelinfo->title; ?>" alt="<?php echo $labelinfo->title; ?>"><span class="label-icon"></span>
                                    <span class="labeltext"><?php echo $labelinfo->title; ?></span>
                                    </a>
                                   
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else:   ?>
                    <span class="empty"> <?php echo t("Keine Gütesiegel für diese Auswahl");?></span>
                <?php endif;  ?>
            </div>
        </div>
    </div>
   
        <div class="row">
            <div class="sellers filter">
                <h3 data-id="3"><?php echo t('filter by @filtername', array('@filtername' => t('Seller'))); ?></h3>
                <div class="list-wrapper">
                    <?php if(isset($vars['sellers']) && !empty($vars['sellers'])): ?>
                    <ul>
                        <?php foreach($vars['sellers'] as $sellerid=>$sellerinfo): ?>
                            <li class="filteritem<?php if($sellerinfo['active']) echo ' selected'; ?>" id="sid<?php echo $sellerid; ?>" data-filter=".sid<?php echo $sellerid; ?>"><a href="<?php if($sellerinfo['active']) { echo $sellerinfo['removelink']; } else { echo $sellerinfo['link']; } ?>"><?php if(mb_strlen($sellerinfo['name']) > 29)
                            { echo mb_substr($sellerinfo['name'], 0, 29) . '...'; } else { echo $sellerinfo['name']; } ?><span> (<?php echo $sellerinfo['amount']; ?>)</span></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php else:  ?>
                        <span class="empty"> <?php echo t("Keine Verkäufer für diese Auswahl");?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    
</div>

<div class="twelve columns">
    
    <div class="row mobile-hidden">
       <!-- <div class="slider-wrapper">
            <div class="slider">
                <div class="pagers center clearfix">
                        <a class="slide-prev" rel="Prev"  href="#prev"></a>
                        <a class="slide-nxt" rel="Next" href="#nxt"></a>
                </div>
    
                <ul class="cycle-slideshow clearfix"
                    data-cycle-fx="scrollHorz"
                    data-cycle-timeout="8000"
                    data-cycle-slides="> li"
                    data-cycle-prev="div.pagers a.slide-prev"
                    data-cycle-next="div.pagers a.slide-nxt"
                >
                    <li>
                        
                            <img src="<?php echo base_path() . path_to_theme();?>/images/test/category_dummy.jpg">
                        
                    </li>
                    <li>
                        
                             <img src="<?php echo base_path() . path_to_theme();?>/images/test/category_dummy2.jpg">
                         
                    </li>
                </ul>
            </div>
        </div>-->
    </div>
    
    <div class="row">
        <ul class="product-grid product-grid-12">
            <?php if(isset($vars['offers']) && !empty($vars['offers'])):
            
                foreach($vars['offers'] as $productkey=>$productinfo):
                    $reduziert = false;
                    //Ermitteln ob Produkt rabattiert ist
                    if($productinfo->discountedprice != $productinfo->originalprice) {
                            $reduziert = true;
                    }
            ?>
              
                    <li class="clearfix column richtooltip">
                        <div class="img">
                            <?php if ($reduziert): ?>
                                <div class="ribbon-green"></div>
                            <?php endif; ?>
                                
                            <a class="image" href="<?php echo url('node/' . $productinfo->nid); ?>">
                                <img src="<?php echo image_style_url('productgrid_twelve', $productinfo->field_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php echo t("Image of product @imagetitle", array('@imagetitle' => $productinfo->title)); ?>">
                            </a>
                            
                                <div class="hover_buttons"> 
                                    <a class="link" href="<?php echo url('node/' . $productinfo->nid); ?>"> </a>
                                    <?php if(!empty($productinfo->shipping['begin']) && $productinfo->availableforselection): ?>
                                    <a class="cart" data-id="<?php echo $productinfo->nid;?>" href="#">
                                        <span class="loading"> </span>
                                    </a>
                                    <?php else: ?>
                                        <span class="cart disabled">
                                        </span>
                                    <?php endif;?>
                                </div>
                        </div>
                        
                        <h6>
                            <a href="<?php echo url('node/' . $productinfo->nid);?>" title="<?php echo $productinfo->title;?>" >
                                <?php echo mb_substr($productinfo->title, 0, 40); ?>
                                <?php if(mb_strlen($productinfo->title) > 40): ?>...<?php endif; ?>
                            </a>
                        </h6>
                        
                        <h5>
                            <?php echo number_format($productinfo->discountedprice, 2, ",", "."); ?> &euro; /
                            <?php echo $productinfo->field_packingunit[LANGUAGE_NONE][0]['first']; ?>
                            <?php echo t($productinfo->field_packingunit[LANGUAGE_NONE][0]['second']); ?>
                        </h5>
                        <p class="baseprice">
                            <?php echo ($productinfo->baseprice); ?>
                        </p>
                        
                        <div class="touch-button-wrapper">
                            <!--<a class="touch-button touch-link" href="<?php echo url('node/' . $productinfo->nid); ?>">  </a>-->
                            <?php if(!empty($productinfo->shipping['begin']) || $productinfo->availableforselection): ?>
                            <a href="" class="touch-button touch-cart" data-id="<?php echo $productinfo->nid;?>"><span class="loading"></span>  </a>
                             
                            <?php else: ?>
                            <span class="disabled-info"><?php echo t("Bestellfrist abgelaufen"); ?></span>
                            <span class="touch-cart disabled">  </span>

                            <?php endif;?>
                        </div>
                        
                        <div class="tooltip"> 
                            <div class="category-tooltip">
    
                            <?php if(!empty($productinfo->shipping['begin'])): ?>
                            
                                <div class="expiry col-100">
                                    <span class="day"><?php echo date('d.m.', $productinfo->shipping['latestorder']); ?></span>
                                    <span class="time"><?php echo date('H:i', $productinfo->shipping['latestorder']); ?></span>
                                </div>
                                
                                <div class="delivery col-100">
                                    <span class="day"><?php echo date('d.m.', $productinfo->shipping['begin']); ?></span>
                                    <span class="time"><?php echo date('H:i', $productinfo->shipping['begin']); ?> - <?php echo date('H:i', $productinfo->shipping['end']); ?> </span>
                                </div>
                            
                                <?php if(!empty($productinfo->centralpickup[0]['begin'])): ?>
                                    <?php foreach($productinfo->centralpickup as $centralvalue): ?>
                                        <div class="pick-up col-100">
                                            <span class="day"><?php echo date('d.m.', $centralvalue['begin']); ?></span>
                                           <span class="time"><?php echo date('H:i', $centralvalue['begin']); ?> - <?php echo date('H:i', $centralvalue['end']); ?></span>
                                           <span class="spot">Point <?php echo $centralvalue['title']; ?></span>
                                        </div>
                                        <?php endforeach; ?>
                                <?php endif; ?>
                                <?php else: ?>
                                    <p><?php echo t('Unfortunately this product cannot be delivered to your location @location.', array('@location' => $_SESSION['geolocation_data']['locality'])); ?></p>
                            <?php endif; ?>
                            
                             <?php if(isset($productinfo->field_labels[LANGUAGE_NONE]) && !empty($productinfo->field_labels[LANGUAGE_NONE])):?>
                                <div class="labels col-100"> 
                                    <?php foreach($productinfo->field_labels[LANGUAGE_NONE] as $labeltargetid): ?>
                                        <?php $labelinfo = node_load($labeltargetid['target_id']);?>
                                        <img src="<?php echo image_style_url('tooltiplabel', $labelinfo->field_image[LANGUAGE_NONE][0]['uri']); ?>" />
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="productseller col-100"> 
                                <p>
                                <?php
                                    echo t("Sold by <a href='@spid'>@seller</a> in @location", array('@spid' => url('node/' . $productinfo->seller_profile->nid), '@seller' => $productinfo->seller_profile->title, '@location' => $productinfo->seller_profile->field_address[LANGUAGE_NONE][0]['locality']));
                                ?>
                                </p>
                            </div>
                            
                            <?php if(isset($productinfo->field_origin[LANGUAGE_NONE][0]['locality']) && !empty($productinfo->field_origin[LANGUAGE_NONE][0]['locality'])) : ?>
                                <div class="location col-100"> 
                                    <p><?php echo t("This product was produced in !location", array('!location' => $productinfo->field_origin[LANGUAGE_NONE][0]['locality']));?></p>
                                </div>
                            <?php endif;?> 
                            </div>
                        </div>
                    </li>
                <?php endforeach;
            endif; ?>
        </ul>
        <div class="pagination">
            <?php if(isset($vars['pager'])) echo $vars['pager']; ?>
        </div>
    </div>
</div>

 

 
