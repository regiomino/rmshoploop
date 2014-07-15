
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
            <!--<p class="callout">Ihre Region ist noch nicht dabei? <a href="#"> Bewerben Sie
sich für Ihre Stadt!</a> </p>-->
        </div>
    </div>
    <div class="footer">
        <?php echo l("So funktioniert's", "hilfe"); ?> &bull;
        <?php echo l("Über uns", "hilfe"); ?> &bull;
        <?php echo l("Impressum", "hilfe/impressum"); ?>
    </div>
</div>

<div id="geolocationoverlay">
</div>