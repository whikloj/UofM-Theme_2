<?php

/**
 * @file
 * islandora-basic-collection-wrapper.tpl.php
 *
 * @TODO: needs documentation about file and variables
 */
?>
<div class="islandora-basic-collection-info">
   <?php if (isset($islandora_object['TN'])){
      print '<img src="' . url('islandora/object/' . $islandora_object->id . '/datastream/TN/view') . '" alt="' . check_plain($dc_array['dc:title']['value']) . '" class="islandora-basic-collection-info-thumbnail" />';
    }?>
  <h1 class="title" id="page-title"><?php if (array_key_exists('dc:title',$dc_array) && !empty($dc_array['dc:title']['value'])){ print $dc_array['dc:title']['value']; }?></h1>
  <?php if (array_key_exists('dc:description',$dc_array) && !empty($dc_array['dc:description']['value'])){
      print '<div class="islandora-basic-collection-info-description">' . check_plain($dc_array['dc:description']['value']) . '</div>';
    } ?>
</div> <!-- /islandora-basic-collection-info -->
<div class="islandora-basic-collection-wrapper">
  <div class="islandora-basic-collection clearfix">
    <span class="islandora-basic-collection-display-switch">
      <ul class="links inline">
        <?php foreach ($view_links as $link): ?>
          <li>
            <a <?php print drupal_attributes($link['attributes']) ?>><?php print $link['title'] ?></a>
          </li>
        <?php endforeach ?>
      </ul>
    </span>
    <?php print $collection_pager; ?>
    <?php print $collection_content; ?>
    <?php //print $collection_pager; ?>
  </div>
</div>
