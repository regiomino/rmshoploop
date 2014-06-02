<div class="sixteen columns">
    <div class="row"> 
        <div class="featured">
            <div class="box-head clearfix">
                <h2><?php print t("Neueste Produkte"); ?></h2>
                    
            </div>
    
            <div> 
            <?php
            $count = 0;
            $length = count($vars["products"]);
            
            ?>
                
            <ul class="product-grid product-grid-16">    
                <?php foreach($vars['products'] as $productid=>$product): 
                   
                    $reduziert = false;
                    
                    //Ermitteln ob Produkt rabattiert ist
                    if($product['price_discounted'] != $product['price_original']) {
                            $reduziert = true;
                    }
            ?>
                <li class="clearfix column">
                    <div class="img preloaded">
                        <?php if ($reduziert): ?>
                            <div class="ribbon-green"></div>
                        <?php endif; ?>
                       
                            <div class="hover_buttons"> 
                               <a class="link" href="<?php echo $product['path'];?>"> </a>
                               <?php  if(empty($productinfo->shipping['begin']) || !$productinfo->availableforselection): ?>
                                   <a class="cart" data-id="<?php echo $product['id'];?>" href="#">
                                       <span class="loading"> </span>
                                   </a>
                               <?php endif; ?>
                            </div>
                        
                        <a class="image" href="<?php echo $product['path'];?>">
                            <img class="preloader" src="<?php echo base_path() . path_to_theme();?>/images/preloaders/preloader.gif" data-src="<?php echo $product['img_path'];?>"">
                        
                            <noscript> 
                            <?php echo $product['image_full']; ?>
                            </noscript>
                        </a> 
                    </div>
                    <h6>
                        <a href="<?php echo $product['path'];?>" title ="<?php echo $product['title'] ;?>">
                         <?php
                            $length = 50;
                            if(mb_strlen($product['title'] ) > $length) {
                                    echo mb_substr($product['title'] , 0, $length-1) . '...';
                            }
                            else {
                                echo $product['title'];
                            }
                        ?> 
                        </a>
                    </h6>
                    <h5>
                        <?php if ($reduziert): ?> <span class="sale_offer"><?php echo number_format($product['price_original'], 2, ",", ".") . ' €'; ?> </span>  &nbsp; &nbsp; <?php endif; ?>

                        <?php echo number_format($product['price_discounted'], 2, ",", ".") . ' €';  ?>/
                            <?php echo $product['unit_first']; ?>
                            <?php echo t($product['unit_second']); ?>
                   </h5>
                    <p class="baseprice">
                            <?php echo $product['base_price']; ?>
                    </p>
                     <div class="touch-button-wrapper"> 
                            <?php  if(empty($productinfo->shipping['begin']) || !$productinfo->availableforselection): ?>
                                <a href="" class="touch-button touch-cart" data-id ="<?php echo $product['id'];?>"><span class="loading"></span>  </a>
                             <?php endif;?>  
                               <!-- <a class="touch-button touch-link" href="<?php //echo url('node/' . $productinfo->nid); ?>">  </a>-->
                    </div>
                </li>
                     
               
                
                
                <?php endforeach; ?>   
                 </ul>
            </div>
        </div><!--end featured-->
    </div>
</div>


