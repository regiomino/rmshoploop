<?php
$form = drupal_get_form('regiomino_cart_form');
/**
 * $form enthält jetzt alle Formular-Elemente des Warenkorbs, also pro Produkt "Anzahl" und "Bestellfrequenz" sowie die beiden Buttons "Aktualisieren" und "Zur Kasse"
 */
$products = array();
if(isset($form['regiomino_cart']) && !empty($form['regiomino_cart'])) {
	foreach($form['regiomino_cart']['cart_contents'] as $key => $value) {
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
			$products[$selleruser->field_profilereference[LANGUAGE_NONE][0]['target_id']][] = array(
				'product_title' => $offerobject->title,
				'product_id' => $offerobject->nid,
				'product_image' => theme('image_style',$productimage),
				//'product_price' => regiomino_offer_get_discountedprice($offerobject, FALSE, TRUE),
				'product_price' => regiomino_offer_get_tradingunit_moneyvalue($offerobject, FALSE, TRUE, 'private', $fci->field_amount[LANGUAGE_NONE][0]['value'], 'field_tu_gross') / $fci->field_amount[LANGUAGE_NONE][0]['value'],
				'product_total' => regiomino_offer_get_tradingunit_moneyvalue($offerobject, FALSE, TRUE, 'private', $fci->field_amount[LANGUAGE_NONE][0]['value'], 'field_tu_gross'),
				'product_total_vat' => regiomino_offer_get_tradingunit_moneyvalue($offerobject, FALSE, TRUE, 'private', $fci->field_amount[LANGUAGE_NONE][0]['value'], 'field_tu_vat'),
				'product_tax' => $offerobject->field_salestax[LANGUAGE_NONE][0]['value'],
				'product_unit_first' => $offerobject->field_packingunit[LANGUAGE_NONE][0]['first'],
				'product_unit_second' => $offerobject->field_packingunit[LANGUAGE_NONE][0]['second'],
				'product_amount' => $fci->field_amount[LANGUAGE_NONE][0]['value'],
				'remove_link' => l(t('Remove'), 'cart/remove/' . $tmp[1], array('attributes' => array('class' => 'remove'))),
				'fci' => $tmp[1],
			);
		}
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
                    <th><h4>Bestellintervall</h4></th>
                    <th><h4>Anzahl</h4></th>
                    <th><h4>Gesamt</h4></th>
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

                <td data-th="Preis"><h5> <?php echo str_replace('.', ',', $values['product_price']); ?> &euro; / <?php echo $values['product_unit_first']; ?> <?php echo t($values['product_unit_second']); ?></h5></td>

                <td class="order-frequency" data-th="Bestellintervall"><?php echo render($form['regiomino_cart']['cart_contents']['frequency' . $values['fci']]); ?></td>

                <td class="order-amount"  data-th="Anzahl"><?php echo render($form['regiomino_cart']['cart_contents']['amount' . $values['fci']]); ?> </td>

                <?php $totaladdup += $values['product_total']; ?>
                <?php $vataddup +=  $values['product_total_vat']; ?>

                <td  data-th="Gesamt" class="total_price"><h5> <?php echo number_format($values['product_total'], 2, ",", "."); ?> &euro; </h5></td>
            </tr>
	
		<?php endforeach; ?>

	<?php endforeach; ?>

            <tr class="summary totalex">
                    <td colspan="4">Gesamt</td>
                    <td class="sum"><?php echo number_format($totaladdup, 2, ",", "."); ?> &euro;</td>
            </tr>
            <tr class="summary vat">
                    <td colspan="4">enthaltene MwSt.</td>
                    <td><?php echo number_format($vataddup, 2, ",", "."); ?> &euro;</td>
            </tr>

			
	</tbody>
    </table>
	<?php echo render($form['regiomino_cart']['continue']); ?>	
	<?php echo render($form['regiomino_cart']['submit']); ?>
	
</div>