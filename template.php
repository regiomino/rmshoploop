<?php

function rmshoploop_preprocess_image(&$variables) {
  foreach (array('width', 'height') as $key) {
    unset($variables[$key]);
  }
}

function rmshoploop_preprocess_regiomino_featureslider_theme_featureslider(&$variables) {
    drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/jquery.unveil.min.js');
    drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/jquery.ajaxcart.js');
    drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/productgrid.js');
}

function rmshoploop_preprocess_regiomino_user_theme_participate_block(&$variables) {
     drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/participate.js', array('scope' => 'footer'));
}


function rmshoploop_preprocess_regiomino_featureslider_theme_highlightslider(&$variables) {
  drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/jquery.royalslider.custom.min.js');
  drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/highlight.js');
  
}

function rmshoploop_preprocess_regiomino_productranking_theme_category(&$variables) {
    drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/jquery.unveil.min.js');
    drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/category.js');
    drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/jquery.ajaxcart.js');
    drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/productgrid.js');
}

/*function rmshoploop_preprocess_regiomino_geolocation_theme_request(&$variables) {
  drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/jquery.royalslider.custom.min.js');
  drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/popup.js');
} */

/**
 * Implements hook_block_list_alter().
 *
 * Effectively hides the main content block on the front page.
 */
function rmshoploop_block_list_alter(&$blocks) {
    
    if (drupal_is_front_page()) {
        foreach ($blocks as $key => $block) {
            if ($block->module == 'system' && $block->delta == 'main') {
              unset($blocks[$key]);
            }
        }
    drupal_set_page_content();
    }
}

function rmshoploop_html_head_alter(&$head_elements) {
    
  // Force the latest IE rendering engine and Google Chrome Frame.
    $head_elements['chrome_frame'] = array(
        '#type' => 'html_tag',
        '#tag' => 'meta',
        '#attributes' => array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge,chrome=1')
    );
    
    /*
    * Viewport Tag
    */
    
    $head_elements['viewport'] = array(
        '#type' => 'html_tag',
        '#tag' => 'meta',
        '#attributes' => array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=1')
    );
   
    /*
    * Apple Icons (Normal + Retina)
    */
    
    $head_elements['apple_icons_1'] = array(
        '#type' => 'html_tag',
        '#tag' => 'link',
        '#attributes' => array('rel' => 'apple-touch-icon', 'href' => ''.base_path().path_to_theme().'/images/apple-touch-icon.png')
    );
    
     $head_elements['apple_icons_2'] = array(
        '#type' => 'html_tag',
        '#tag' => 'link',
        '#attributes' => array('rel' => 'apple-touch-icon', 'sizes' => '72x72', 'href' => ''.base_path().path_to_theme().'/images/apple-touch-icon-72x72.png')
    );
     
    $head_elements['apple_icons_3'] = array(
        '#type' => 'html_tag',
        '#tag' => 'link',
        '#attributes' => array('rel' => 'apple-touch-icon', 'sizes' => '76x76', 'href' => ''.base_path().path_to_theme().'/images/apple-touch-icon-76x76.png')
    );
    
    $head_elements['apple_icons_4'] = array(
        '#type' => 'html_tag',
        '#tag' => 'link',
        '#attributes' => array('rel' => 'apple-touch-icon', 'sizes' => '114x114', 'href' => ''.base_path().path_to_theme().'/images/apple-touch-icon-114x114.png')
    );
    
    $head_elements['apple_icons_5'] = array(
        '#type' => 'html_tag',
        '#tag' => 'link',
        '#attributes' => array('rel' => 'apple-touch-icon', 'sizes' => '120x120', 'href' => ''.base_path().path_to_theme().'/images/apple-touch-icon-120x120.png')
    );
    
    $head_elements['apple_icons_6'] = array(
        '#type' => 'html_tag',
        '#tag' => 'link',
        '#attributes' => array('rel' => 'apple-touch-icon', 'sizes' => '144x144', 'href' => ''.base_path().path_to_theme().'/images/apple-touch-icon-144x144.png')
    );
    
    $head_elements['apple_icons_7'] = array(
        '#type' => 'html_tag',
        '#tag' => 'link',
        '#attributes' => array('rel' => 'apple-touch-icon', 'sizes' => '152x152', 'href' => ''.base_path().path_to_theme().'/images/apple-touch-icon-152x152.png')
    );
}

function rmshoploop_preprocess_node(&$vars) {

	if(isset($_SESSION['geolocation_data'])) {
		$customertype = $_SESSION['geolocation_data']['customertype'];
		$pricefieldtype = $_SESSION['geolocation_data']['pricefieldtype'];
	}
	else {
		$customertype = 'private';
		$pricefieldtype = 'field_tu_gross';
	}
	
	if($vars['node']->type == 'offer') {
                drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/jquery.fancybox.pack.js');
                drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/jquery.etalage.js');
                drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/jquery.rmtabs.js');
                drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/product-detail.js', array('scope' => 'footer'));
		global $base_path;
		$vars['originalprice'] = regiomino_offer_get_tradingunit_moneyvalue($vars['node'], TRUE, TRUE, $customertype, 1, $pricefieldtype);
		//$vars['discountedprice'] = regiomino_offer_get_discountedprice($vars['node'], TRUE);
		$vars['discountedprice'] = regiomino_offer_get_tradingunit_moneyvalue($vars['node'], TRUE, TRUE, $customertype, 1, $pricefieldtype);
		$vars['baseprice'] = regiomino_offer_get_baseprice($vars['node']);
		$vars['qualitylabels'] = array();
		if($vars['field_labels'] && !empty($vars['field_labels'])) {
			foreach($vars['field_labels'][LANGUAGE_NONE] as $labelinfo) {
				$labelnode = node_load($labelinfo['target_id']);
				$vars['qualitylabels'][] = '<a target="_blank" href="' . url('node/' . $labelnode->nid) . '">' . theme('image_style', array('path' => $labelnode->field_image[LANGUAGE_NONE][0]['uri'], 'style_name' => 'minilabel', 'attributes' => array('class' => 'qualitylabel'), 'title' => $labelnode->title, 'alt' => $labelnode->title)) . '</a>';
			}
		}
		$vars['discounts'] = regiomino_offer_get_discounts($vars['node']);
		$vars['discountinfo'] = regiomino_offer_get_discountinfo($vars['node']);
		$vars['soldunits'] = regiomino_offer_get_soldunits($vars['node']);
		$vars['orgstock'] = regiomino_offer_get_originalstock($vars['node']);
		$vars['unit'] = regiomino_offer_get_unit($vars['node'], TRUE);
		$vars['contact_form'] = module_invoke('webform', 'block_view', 'client-block-6540');
		$delay = $vars['field_pickupdelay'][LANGUAGE_NONE][0]['value'] * 3600;
		$vars['avlbpickupdates'] = regiomino_shipping_get_available_pickupdates($vars['node']->nid, 'bringlivery', FALSE);
		$vars['avlbcpickupdates'] = regiomino_shipping_get_available_pickupdates($vars['node']->nid, 'centralpickup', FALSE);

		$seller_user = user_load($vars['node']->uid);
		$seller_profile = node_load($seller_user->field_profilereference[LANGUAGE_NONE][0]['target_id']);
		$vars['seller']['nid'] = $seller_profile->nid;
		$vars['seller']['title'] = $seller_profile->title;
		$vars['seller']['location'] = $seller_profile->field_address[LANGUAGE_NONE][0]['locality'];		

		$duration = strtotime($vars['node']->field_duration[LANGUAGE_NONE][0]['value']) + 86400;
		$vars['shipping'] = regiomino_shipping_get_latestorder($vars['avlbpickupdates'], $delay, $duration);
		$vars['centralpickup'] = regiomino_shipping_get_latestorder($vars['avlbcpickupdates'], $delay, $duration, 'centralpickup');
	}
	else if($vars['node']->type == 'seller_profile') {
	
		drupal_add_js(array(
			'SELLER_PROFILE_LAT' => $vars['node']->field_location[LANGUAGE_NONE][0]['lat'],
			'SELLER_PROFILE_LON' => $vars['node']->field_location[LANGUAGE_NONE][0]['lon'],
		), 'setting');
		drupal_add_js('https://maps.googleapis.com/maps/api/js?sensor=false', 'external');
		drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/jquery.fancybox.pack.js');
		drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/jquery.unveil.min.js');
		drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/jquery.ajaxcart.js');
		drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/productgrid.js');
		drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/seller-profile.js');
		$query = new EntityFieldQuery();
		$tmp = $query
			->entityCondition('entity_type', 'node')
			->entityCondition('bundle', array('offer'))
			->propertyCondition('status', 1)
			->propertyCondition('soldout', 0)
			->propertyCondition('uid', $vars['node']->uid)
			->execute();
		$vars['offers'] = entity_load('node', array_keys($tmp['node']));
		
		foreach($vars['offers'] as $nid=>$values) {
		
			$avlbpickupdates = regiomino_shipping_get_available_pickupdates($nid, 'bringlivery', FALSE);
			$avlbcpickupdates = regiomino_shipping_get_available_pickupdates($nid, 'centralpickup', FALSE);
			
			$availableforselection = FALSE;
			switch($_SESSION['geolocation_data']['type']) {
				case 'bringlivery':
					$deliveryoptions = array_keys($avlbpickupdates);
				break;
				case 'centralpickup':
					$deliveryoptions = array_keys($avlbcpickupdates);
				break;
			}
			if(in_array($_SESSION['geolocation_data']['deliveryoption'], $deliveryoptions)) $availableforselection = TRUE;
			
			$selleruser = user_load($values->uid);
		
			//$vars['offers'][$nid]->discountedprice = regiomino_offer_get_discountedprice($values);
			$vars['offers'][$nid]->discountedprice = regiomino_offer_get_tradingunit_moneyvalue($values, FALSE, TRUE, $customertype, 1, $pricefieldtype);
			
			
			$vars['offers'][$nid]->shipping = regiomino_shipping_get_latestorder($avlbpickupdates, $delay, $duration);
			$vars['offers'][$nid]->centralpickup = regiomino_shipping_get_latestorder($avlbcpickupdates, $delay, $duration, 'centralpickup');
			$vars['offers'][$nid]->availableforselection = $availableforselection;
			$vars['offers'][$nid]->seller_profile = node_load($selleruser->field_profilereference[LANGUAGE_NONE][0]['target_id']);
		}
	}
	else if($vars['node']->type == 'commercial_profile') {
		drupal_add_js(array(
			'COMMERCIAL_PROFILE_LAT' => $vars['node']->field_location[LANGUAGE_NONE][0]['lat'],
			'COMMERCIAL_PROFILE_LON' => $vars['node']->field_location[LANGUAGE_NONE][0]['lon'],
		), 'setting');
		drupal_add_js('https://maps.googleapis.com/maps/api/js?sensor=false', 'external');
		drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/jquery.fancybox.pack.js');
		drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/commercial-profile.js');
	}
	else if($vars['node']->type == 'group_profile') {
		drupal_add_js(array(
			'GROUP_PROFILE_LAT' => $vars['node']->field_location[LANGUAGE_NONE][0]['lat'],
			'GROUP_PROFILE_LON' => $vars['node']->field_location[LANGUAGE_NONE][0]['lon'],
		), 'setting');
		drupal_add_js('https://maps.googleapis.com/maps/api/js?sensor=false', 'external');
		drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/jquery.fancybox.pack.js');
		drupal_add_js(drupal_get_path('theme', 'rmshoploop') . '/js/group-profile.js');
	}
}

function rmshoploop_theme() {
  $items = array();
  $items['user_register_form'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'rmshoploop') . '/templates',
    'template' => 'user-register-form',
    'preprocess functions' => array(
      'rmshoploop_preprocess_user_register_form'
    ),
  );
  return $items;
}

function rmshoploop_preprocess_user_register_form(&$vars) {

}