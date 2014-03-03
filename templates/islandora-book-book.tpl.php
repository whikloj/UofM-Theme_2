<?php
/**
 * @file
 * Template file to style output.
 */
 
 $parent_obj = islandora_get_parents_from_rels_ext($object);
 $collection_pids = array();
?>
<?php if (isset($viewer)): ?>
  <div id="book-viewer">
    <?php print $viewer; ?>
  </div>
<?php endif; ?>
<!-- @todo Add table of metadata values -->
<script type="text/javascript">
<!--
  var _gaq = _gaq || [];
  _gaq.push(['_setCustomVar', 1, 'PID', '<?php print $object->id;?>', 3]);
  _gaq.push(['_setCustomVar', 3, 'Title', '<?php print $object->label;?>', 3]);
  ga('set', 'dimension1', '<?php print $object->id;?>');
  <?php foreach($parent_obj as $cpid){?>
    ga('set', 'dimension2', '<?php print $cpid->id;?>');
    <?php $collection_pids[] = $cpid->id; ?>
  <?php } ?>
  ga('set', 'dimension3', '<?php print $object->label;?>');
  _gaq.push(['_setCustomVar', 2, 'Collection', '<?php print implode($collection_pids,'|');?>', 3]);
//-->
</script>