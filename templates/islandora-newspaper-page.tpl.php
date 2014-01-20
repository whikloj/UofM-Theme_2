<?php

/**
 * @file
 *   islandora-newspaper-page.tpl.php
 *   This is the template file for the object page for newspaper
 *   This override adds a print.
 */
  module_load_include('inc','islandora_newspaper','includes/utilities');
  $issue_pid = islandora_newspaper_get_issue($object);
  $collections = array();
  if ($issue_pid){
    if (is_array($issue_pid)){
      foreach ($issue_pid as $pid){
        $tmpobj = islandora_object_load($pid);
        $collections[] = islandora_newspaper_get_newspaper($tmpobj);
      }
    } else {
      $tmpobj = islandora_object_load($issue_pid);
      $collections[] = islandora_newspaper_get_newspaper($tmpobj);
    }
  } 
 
?>
<div class="islandora-newspaper-object islandora">
  <?php print l("Download printable PDF", 'islandora/manitoba/pdf/print/' . $object->id, array('attributes'=>array('class'=>array('download-pdf-link')))); ?>
  <div class="islandora-newspaper-controls">
    <?php print theme('islandora_newspaper_page_controls', array('object' => $object)); ?>
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
  _gaq.push(['_setCustomVar', 2, 'Collection', '<?php print implode($collections,'|');?>', 3]);
  ga('set', 'dimension1', '<?php print $object->id;?>');
  ga('set', 'dimension2', '<?php print implode($collections,'|');?>');
  ga('set', 'dimension3', '<?php ?>');
//-->
</script>
