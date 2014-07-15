<h3>Oft gestellte Fragen</h3>
<ul>
<?php foreach($vars['faq'] as $nid => $nodeobject): ?>
	<li>
		<?php echo l($nodeobject->title, '#' . $nid, array('external' => TRUE)); ?>
	</li>
<?php endforeach; ?>
</ul>

<h3>Unsere Antworten</h3>
<dl>
<?php foreach($vars['faq'] as $nid => $nodeobject): ?>
	<a name="<?php echo $nid; ?>"></a><dt><strong><?php echo $nodeobject->title; ?></strong></dt>
	<dd><?php echo $nodeobject->body[LANGUAGE_NONE][0]['value']; ?></dd>
	&#8679; <?php echo l('Zurück nach oben', '#', array('external' => TRUE)); ?>
	<br />
	<br />
	<br />
<?php endforeach; ?>
</dl>