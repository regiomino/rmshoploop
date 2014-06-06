<div class="sixteen columns">
    <div class="row"> 
       <div class="ten columns alpha">
        <h1 class="page-title-special">  <?php print $title; ?></h1>
       </div>
       
        <div class="six columns omega">
           <?php if($qualitylabels): ?>
                   <div class="labelarea">
                       <ul class="qualitylabels">
                           <?php foreach($qualitylabels as $labelvalue): ?>
                               <li><?php echo $labelvalue; ?></li>
                           <?php endforeach; ?>
                       </ul>
                   </div>
               <?php endif; ?>
        </div>
    </div>
        
    <div id="moveableSource" class="ten columns alpha">
        <div class="row">
            <div class="productimages clearfix">
                <ul id="etalage">
                <?php  if(isset($node->field_image[LANGUAGE_NONE]) && !empty($node->field_image[LANGUAGE_NONE])):
                    foreach($node->field_image[LANGUAGE_NONE] as $key=>$value): ?>
                        <li>
                            <a href="<?php echo image_style_url('etalage_source_image', $value['uri']) ?>">
                                <img class="etalage_source_image" src="<?php echo image_style_url('etalage_source_image', $value['uri']) ?>" />
                                <img class="etalage_thumb_image"  src="<?php echo image_style_url('etalage_thumb_image', $value['uri']) ?>" />
                            </a>
                        </li>
                <?php endforeach; endif;  ?>
                </ul>
                <div class="hidden"><div id="zoom"></div></div>
            </div>
         </div>
        
        <div class="row">
            <div class="productdescription">
                <div id="tabs">
                    <ul class="tabNav clearfix">
                        <li><a class="currentTab" href="#tabs-1"><?php echo t('Description'); ?></a></li>
                        <li><a href="#tabs-2"><?php echo t('Important notices'); ?></a></li>
                        <li><a href="#tabs-3"><?php echo t('Product origin'); ?></a></li>
                    </ul>
                    <div class="tabContent">
                        <div id="tabs-1">
                                <?php echo $body[0]['value']; ?>
                        </div>
                        <div id="tabs-2">
                                <p id="expiration"><?php echo t('Expiration'); ?>: <?php echo (empty($field_expiry) ? t('no information') : t('@number days at @degrees &deg;C', array('@number' => $field_expiry[LANGUAGE_NONE][0]['first'], '@degrees' => $field_expiry[LANGUAGE_NONE][0]['second']))); ?></p>
                                <?php if(isset($field_importantnotices[LANGUAGE_NONE][0]['value']) && !empty($field_importantnotices[LANGUAGE_NONE][0]['value'])): ?><p id="important"><?php echo $field_importantnotices[LANGUAGE_NONE][0]['value']; ?></p><?php endif; ?>
                        </div>
                        <div id="tabs-3">
                                <p><?php echo t('This product was produced in<br /><span class="location">!location</span>', array('!location' => 
			drupal_render(addressfield_generate($field_origin[LANGUAGE_NONE][0], array('address' => 'address'), array('mode' => 'render'))))); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
         <div class="row">
            <div class="productcontact">
                <h2><?php echo t("Do you have questions for the seller?");?></h2>
                <?php echo $contact_form['content']; ?>
            </div>
         </div>
    </div>
    
    <div id="moveableTarget" class="six columns omega">
        <div class="row">
           <div class="producttitle productrow clearfix">
            <h2>
                <?php if($originalprice != $discountedprice): ?>
                    <span class="orgprice"><?php echo $originalprice; ?></span>
                <?php endif; echo $discountedprice; ?> / <?php echo $field_packingunit[LANGUAGE_NONE][0]['first']; ?> <?php echo t($field_packingunit[LANGUAGE_NONE][0]['second']); ?>
								<?php if($user->uid == $node->uid || $user->uid == 1): echo l('(Bearbeiten)', 'admin/offers/edit/' . $node->nid, array('query' => drupal_get_destination())); endif; ?>
            </h2>
            
            <?php if($baseprice): ?>
                <span class="baseprice"> 
                     <?php echo $baseprice; ?>
                </span>
            <?php endif; ?>
                <span> 
                    <?php if(isset($_SESSION['geolocation_data']['customertype']) && $_SESSION['geolocation_data']['customertype'] == 'commercial'): ?>
										zzgl.
										<?php else: ?>
										inkl.
										<?php endif; ?>
										<?php echo rtrim(rtrim(number_format($field_salestax[LANGUAGE_NONE][0]['value'], 2, ",", "."), '0'), ',') ?>% MwSt.
                </span>
        </div>
        
           <div class="box product">
            <div class="productseller productrow"> 
                <p>
                    <?php echo t('Sold by <a href="@spid">@seller</a> in @location', array('@spid' => url('node/' . $seller['nid']), '@seller' => $seller['title'], '@location' => $seller['location'])); ?>
                </p>
            </div>
            
            <div class="productcall2action productrow clearfix">
                 <?php if($field_renewal[LANGUAGE_NONE][0]['value']): ?>
            <?php /*echo t('This product will be renewed after the offer expiry');*/ ?>
            
            <?php else: ?>
                <p class="availability"> 
                    <?php //echo t('Availability'); ?> 
                    <?php echo t('This product will <strong>not be available</strong> anymore after its expiry'); ?>
                </p>
            <?php endif; ?>
            <?php echo render(drupal_get_form('regiomino_cart_qty_select_form')); ?>
 
        </div>
            
        <div class="productdelivery productrow ">
         
        <?php if(!empty($shipping['begin'])): ?>
        
            <div class="col-wrapper clearfix"> 
                <div class="col-50-50 expiry">
                    <span class="title">  <?php echo t('Offer expiry'); ?>  </span>
                    <span class="day"> <?php echo date('d.m.', $shipping['latestorder']); ?></span> 
                    <span class="time"><?php echo date('H:i', $shipping['latestorder']); ?> </span>
                </div>
                
                <div class="col-50-50 delivery">
                    <span class="title">  <?php echo t('Delivery'); ?> </span>
                    <span class="day"> <?php echo date('d.m.', $shipping['begin']); ?></span> 
                    <span class="time"><?php echo date('H:i', $shipping['begin']); ?> - <?php echo date('H:i', $shipping['end']); ?>  </span>
                </div>
                
            </div>
            <?php if(!empty($centralpickup[0]['begin'])): ?>
                <div class="col-100 pick-up">
                    <span class="title"> <?php echo t('Selbstabholung'); ?></span>
                    <?php foreach($centralpickup as $centralvalue): ?>
                    <div class="pickup-wrapper"> 
                        <span class="spot"> Point <?php echo $centralvalue['title']; ?></span>
                        <span class="day"><?php echo date('d.m.', $centralvalue['begin']); ?> </span>
                        <span class="time"> <?php echo date('H:i', $centralvalue['begin']); ?> - <?php echo date('H:i', $centralvalue['end']); ?>  </span>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
        <?php else: ?>
            <p><?php echo t('Unfortunately this product cannot be delivered or picked up at the moment.'); ?></p>
        <?php endif; ?>

        </div>
        
        
        
        <?php $discounts = array(); if(isset($discounts) && !empty($discounts)): ?>
        <div class="productdiscount productrow">
        <?php   $percentage = $discountinfo['next']['percentage'];
                $amount = $discountinfo['next']['amount'];
        ?>    
            <div class="discounttext">
                <?php echo t('Next discount level (@perc%) at:', array('@perc' => $percentage));?> <span><?php echo $amount;?> x <?php echo $unit ?> </span>
            </div>
            
            <div class="discountbarframe">
                <?php $soldpercentage = 100*$soldunits/$orgstock; ?>
                <?php if($soldpercentage > 100) $soldpercentage = 100; ?>
                <?php $nextperc = 100*$discountinfo['next']['amount']/$orgstock; ?>
                
                <?php foreach($discounts as $key => $value): ?>
                    <?php $unitperc = 100*$value['second']/$orgstock; ?>
                    <div class="discountbarpointer" style="left: <?php echo $unitperc; ?>%">
                        <?php echo $value['second']; ?> (-<?php echo $value['first']; ?>%)
                        <div class="triangle"></div>
                    </div>
                     
                <?php endforeach; ?>
                
                <span class="discountbar" style="width: <?php echo $soldpercentage; ?>%"></span>
            
                        
            </div>
        </div>
          <?php endif; ?>   
         
        <div class="productservicelinks productrow last">
            
           <!-- <p> 
                <?php echo t('Get a rebate by sharing this product with your friends (<a name="tooltip" title="The seller is willing to give a discount on this product, if enough people buy it.
                            Use the social buttons below to share this product with your friends. If you buy now and a discount is reached
                            afterwards, the discount will be refunded to you.">How does that work?</a>)'); ?>
            </p>-->
            
            <div class="sharelinks"> 
                <a href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER['HTTP_HOST'] . request_uri(); ?> " title="Share on Facebook" class="facebook-share" rel="nofollow"></a>
                <a href="https://plus.google.com/share?url=<?php echo $_SERVER['HTTP_HOST'] . request_uri(); ?>" title="Share this on Google+" class="google-plus-share" rel="nofollow"></a>
                <a href="http://twitter.com/share?url=<?php echo $_SERVER['HTTP_HOST'] . request_uri(); ?>" title="Share this on Twitter" class="twitter-share" rel="nofollow"></a>
                <a href="https://www.xing.com/app/user?op=share&amp;url=<?php echo $_SERVER['HTTP_HOST'] . request_uri(); ?>" title="Share on Xing" class="xing-share" rel="nofollow"></a>
            </div>
        </div>
        
            
        </div>
         </div>
        
        
         
    </div>
  
    
    
</div>
<div id="add2CartConfirm">
    <div class="summary clearfix"> 
        <img class="image" src="<?php echo image_style_url('etalage_thumb_image', $value['uri']) ?>" />
        <p class="summary"> <span data-id="<?php echo $node->nid ?>" class="title"><?php print $title; ?> </span><span class="selected-details"></span> wurde in Ihren Warenkorb gelegt!</p>
    </div>

    <div class="next-steps">
        <p> Möchten Sie jetzt </p>
        <div class="buttons clearfix">
            <a class="close button-green" href="#" class="button-green">Weiter einkaufen</a>
            <?php echo l('Warenkorb ansehen', 'cart', array('attributes' => array('class' => 'button-red'))); ?>
        </div>
    </div>
</div>
    
   

