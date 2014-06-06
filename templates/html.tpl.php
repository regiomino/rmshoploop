<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" lang="<?php print $language->language; ?>"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8 ie9" lang="<?php print $language->language; ?>"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html class="no-js" lang="<?php print $language->language; ?>"> <!--<![endif]-->

<head profile="<?php print $grddl_profile; ?>">
    <?php print $head; ?>
    <title><?php print $head_title; ?></title>
    <?php print $styles; ?>
    <?php print $scripts; ?>
    
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body class="<?php print $classes; ?>" <?php print $attributes;?>>
    <div id="skip-link">
      <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
    </div>
    <?php print $page_top; ?>
    <?php print $page; ?>
    <?php print $page_bottom; ?>
    <script>
        (function ($) {
            
             $(".rmnav").rmNav();

        })(jQuery);
    </script>
</body>
</html>
