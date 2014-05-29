<div class="geolocation">   
<?php if(isset($vars['geoloc_zip']) && !empty($vars['geoloc_zip']) && isset($vars['geoloc_loc']) && !empty($vars['geoloc_loc']) && isset($vars['geoloc_option']) && !empty($vars['geoloc_option'])): ?>

	<?php if(isset($vars['geoloc_type']) && $vars['geoloc_type'] == 'bringlivery'): ?>
		<?php $deliverytype = t('Delivery to'); ?>
	<?php else: ?>
		<?php $deliverytype = t('Pickup at storage point'); ?>
	<?php endif; ?>
	
	<?php echo $deliverytype . ' ' . $vars['geoloc_zip'] . ' ' . $vars['geoloc_loc'] . '<br> ' . $vars['timewindow'] . ' <a id="changeregionbtn" href="' . $vars['resetpath'] . '">' . t('different region') . '?</a>'; ?>
	
	<?php if($vars['cartfilled']): ?>
		<div id="changeregiondialog" title="<?php echo t('Change region'); ?>"><p><?php echo t('Please notice that changing your region results in deletion of your current shopping cart. This is due to a regionally restricted availability of products.'); ?></p></div>
	<?php endif; ?>

<?php else: ?>
	<?php echo t('We could not detect your location. !different.', array('!different' => '<a id="changeregionbtn" href="' . url(current_path(), array('query' => array('resetloc' => '1'))) . '">' . t('Please update your region') . '</a>')); ?>
<?php endif; ?>
</div>
 
<noscript>
    <div class="no-scriptalert">  
       <h2>Bitte aktivieren Sie Javascript</h2><p style="font-size: small;">Wir haben festgestellt, dass Ihr kein Javascript unterstützt oder deaktiviert hat. Regiomino nutzt Javascript für eine Vielzahl von Funktionen, von der Darstellung der Produktbilder und Beschreibungen bis hin zur Auswahl der Produkte aus Ihrer direkten Umgebung.</p><p style="font-size: small;"><a href="http://www.enable-javascript.com/de/" target="_blank">Anleitung zum Aktivieren</a></p>
    </div>
</noscript>
