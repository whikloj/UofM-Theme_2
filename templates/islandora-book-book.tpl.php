<?php
/**
 * @file
 * Template file to style output.
 */

$parent_obj = islandora_get_parents_from_rels_ext($object);
$collection_pids = array();
foreach($parent_obj as $cpid){
    $collection_pids[] = $cpid->id;
}
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
  _gaq.push(['_setCustomVar', 3, 'Title', '<?php print addcslashes($object->label, "'\\");?>', 3]);
<?php foreach ($collection_pids as $cpid){ ?>
  _gaq.push(['_setCustomVar', 2, 'Collection', '<?php print $cpid;?>', 3]);
<?php } ?>
//-->
</script>
