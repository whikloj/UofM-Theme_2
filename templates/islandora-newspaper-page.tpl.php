<?php

/**
 * @file
 *   islandora-newspaper-page.tpl.php
 *   This is the template file for the object page for newspaper
 *   This override adds a print.
 */
 
?>
<div class="islandora-newspaper-object islandora">
  <div class="islandora-newspaper-controls">
    <?php print theme('islandora_newspaper_page_controls', array('object' => $islandora_object)); ?>
  </div>
  <div class="islandora-newspaper-content-wrapper clearfix">
    <?php if ($content): ?>
      <div class="islandora-newspaper-content">
        <?php print $content; ?>
      </div>
    <?php endif; ?>
    <div class="islandora-newspaper-sidebar">
      <?php if (!empty($dc_array['dc:description']['value'])): ?>
        <h2><?php print $dc_array['dc:description']['label']; ?></h2>
        <p><?php print $dc_array['dc:description']['value']; ?></p>
      <?php endif; ?>
    </div>
  </div>
</div>
<script type="text/javascript">
<!--
  var _gaq = _gaq || [];
  _gaq.push(['_setCustomVar', 1, 'PID', '<?php print $islandora_object->id;?>', 3]);
<?php foreach ($parent_collections as $cpid){ ?>
  _gaq.push(['_setCustomVar', 2, 'Collection', '<?php print $cpid;?>', 3]);
<?php } ?>
//-->
</script>
