<?php

/**
 * @file
 * Render a bunch of objects in a list or grid view.
 */
?>
<div class="islandora-objects-grid clearfix">
 <?php foreach($objects as $object): ?>
   <div class="islandora-objects-grid-item">
     <dl class="islandora-object <?php print $object['class']; ?>">
       <dt class="islandora-object-thumb"><?php print $object['thumb']; ?></dt>
        <?php if (strpos($object['class'],'item-type-collection') > -1): ?>
        <span class="islandora-basic-collection-collection">Collection</span>
        <?php endif; ?>
       <dd class="islandora-object-caption"><?php print $object['link']; ?></dd>
     </dl>
   </div>
 <?php endforeach; ?>
</div>