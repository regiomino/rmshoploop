<div class="row"> 
    <div class="ten columns">
         <div class="row">
            <div class="description">
                <p> <?php echo $node->body[LANGUAGE_NONE][0]['value']; ?>
            </div>
         </div>
        
    </div>
    
    
    <div class="six columns">
        <div class="row"> 
            <div class="address">
                <h2> Kontakt</h2>
                 <?php echo drupal_render(addressfield_generate($node->field_address[LANGUAGE_NONE][0], array('address' => 'address'), array('mode' => 'render'))); ?>
            </div>
        </div>
        <div class="row">
            <div class="seller-pictures clearfix">
                 <h2>Impressionen</h2>
                 <ul> 
                <?php foreach($node->field_image[LANGUAGE_NONE] as $key=>$value) {
                    $url_small = image_style_url('fancybox_small_preview', $value['uri']);  
                     $url_large = image_style_url('fancybox_large', $value['uri']); ?>
                    <li> <a href="<?php echo $url_large ?>" title="<?php echo $node->title; ?>" class="fancybox" data="data-fancybox-group"><img src="<?php echo $url_small ?>"> </a> </li>
                <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="sixteen columns">
    <div class="row">
        <div class="box-head clearfix">
                <h2>Produkte</h2>
        </div>
        <ul class="product-grid product-grid-16">
            <?php if(isset($offers) && !empty($offers)):
            
                foreach($offers as $productkey=>$productinfo):  ?>
              
                    <li class="clearfix column richtooltip">
                        <div class="img">
                            <?php if ($reduziert): ?>
                                <div class="ribbon-green"></div>
                            <?php endif; ?>
                            
                            <a class="image" href="<?php echo url('node/' . $productinfo->nid); ?>">
                                <img src="<?php echo image_style_url('productgrid_sixteen', $productinfo->field_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php echo t("Image of product @imagetitle", array('@imagetitle' => $productinfo->title)); ?>">
                            </a>
                            <div class="hover_buttons"> 
                                <a class="link" href="<?php echo url('node/' . $productinfo->nid); ?>"> </a>
                                <?php if(!empty($productinfo->shipping['begin']) && $productinfo->availableforselection): ?>
                                <a class="cart" data-id="<?php echo $productinfo->nid;?>" href="#">
                                        <span class="loading"> </span>
                                    </a>
                                <?php else: ?>
                                    <span class="cart disabled"></span>
                                <!--<span class="disabled-info"><?php echo t("Order deadline expired"); ?></span>-->
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
                        
                        <div class="touch-button-wrapper">
                            <!-- <a class="touch-button touch-link" href="<?php// echo url('node/' . $productinfo->nid); ?>">  </a>-->
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
                                <p class="no-delivery"><?php echo t('Unfortunately this product cannot be delivered to your location @location.', array('@location' => $_SESSION['geolocation_data']['locality'])); ?></p>
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
        <!--<div class="pagination">
            <span class="status"><?php// echo t("Seite 1 von 15") ?></span>
            <a class="prev" href="#">  </a>
            
            <a href="#">1</a>
            <a class="currentPage" href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <span class="dots">...</span>
            <a href="#">13</a>
            <a href="#">14</a>
            <a href="#">15</a>
            
            <a href="#" class="next"> </a>
        </div>-->
    </div>
</div>