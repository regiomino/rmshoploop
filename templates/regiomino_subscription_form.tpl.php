<?php

$form = drupal_get_form('regiomino_subscription_form');
/**
 * $form enthält jetzt alle Formular-Elemente des Warenkorbs, also pro Produkt "Anzahl" und "Bestellfrequenz" sowie die beiden Buttons "Aktualisieren" und "Zur Kasse"
 */
$products = array();
foreach($form['regiomino_subscription']['subscription_contents'] as $key => $value) {
	$tmp = explode('amount', $key);
	if(isset($tmp[1])) {
		$fci = field_collection_item_load($tmp[1]);
		$offerobject = node_load($fci->field_offer[LANGUAGE_NONE][0]['target_id']);
		$selleruser = user_load($offerobject->uid);
		$productimage = array(
			'style_name' => 'thumbnail_cart',
			'path' => $offerobject->field_image[LANGUAGE_NONE][0]['uri'],
			'width' => '',
			'height' => '',
			'alt' => $offerobject->field_image[LANGUAGE_NONE][0]['alt'],
			'title' => $offerobject->field_image[LANGUAGE_NONE][0]['title'],
			'attributes' => array('class' => 'productimage'),
		);
		$field = field_info_field('field_frequency');
		$allowed_values = list_allowed_values($field);
		$deliverystring = t('Pickup');
		if($fci->field_deliverykey[LANGUAGE_NONE][0]['value'] == 'bringlivery') $deliverystring = t('Delivery');
		$products[$selleruser->field_profilereference[LANGUAGE_NONE][0]['target_id']][] = array(
			'product_title' => $offerobject->title,
			'product_id' => $offerobject->nid,
			'product_sellertitle' => $sellerprofile->title,
			'product_image' => theme('image_style',$productimage),
			'product_price' => regiomino_offer_get_tradingunit_moneyvalue($offerobject, FALSE, TRUE, 'private', $fci->field_amount[LANGUAGE_NONE][0]['value'], 'field_tu_gross') / $fci->field_amount[LANGUAGE_NONE][0]['value'],
			'product_total' => regiomino_offer_get_tradingunit_moneyvalue($offerobject, FALSE, TRUE, 'private', $fci->field_amount[LANGUAGE_NONE][0]['value'], 'field_tu_gross'),
			'product_total_vat' => regiomino_offer_get_tradingunit_moneyvalue($offerobject, FALSE, TRUE, 'private', $fci->field_amount[LANGUAGE_NONE][0]['value'], 'field_tu_vat'),
			'product_tax' => $offerobject->field_salestax[LANGUAGE_NONE][0]['value'],
			'product_unit_first' => $offerobject->field_packingunit[LANGUAGE_NONE][0]['first'],
			'product_unit_second' => $offerobject->field_packingunit[LANGUAGE_NONE][0]['second'],
			'product_amount' => $fci->field_amount[LANGUAGE_NONE][0]['value'],
			'product_frequency' => $allowed_values[$fci->field_frequency[LANGUAGE_NONE][0]['value']],
			'product_pause' => $fci->field_pause[LANGUAGE_NONE][0]['value'],
			'shipping_type' => $deliverystring,
			'remove_link' => l(t('Remove'), 'subscription/remove/' . $tmp[1], array('attributes' => array('class' => 'remove'))),
			'pause_link' => l(t('pause'), 'subscription/pause/' . $tmp[1], array('attributes' => array('class' => 'pause'))),
			'unpause_link' => l(t('unpause'), 'subscription/unpause/' . $tmp[1], array('attributes' => array('class' => 'unpause'))),
			'next_delivery' => explode('-', regiomino_subscription_get_next_deliverydate($tmp[1])),
			'next_initiation' => regiomino_subscription_get_next_order_initiation($tmp[1]),
			'fci' => $tmp[1],
		);
	}
}
ksort($products);

//Notwendige Metadaten zur Formularverarbeitung rendern und ausgeben
echo render($form['form_id']);
echo render($form['form_build_id']);
echo render($form['form_token']);
?>
<div class="sixteen columns">	

    <table class="rm-table">
        
        <thead>
            <tr>
                    <th class="first_td"><h4>Artikel</h4></th>
                    <th><h4>Preis</h4></th>
                    <th><h4>Anzahl</h4></th>
                    <th><h4>Gesamt</h4></th>
                    <th><h4>Bestellintervall</h4></th>
                    <th><h4>Status</h4></th>
                    <th><h4>Bestellauslösung</h4></th>
                    <th><h4>Lieferung</h4></th>
            </tr>
        </thead>
        <tbody>
	<?php $totaladdup = 0; ?>
	<?php $vataddup = 0; ?>
	<?php foreach($products as $sellerprofileid => $delta): ?>
	
        <?php $sellerprofile = node_load($sellerprofileid); ?>
                <!--<tr class="virtual">
                        <td colspan="5" class="seller">Verkauf durch <?php echo l($sellerprofile->title, 'node/' . $sellerprofile->nid); ?> in <?php echo $sellerprofile->field_address[LANGUAGE_NONE][0]['locality']; ?></td>
                </tr>-->
            <?php foreach($delta as $key => $values): ?>
		
            <tr>
                <td class="first_td">
                    <div class="clearfix">
                        <?php echo $values['product_image']; ?>
                        <div class="description">
                            <strong> 
                                <a class="title" href="#"><?php echo l($values['product_title'], 'node/' . $values['product_id']); ?></a>
                            </strong>
                                <p class="seller"><?php echo t("Verkauf durch ");?><?php echo l($sellerprofile->title, 'node/' . $sellerprofile->nid); ?> in <?php echo $sellerprofile->field_address[LANGUAGE_NONE][0]['locality']; ?></p>
                                <?php echo $values['remove_link']; ?>
                        </div>
                    </div>
                </td>

                <td data-th="Preis"> <?php echo number_format($values['product_price'], 2, ",", "."); ?> &euro; / <?php echo $values['product_unit_first']; ?> <?php echo t($values['product_unit_second']); ?></td>

                <td class="order-amount" data-th="Anzahl"><?php echo render($form['regiomino_subscription']['subscription_contents']['amount' . $values['fci']]); ?> </td>

                <?php $totaladdup += $values['product_total']; ?>
                <?php $vataddup +=  $values['product_total_vat']; ?>

                <td data-th="Gesamt"  class="total_price"> <?php echo number_format($values['product_total'], 2, ",", "."); ?> &euro; </td>
								
                <td class="order-frequency" data-th="Bestellintervall"><?php echo $values['product_frequency']; ?></td>
                
                <?php if($values['product_pause'] == 1): ?>
                    <td class="pause" data-th="Status">
                        <span><?php echo t('Paused'); ?></span> (<?php echo $values['unpause_link']; ?>)
                    </td>
                <?php else: ?>
                    <td class="unpause" data-th="Status">
                        <span><?php echo t('Active'); ?></span> (<?php echo $values['pause_link']; ?>)
                    </td>
                <?php endif; ?>
                
                <td data-th="Bestellauslösung"><p class="calendar"><?php echo date('d.m.', $values['next_initiation']); ?><br><span class="title"><?php echo date('H:i', $values['next_initiation']); ?></span><em class="redlabel"><?php echo t('Order initiation'); ?></</em></p></td>

                <td data-th="Lieferung"><p class="calendar"><?php echo date('d.m.', $values['next_delivery'][1]); ?><br><span class="title"><?php echo date('H:i', $values['next_delivery'][1]); ?> - <?php echo date('H:i', $values['next_delivery'][2]); ?></span> <br> <em class="greenlabel"> (<?php echo $deliverystring; ?>)</</p></td>

            </tr>
	
		<?php endforeach; ?>

	<?php endforeach; ?>

            <tr class="summary totalex">
                    <td colspan="3">Gesamt</td>
                    <td class="sum"><?php echo number_format($totaladdup, 2, ",", "."); ?> &euro;</td>
                    <td class="last" colspan="5">&nbsp;</td>
            </tr>
            <tr class="summary vat">
                    <td colspan="3">enthaltene MwSt.</td>
                    <td><?php echo number_format($vataddup, 2, ",", "."); ?> &euro;</td>
                    <td class="last" colspan="5">&nbsp;</td>
            </tr>

			
	</tbody>
    </table>
	<?php echo render($form['regiomino_subscription']['submit']); ?>
	
</div>