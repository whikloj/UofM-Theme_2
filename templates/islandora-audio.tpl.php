<?php

/**
 * @file
 * This is the template file for the object page for audio file
 *
 * @TODO: add documentation about file and available variables
*  @TODO: drupal_set_title shouldn't be called here
 */
 $collection_pids = array(); // To hold parent collection pids for Google Analytics
?>

<div class="islandora-audio-object islandora">
  <?php print manidora_print_insert_link("islandora/object/{$islandora_object->id}"); ?>
  <div class="islandora-audio-content-wrapper clearfix">
    <?php if (isset($islandora_content)): ?>
      <div class="islandora-audio-content">
        <?php print $islandora_content; ?>
      </div>
    <?php endif; ?>
  <div class="islandora-audio-sidebar">
    <?php if ($parent_collections): ?>
      <div>
        <h2><?php print t('In collections'); ?></h2>
        <ul>
          <?php foreach ($parent_collections as $collection): ?>
            <li><?php print l($collection->label, "islandora/object/{$collection->id}"); ?></li>
             <?php $collection_pids[] = $collection->id; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
  </div>
  </div>
</div>
<script type="text/javascript">
<!--
  var _gaq = _gaq || [];
  _gaq.push(['_setCustomVar', 1, 'PID', '<?php print $islandora_object->id;?>', 3]);
  _gaq.push(['_setCustomVar', 2, 'Collection', '<?php print implode($collection_pids,'|');?>', 3]);
  _gaq.push(['_setCustomVar', 3, 'Title', '<?php print $islandora_object_label;?>', 3]);
//-->
</script>

