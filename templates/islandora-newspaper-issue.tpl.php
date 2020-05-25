<?php

/**
 * @file
 */
?>
<div class="islandora-newspaper-issue clearfix">
  <span class="islandora-newspaper-issue-navigator">
  </span>
  <?php if (isset($viewer_id) && $viewer_id != "none"): ?>
    <div id="book-viewer">
      <?php print $viewer; ?>
    </div>
  <?php else: ?>
    <?php print theme('islandora_objects', array('objects' => $pages)); ?>
  <?php endif; ?>
</div>
<script type="text/javascript">
  <!--
  ga('set', 'cd1', '<?php print $islandora_object->id;?>');
  ga('set', 'cd2', '<?php print implode('|', $parent_collections);?>');
  var _gaq = _gaq || [];
  _gaq.push(['_setCustomVar', 1, 'PID', '<?php print $islandora_object->id;?>', 3]);
<?php foreach ($parent_collections as $cpid){ ?>
  _gaq.push(['_setCustomVar', 2, 'Collection', '<?php print $cpid;?>', 3]);
<?php } ?>
  //-->
</script>
