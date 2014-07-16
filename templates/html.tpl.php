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

		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-40144139-1', 'auto');
			ga('send', 'pageview');

		</script>

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
				(function () { 
						var _tsid = 'X9FF4FD2592B5BFA727E6480148224623'; 
						_tsConfig = { 
								'yOffset': '0', //offset from page bottom
								'variant': 'reviews' //text, default, small, reviews
						};
						var _ts = document.createElement('script');
						_ts.type = 'text/javascript'; 
						_ts.charset = 'utf-8'; 
						_ts.src = '//widgets.trustedshops.com/js/' + _tsid + '.js'; 
						var __ts = document.getElementsByTagName('script')[0];
						__ts.parentNode.insertBefore(_ts, __ts);
				})();
    </script>

</body>
</html>
