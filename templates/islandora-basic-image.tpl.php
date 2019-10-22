<?php

/**
 * @file
 * This is the template file for the object page for basic image
 *
 * @TODO: add documentation about file and available variables
*  @TODO: drupal_set_title shouldn't be called here
 */
  $collection_pids = array(); // To hold parent collection pids for Google Analytics
?>

<div class="islandora-basic-image-object islandora">
  <div class="islandora-basic-image-content-wrapper clearfix">
    <?php if (isset($islandora_content)): ?>
      <div class="islandora-basic-image-content">
        <?php print $islandora_content; ?>
      </div>
    <?php endif; ?>
  <div class="islandora-basic-image-sidebar">
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
<?php foreach ($collection_pids as $cpid){ ?>
  _gaq.push(['_setCustomVar', 2, 'Collection', '<?php print $cpid;?>', 3]);
<?php } ?>
  _gaq.push(['_setCustomVar', 3, 'Title', '<?php print addcslashes($islandora_object_label, "'\\");?>', 3]);
//-->
</script>
