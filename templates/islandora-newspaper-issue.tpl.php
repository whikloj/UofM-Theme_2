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
<?php if (!is_null($matomo_enabled) && $matomo_enabled == 1): ?>
<script type="text/javascript">
<!--
  var _paq = window._paq || [];
<?php foreach ($collection_pids as $collection): ?>
  _paq.push(['trackContentImpression', '<?php print $collection; ?>', 'Part of Newspaper', '<?php print $_SERVER['REQUEST_URI']?>']);
<?php endforeach; ?>
  _paq.push(['trackContentImpression', 'Newspaper Issue', 'Display Type', '<?php print $_SERVER['REQUEST_URI']?>']);
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
<?php foreach ($parent_collections as $cpid){ ?>
  _gaq.push(['_setCustomVar', 2, 'Collection', '<?php print $cpid;?>', 3]);
<?php } ?>
  //-->
</script>
<?php endif; ?>
