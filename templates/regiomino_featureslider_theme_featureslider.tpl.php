<div class="sixteen columns">
    <div class="row"> 
        <div class="featured">
            <div class="box-head clearfix">
                <h2><?php print t("Neueste Produkte"); ?></h2>
                    <!--<div class="pagers center">
                            <a class="prev featuredPrev" href="#prev"> </a>
                            <a class="nxt featuredNxt" href="#nxt"> </a>
                    </div>-->
            </div><!--end box_head -->
    
            <div> <!--class="cycle-slideshow clearfix" 
            data-cycle-fx="scrollHorz"
            data-cycle-timeout=0
            data-cycle-slides="> ul"
            data-cycle-prev="div.pagers a.featuredPrev"
            data-cycle-next="div.pagers a.featuredNxt"
            -->
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
                    <div class="img">
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
                                <!--<img src="<?php echo image_style_url('productgrid_sixteen', $product['image']);?>" alt="<?php echo $product['title'];?>">-->
				<?php echo $product['image_full']; ?>
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


