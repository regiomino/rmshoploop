<div class="menu-button">Menu</div>
<nav> 
    <ul class="flexnav">
    <?php $count = 0; ?>
    <?php foreach($vars['menutree'] as $parenttid=>$parentdetails):
    $count++;
    //if ($count <= 8) {
        $isActive = ($parentdetails['active']) ? "active " : "";
    ?>
        <li>
                <a class="<?php print ($isActive); ?>" href="<?php echo $parentdetails['link']; ?>"><?php echo $parentdetails['title']; ?></a>
                <?php if(isset($parentdetails['children'])): ?>
                        <ul class="submenu">
                        <?php foreach($parentdetails['children'] as $childtid=>$childdetails): ?>
                                <li><a href="<?php echo $childdetails['link']; ?>"><?php echo $childdetails['title']; ?></a></li>
                        <?php endforeach; ?>
                        </ul>
                <?php endif; ?>
        </li>
  <?php  // } ?>
    <?php endforeach; ?>
    </ul>
</nav>

