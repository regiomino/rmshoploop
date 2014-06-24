<div class="background">
<header>
		<?php if($user->uid == 0): ?>
    <div id="topHeader">
        <div class="container">
            <div class="sixteen columns">
                <?php print render($page['user_first']); ?>
                <?php print render($page['user_second']); ?>
            </div><!--end sixteen-->
        </div><!--end container-->
    </div><!--end topHeader-->
		<?php endif; ?>

    <div id="middleHeader">
        <div class="container">
            <div class="sixteen columns">
                <div class="logo-wrapper">
                    <?php if ($logo): ?>
                        <a class="logo ir" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="<?php print t('Home'); ?>" id="logo">
                           Regiomino
                        </a>
                        <div class="changeregion"> 
                            <?php if(isset($_SESSION['geolocation_data']['metro_name'])) echo l($_SESSION['geolocation_data']['metro_name'], current_path(), array('attributes' => array('class' => array('changeregionbtn')), 'query' => array('resetloc' => 1))); ?>
                        </div>
                    <?php endif; ?>
                </div><!--end logo-wrapper-->
                
                <?php print render($page['branding_second']); ?>
                <?php print render($page['branding_first']); ?>
                
            </div><!--end sixteen-->
        </div><!--end container-->
    </div><!--end middleHeader-->
    
    <div class="container">
        <div class="sixteen columns">
                <div id="mainNav" class="clearfix">
                    <?php print render($page['menu_first']); ?>
                    <?php print render($page['menu_second']); ?>
                </div><!--end main-->
        </div><!--end sixteen-->
    </div><!--end container-->
    
</header>
<!--end header-->

<div class="container">
    <div class="sixteen columns">
        
                <?php print render($page['highlight']); ?>

    </div>
</div><!-- container -->

<!-- main content-->
<div class="container">
    <a class="toTop" id="main-content"></a>
    <div class="sixteen columns"> 
        <?php if ($breadcrumb): ?>
            <div class="breadcrumbs-container">
                <span class="back" onclick="window.history.go(-1)">zurück</span>
		<?php print $breadcrumb; ?>
            </div>
            
        <?php endif; ?>
        
        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
            <h1 class="page-title">
              <?php print $title; ?>
            </h1>
        <?php endif; ?>
    
        <?php print render($title_suffix); ?>
    </div>      
        <?php if ($tabs): ?>
           <!-- <div class="tabs">
                <?php print render($tabs); ?>
            </div>-->
        <?php endif; ?>
        
        <?php print render($page['help']); ?>
        
        <?php if ($action_links): ?>
            <ul class="action-links">
              <?php print render($action_links); ?>
            </ul>
        <?php endif; ?>
                                
        <?php print render($page['preface']); ?>
        <?php print render($page['sidebar_left']); ?>
        <?php print render($page['content']); ?>
</div>


<!-- footer area-->
<footer>
    <div class="container">
        <?php print render($page['footer_menu']); ?>
    </div>
    <div class="container">
        <div class="sixteen columns">
            <div class="copyright"> 
                <?php echo '&copy; Regiomino ' . date('Y'); ?>
            </div>
        </div>
    </div>
</footer>

 <?php   print render($page['geolocentry']); ?>
 <?php if ($messages): ?>
    <div id="messages">
        <div class="section clearfix">
        <?php print $messages; ?>
        </div>
    </div> <!-- /.section, /#messages -->
  <?php endif; ?>
  <script>
</script>
</div>