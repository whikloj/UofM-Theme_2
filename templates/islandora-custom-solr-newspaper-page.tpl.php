<?php

/**
 * @file
 *   islandora-newspaper-page.tpl.php
 *   This is the template file for the object page for newspaper
 *   This override adds a print.
 */
 
?>
<div class="islandora-newspaper-object islandora islandora-custom-solr UofM-Theme">
  <div class="islandora-newspaper-controls">
    <?php print theme('islandora_custom_solr_newspaper_page_controls', array('object' => $islandora_object)); ?>
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
  _gaq.push(['_setCustomVar', 1, 'PID', '<?php print $object->id;?>', 3]);
  _gaq.push(['_setCustomVar', 2, 'Collection', '<?php print implode($parent_collections,'|');?>', 3]);
  ga('set', 'dimension1', '<?php print $object->id;?>');
  <?php foreach ($parent_collections as $collection): ?>
  ga('set', 'dimension2', '<?php print $collection;?>');
  <?php endforeach; ?>
  ga('set', 'dimension3', '<?php ?>');
//-->
</script>
