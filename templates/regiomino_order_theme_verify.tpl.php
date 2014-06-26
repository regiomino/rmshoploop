<?php

global $user;
$currentbalance = 0;
$currentbalance = (float)userpoints_get_current_points($user->uid, 446);
if($currentbalance <= 0) {
	$currentbalance = 0;
}
$warenkorb = regiomino_cart_load_cart();
$products = array();
foreach($warenkorb as $skey => $svalue) {
	foreach($svalue['product'] as $cartitemid => $cartitemvalues) {
		$field = field_info_field('field_frequency');
		$allowed_values = list_allowed_values($field);
		$products[$svalue['profile']['profilobject']->nid][] = array(
			'product_title' => $cartitemvalues['title'],
			'product_id' => $cartitemvalues['nid'],
			'product_sellertitle' => $svalue['profile']['profilobject']->title,
			'product_image' => $cartitemvalues['image'],
			'product_price' => $cartitemvalues['einzelpreis_wert'],
			'product_total' => $cartitemvalues['gesamt'],
			'product_total_vat' => $cartitemvalues['gesamt_mwst'],
			'product_tax' => $cartitemvalues['mwst_wert'],
			'product_unit_first' => $cartitemvalues['einheit_amount'],
			'product_unit_second' => $cartitemvalues['einheit_unit'],
			'product_amount' => $cartitemvalues['menge'],
			'product_frequency' => $allowed_values[$cartitemvalues['frequency']],
			'remove_link' => l(t(''), 'cart/remove/' . $cartitemid, array('attributes' => array('class' => 'remove'))),
			'fci' => $cartitemid,
		);
	}
}
ksort($products);

/**
 * $form enthält jetzt alle Formular-Elemente der Bestätigungsseite
 */
$form = $vars['form'];
//Notwendige Metadaten zur Formularverarbeitung rendern und ausgeben

?>

<div class="ten columns">	

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
                        </div>
                    </div>
                </td>

                <td data-th="Preis"><h5> <?php echo number_format($values['product_price'], 2, ",", "."); ?> &euro; / <?php echo $values['product_unit_first']; ?> <?php echo t($values['product_unit_second']); ?></h5></td>

                <td data-th="Bestellintervall"><?php echo $values['product_frequency']; ?></td>

                <td data-th="Anzahl"><?php echo $values['product_amount']; ?></td>

                <?php $totaladdup += $values['product_total']; ?>
                <?php $vataddup += $values['product_total_vat']; ?>

                <td data-th="Gesamt" class="total_price"><h5> <?php echo number_format($values['product_total'], 2, ",", "."); ?> &euro; </h5></td>
            </tr>
	
		<?php endforeach; ?>

	<?php endforeach; ?>

            <tr class="summary totalex">
                    <td colspan="4">Gesamt</td>
                    <td><?php echo number_format($totaladdup, 2, ",", "."); ?> &euro;</td>
            </tr>
            <tr class="summary vat">
                    <td colspan="4"><?php if(isset($_SESSION['geolocation_data'])): ?><?php if($_SESSION['geolocation_data']['customertype'] == 'commercial'): ?>zuzüglich<?php else: ?>enthaltene<?php endif; ?><?php else: ?>enthaltene<?php endif; ?> MwSt.</td>
                    <td><?php echo number_format($vataddup, 2, ",", "."); ?> &euro;</td>
            </tr>
						
						<?php if(isset($_SESSION['geolocation_data'])): ?>
							<?php if($_SESSION['geolocation_data']['customertype'] == 'commercial'): ?>
								<tr class="summary totalex">
									<td colspan="4">Gesamt inkl. MwSt.</td>
									<td><?php echo number_format($totaladdup+$vataddup, 2, ",", "."); ?> &euro;</td>
								</tr>
							<?php endif; ?>
						<?php endif; ?>
						
<?php if($currentbalance > 0): ?>

	<?php if($totaladdup < $currentbalance) : ?>
		<?php $currentbalance = $totaladdup; ?>
	<?php endif; ?>
	
						<tr class="summary balance">
							<td colspan="4"><?php echo t('Used balance'); ?></td>
							<td><?php echo number_format($currentbalance*-1, 2, ',', '.'); ?> <?php echo variable_get('regiomino_currency_entity', '&euro;'); ?></td>
						</tr>
		
						<tr class="topborder summary total">
							<td colspan="4"><?php echo t('Total to be paid'); ?></td>
							<td><?php echo number_format($totaladdup-$currentbalance, 2, ',', '.'); ?> <?php echo variable_get('regiomino_currency_entity', '&euro;'); ?></td>
						</tr>

<?php endif; ?>
			
	</tbody>
    </table>
	<?php echo render($vars['form']); ?>
	
</div>