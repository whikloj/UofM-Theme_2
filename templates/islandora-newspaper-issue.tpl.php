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
