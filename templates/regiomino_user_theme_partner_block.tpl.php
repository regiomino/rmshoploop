<div class="sixteen columns">
     
        <div class="box-head clearfix">
                <h2><?php print t("Unsere Partner"); ?></h2>
                <div class="pagers center invisible">
                    <a class="prev brand_prev" href="#prev">Prev</a>
                    <a class="nxt brand_nxt" href="#nxt">Next</a>
                </div>
        </div><!--end box_head -->

        <div class="partnerOuter">
            
                <?php foreach($vars['partners'] as $partnerid=>$partner): ?>
                    <div> 
                        <a href="<?php print $partner['url'] ?>" title="<?php  print $partner['description']?>">
														<?php  print $partner['image_cl_full']; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            
            <br class="clear-row" />
        </div>
     
</div><!--end sixteen-->