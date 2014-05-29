<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page while offline.
 *
 * All the available variables are mirrored in html.tpl.php and page.tpl.php.
 * Some may be blank but they are provided for consistency.
 *
 * @see template_preprocess()
 * @see template_preprocess_maintenance_page()
 *
 * @ingroup themeable
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  
 <script type="text/javascript" src="<?php echo base_path() . path_to_theme();?>/js/jquery.jCounter-0.1.2.js"></script>
 <script type="text/javascript">
    
    jQuery(document).ready(function($) {
       $("ul.countdown").jCounter({
		date: "23 may 2014 16:00:00",
		timezone: "Europe/Berlin",
		format: "dd:hh:mm:ss",
		twoDigits: 'on',
	  
	});
    });
    
  
 </script>
</head>
<body class="<?php print $classes; ?>">
    
  <div id="page">
    <div class="container">
        <div class="sixteen columns">
            <div class="header">
                <div class="row"> 
                    <div id="logo-title">
                        <?php if (!empty($logo)): ?>
                        <a class="logo ir" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="<?php print t('Home'); ?>" id="logo">
                                           Regiomino
                                        </a>
                        <?php endif; ?>
        
                    </div>  
                </div>
            </div>  
        </div>
    </div>

   <div class="container">
        <div class="sixteen columns">
            <div class="row">
                <div id="content">
                  <?php if (!empty($title)): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
                  <?php if (!empty($messages)): print $messages; endif; ?>
                  
                    <?php print $content; ?>
                  
                </div>  
            </div>
        </div>  
    </div>
   
    <div class="countdown_outer">
        <div class="container">
            <div class="sixteen columns">
                <ul class="countdown">
                  <!--<li>
                    <p><span class="days">00</span></p>
                    <p><em class="textDays">days</em></p>
                  </li>
   -->
                  <li>
                    <p><span class="hours">00</span></p>
                    <p><em class="text">Stunden</em></p>
                  </li>
                  <li>
                    <p><span class="minutes">00</span></p>
                    <p><em class="text">Minuten</em></p>
                  </li>
                  <li>
                    <p><span class="seconds">00</span></p>
                    <p><em class="text">Sekunden</em></p>
                  </li>
                </ul>
            </div>
        </div><!--end container-->
    </div><!--end countdown_outer-->
    
     <div class="container">
        <div class="sixteen columns">
            <div class="row">
                <div id="video">
                 <iframe width="560" height="315" src="//www.youtube.com/embed/jFkfA4VIUdE" frameborder="0" allowfullscreen></iframe>
                  
                </div>  
            </div>
        </div>  
    </div>
   
   
   
   
  </div> 

</body>
</html>
