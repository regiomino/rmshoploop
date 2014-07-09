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

