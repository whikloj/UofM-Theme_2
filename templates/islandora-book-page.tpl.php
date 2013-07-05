<?php
/**
 * @file
 *
 */
?>
<?php
  print l(t('Return to Book View'), "islandora/object/{$book_object_id}",array('attributes'=>array('class'=>array('return-book-link'))));
?>
<?php if (isset($viewer)): ?>
  <div id="book-page-viewer" class="yes">
    <?php print $viewer; ?>
  </div>
<?php else: ?>
  <div id="book-page-image">
    <?php
      $params = array(
        'path' => url("islandora/object/{$object->id}/datastream/JPG/view"),
        'attributes' => array()
      );
      print theme_image($params);
    ?>
  </div>
<?php endif; ?>
<!-- @todo Add table of metadata values -->
