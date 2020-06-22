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
    <?php if (isset($content) && !is_null($content)): ?>
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
<?php if (!is_null($matomo_enabled) && $matomo_enabled == 1): ?>
<script type="text/javascript">
<!--
  var _paq = window._paq || [];
<?php foreach ($parent_collections as $collection): ?>
  _paq.push(['trackContentImpression', '<?php print $collection; ?>', 'Part of Newspaper', '<?php print $_SERVER['REQUEST_URI']?>']);
<?php endforeach; ?>
  _paq.push(['trackContentImpression', 'Newspaper Page', 'Display Type', '<?php print $_SERVER['REQUEST_URI']?>']);
//-->
</script>
<?php endif;
  if (!is_null($goog_enabled) && $goog_enabled == 1): ?>
<script type="text/javascript">
  <!--
  ga('set', 'cd1', '<?php print $islandora_object->id;?>');
  ga('set', 'cd2', '<?php print implode('|', $parent_collections);?>');
  var _gaq = _gaq || [];
  _gaq.push(['_setCustomVar', 1, 'PID', '<?php print $islandora_object->id;?>', 3]);
 <?php foreach($parent_collections as $cpid): ?>
  _gaq.push(['_setCustomVar', 2, 'Collection', '<?php print $cpid;?>', 3]);
 <?php endforeach; ?>
//-->
</script>
<?php endif; ?>
