
<div class="popup-wrapper clearfix">
    <div class="header">
        <span class="logo ir">Regiomino</span>
    </div>
    
    <div class="content"> 
        <div class="row ">
            <p class="intro">
                Regiomino ist ein kostenloser Online-Marktplatz für regional erzeugte Produkte. Sie kaufen und verkaufen komfortabel online, wir kümmern uns um Abholung und Lieferung.
            </p>
        </div>
        <div class="row delivery">
            <h1>Bitte wählen Sie Ihren Marktplatz</h1>
            
            <?php  echo $vars['form_zipcode']; ?>
            <p class="callout">Ihre Region ist noch nicht dabei? <?php echo l('Bewerben Sie
sich für Ihre Stadt!', '#', array('external' => TRUE, 'attributes' => array('id' => 'region-request'))); ?></p>
        </div>
    </div>
    <div class="footer">
        <?php echo l("Einfach einkaufen", "seite/einfach-einkaufen"); ?> &bull;
        <?php echo l("Über uns", "seite/über-uns"); ?> &bull;
        <?php echo l("Registrieren", "seite/jetzt-mitmachen"); ?> &bull;
        <?php echo l("Impressum", "seite/impressum"); ?> &bull;
        <?php echo l("Kontakt", "inhalt/kontakt"); ?> &bull;
        <?php echo l("Login", "user/login", array('query' => array('destination' => 'user'))); ?>
    </div>
</div>

<div id="geolocationoverlay">
</div>