<?php

/**
 * @file
 * This is the template file for the object page for large image
 *
 * Available variables:
 * - $islandora_object: The Islandora object rendered in this template file
 * - $islandora_dublin_core: The DC datastream object
 * - $dc_array: The DC datastream object values as a sanitized array. This
 *   includes label, value and class name.
 * - $islandora_object_label: The sanitized object label.
 * - $parent_collections: An array containing parent collection(s) info.
 *   Includes collection object, label, url and rendered link.
 * - $islandora_thumbnail_img: A rendered thumbnail image.
 * - $islandora_content: A rendered image. By default this is the JPG datastream
 *   which is a medium sized image. Alternatively this could be a rendered
 *   viewer which displays the JP2 datastream image.
 *
 * @see template_preprocess_islandora_large_image()
 * @see theme_islandora_large_image()
 */
  $collection_pids = array(); // To hold parent collection pids for Google Analytics
  $object_id = $islandora_object->id;
  if (!$parent_collections || (is_array($parent_collections) && count($parent_collections) == 0)){
    module_load_include('inc','islandora','includes/utilities');
    $parent_collections = islandora_get_parents_from_rels_ext($islandora_object);
    if (is_array($parent_collections) && count($parent_collections) == 0){
      $part = $islandora_object->relationships->get(FEDORA_RELS_EXT_URI,variable_get('islandora_compound_object_relationship', 'isConstituentOf'));
      if (is_array($part) && count($part) > 0){
        $object_id = $part[0]['object']['value'];
        $new_object = islandora_object_load($object_id);
        if ($new_object instanceof AbstractObject) {
          $parent_collections = islandora_get_parents_from_rels_ext($new_object);
        }
      }
    }
  }

?>

<div class="islandora-large-image-object islandora">
<?php print manidora_print_insert_link("islandora/object/{$islandora_object->id}"); ?>
  <div class="islandora-large-image-content-wrapper clearfix">
    <?php if ($islandora_content): ?>
      <?php if (isset($image_clip)): ?>
        <?php print $image_clip; ?>
      <?php endif; ?>
      <div class="islandora-large-image-content">
        <?php print $islandora_content; ?>
      </div>
    <?php endif; ?>
  <div class="islandora-large-image-sidebar">
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
  _gaq.push(['_setCustomVar', 1, 'PID', '<?php print $object_id;?>', 3]);
  _gaq.push(['_setCustomVar', 2, 'Collection', '<?php print implode($collection_pids,'|');?>', 3]);
  _gaq.push(['_setCustomVar', 3, 'Title', '<?php print $islandora_object_label;?>', 3]);
  ga('set', 'dimension1', '<?php print $object_id;?>');
  <?php foreach($collection_pids as $cpid){?>
    ga('set', 'dimension2', '<?php print $cpid;?>');
  <?php } ?>
  ga('set', 'dimension3', '<?php print $islandora_object_label;?>');
//-->
</script>
