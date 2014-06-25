<?php
function umlaute_ersetzen($text){
    $such_array  = array ('ä', 'ö', 'ü', 'ß');
    $ersetzen_array = array ('ae', 'oe', 'ue', 'ss');
    $neuer_text  = str_replace($such_array, $ersetzen_array, $text);
    return $neuer_text;
}

?>

<div class="menu-button">Menü<span class="touch-button"></span></div>
<nav> 
    <ul class="rmnav">
    <?php $count = 0; ?>
    <?php foreach($vars['menutree'] as $parenttid=>$parentdetails):
    $count++;
    
        $hasChildren = (isset($parentdetails['children'])) ? "wSub " : "";
       
    ?>
        <li class="<?php print ($hasChildren); ?>">
                <?php
                    $raw = strtolower(preg_replace('/\s+/', '',$parentdetails['title']));
                    $data_attr = umlaute_ersetzen($raw);
                ?>
                <a class="category-item" data-name="<?php echo $data_attr; ?>" href="<?php echo $parentdetails['link']; ?>"><?php echo $parentdetails['title']; ?></a>
                <?php if(isset($parentdetails['children'])): ?>
                    <span class="touch-button"></span>
                 <?php endif; ?>
                <?php if(isset($parentdetails['children'])): ?>
                        <?php $amount = count($parentdetails['children']);
                              $n = 1;
                              $chunks = 7;
                              $cols = ceil($amount / $chunks);
                        ?>
                        <div class="submenu-wrapper col-<?php echo $cols; ?> clearfix" data-chunks="<?php echo $chunks; ?>" data-cols="<?php echo $cols;?>">
                            <div class="submenu-col"> 
                        <?php foreach($parentdetails['children'] as $childtid=>$childdetails): ?>
                                <a href="<?php echo $childdetails['link']; ?>"><?php echo $childdetails['title']; ?></a>
                                <?php
                                    if ($n % $chunks == 0 && $n < $amount) {
                                        echo "</div><div class=\"submenu-col\">";
                                    }
                                    $n++;
                                ?>
                        <?php endforeach; ?>
                            </div> 
                        </div>
                <?php endif; ?>
            
        </li>
       
  <?php  // } ?>
    <?php endforeach; ?>
    </ul>
</nav>

