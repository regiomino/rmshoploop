<div class="slider-wrapper">
    <div id="highlight" class="slider rsDefault">
   
        <?php foreach( $vars['sliderelements'] as $elementid=>$element): ?>
            <div class="clearfix image-slide">
                <div class="slide-img">
                   <a href="<?php print $element['link_url']; ?>">
                        <div class="rsImg" data-rsw="469" data-rsh="346"> <?php print $element['img_path'] ?></div>
                        <noscript>
                           <?php print $element['img']?>
                        </noscript> 
                    </a>
                </div>
                
                 <div class="flex-caption">
                    <h1><?php print $element['link']?></h1>
                    <?php print $element['body']?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
  
</div>