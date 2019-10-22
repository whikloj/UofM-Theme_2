<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * A QUICK OVERVIEW OF DRUPAL THEMING
 *
 *   The default HTML for all of Drupal's markup is specified by its modules.
 *   For example, the comment.module provides the default HTML markup and CSS
 *   styling that is wrapped around each comment. Fortunately, each piece of
 *   markup can optionally be overridden by the theme.
 *
 *   Drupal deals with each chunk of content using a "theme hook". The raw
 *   content is placed in PHP variables and passed through the theme hook, which
 *   can either be a template file (which you should already be familiary with)
 *   or a theme function. For example, the "comment" theme hook is implemented
 *   with a comment.tpl.php template file, but the "breadcrumb" theme hooks is
 *   implemented with a theme_breadcrumb() theme function. Regardless if the
 *   theme hook uses a template file or theme function, the template or function
 *   does the same kind of work; it takes the PHP variables passed to it and
 *   wraps the raw content with the desired HTML markup.
 *
 *   Most theme hooks are implemented with template files. Theme hooks that use
 *   theme functions do so for performance reasons - theme_field() is faster
 *   than a field.tpl.php - or for legacy reasons - theme_breadcrumb() has "been
 *   that way forever."
 *
 *   The variables used by theme functions or template files come from a handful
 *   of sources:
 *   - the contents of other theme hooks that have already been rendered into
 *     HTML. For example, the HTML from theme_breadcrumb() is put into the
 *     $breadcrumb variable of the page.tpl.php template file.
 *   - raw data provided directly by a module (often pulled from a database)
 *   - a "render element" provided directly by a module. A render element is a
 *     nested PHP array which contains both content and meta data with hints on
 *     how the content should be rendered. If a variable in a template file is a
 *     render element, it needs to be rendered with the render() function and
 *     then printed using:
 *       <?php print render($variable); ?>
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. With this file you can do three things:
 *   - Modify any theme hooks variables or add your own variables, using
 *     preprocess or process functions.
 *   - Override any theme function. That is, replace a module's default theme
 *     function with one you write.
 *   - Call hook_*_alter() functions which allow you to alter various parts of
 *     Drupal's internals, including the render elements in forms. The most
 *     useful of which include hook_form_alter(), hook_form_FORM_ID_alter(),
 *     and hook_page_alter(). See api.drupal.org for more information about
 *     _alter functions.
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   If a theme hook uses a theme function, Drupal will use the default theme
 *   function unless your theme overrides it. To override a theme function, you
 *   have to first find the theme function that generates the output. (The
 *   api.drupal.org website is a good place to find which file contains which
 *   function.) Then you can copy the original function in its entirety and
 *   paste it in this template.php file, changing the prefix from theme_ to
 *   UofM_. For example:
 *
 *     original, found in modules/field/field.module: theme_field()
 *     theme override, found in template.php: UofM_field()
 *
 *   where UofM is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_field() function.
 *
 *   Note that base themes can also override theme functions. And those
 *   overrides will be used by sub-themes unless the sub-theme chooses to
 *   override again.
 *
 *   Zen core only overrides one theme function. If you wish to override it, you
 *   should first look at how Zen core implements this function:
 *     theme_breadcrumbs()      in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called theme hook suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node--forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and theme hook suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440 and http://drupal.org/node/1089656
 */

 /**
  * Override or insert variables into the html templates.
  *
  * @param $variables
  *   An array of variables to pass to the theme template.
  * @param $hook
  *   The name of the template being rendered ("html" in this case.)
  */
function UofM_2_preprocess_html(&$variables) {
  /* -- Custom Fonts -- */
  /*
  drupal_add_css('http://openfontlibrary.org/face/linear-regular', array('type' => 'external'));
  drupal_add_css('http://openfontlibrary.org/face/open-baskerville', array('type' => 'external'));
  drupal_add_css('http://openfontlibrary.org/face/news-cycle', array('type' => 'external'));
  */
  drupal_add_library('system', 'ui.widget');

  $variables['goog_analytics'] = theme_get_setting('UofM_2_analytics_code');
  $variables['goog_translate'] = theme_get_setting('UofM_2_translate_code');

  if (array_key_exists('page',$variables) && array_key_exists('content',$variables['page']) && array_key_exists('system_main',$variables['page']['content']) && array_key_exists('Collection View',$variables['page']['content']['system_main'])) {
    $variables['classes_array'][] = 'islandora-collection';
  }

}


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function UofM_2_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  UofM_2_preprocess_html($variables, $hook);
  UofM_2_preprocess_page($variables, $hook);
}
// */


/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */

function UofM_2_preprocess_page(&$variables, $hook) {
    $status = drupal_get_http_header("status");

    if (module_exists('islandora_basic_collection') && variable_get('islandora_basic_collection_display_backend', ISLANDORA_BASIC_COLLECTION_LEGACY_BACKEND) == 'islandora_solr_query_backend') {
        $object = menu_get_object('islandora_object', 2);
        if ($object) {
            if ($object && in_array('islandora:collectionCModel', $object->models)) {
                drupal_add_css(drupal_get_path('module', 'islandora_solr') . '/css/islandora_solr.theme.css');
                $url = 'islandora/object/' . $object->id;
                try {
                    $dc = $object['DC']->content;
                    $dc_object = DublinCore::importFromXMLString($dc)->asArray();
                }
                catch (Exception $e) {
                    drupal_set_message(t('Error retrieving object %s %t',
                      array(
                        '%s' => $object->id,
                        '%t' => $e->getMessage()
                      )
                    ), 'error', FALSE);
                }

                $collection = array();
                $desc_elem = FALSE;
                if (isset($dc_object) &&isset($dc_object['dc:description'])) {
                    $desc = $dc_object['dc:description']['value'];
                    $desc_elem = array(
                        '#type' => 'html_tag',
                        '#tag' => 'div',
                        '#value' => check_plain($desc),
                        '#attributes' => array('class' => 'islandora-basic-collection-info-description'),
                    );
                }
                $collection['description'] = $desc_elem;
                $img = FALSE;
                if (isset($object['TN'])) {
                    $img = array(
                        '#theme' => 'image',
                        '#path' => (isset($object['TN']) && islandora_datastream_access(ISLANDORA_VIEW_OBJECTS, $object['TN']) ?
                            "$url/datastream/TN/view" :
                        drupal_get_path('module', 'islandora') . "/images/folder.png"),
                        '#alt' => t($object->label),
                        '#attributes' => array('class' => 'islandora-basic-collection-info-thumbnail'),
                    );
                }
                $collection['image'] = $img;
                $variables['islandora_collection'] = $collection;
                $variables['islandora_object'] = $object;
                $variables['islandora_basic_collection_solr'] = TRUE;
                $variables['theme_hook_suggestions'][] = 'page__islandora__collection';
            }
        }
    }
    else if (array_key_exists('page',$variables) && array_key_exists('content',$variables['page']) && array_key_exists('system_main',$variables['page']['content']) && array_key_exists('Collection View',$variables['page']['content']['system_main'])) {
        $variables['theme_hook_suggestions'][] = 'page__islandora__collection';
    }
    else if ($status == "404 Not Found") {
        $variables['theme_hook_suggestions'][] = 'page__404';
    }
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/*
function UofM_2_preprocess_node(&$vars, $hook) {
  ob_start();
  print_r($vars);
  $n = ob_get_clean();
  watchdog('UM Theme','available vars in node <pre>%n</pre>',array('%n'=>$n));
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function UofM_2_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function UofM_2_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function UofM_2_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */
/**
 * Implements theme_preprocess_islandora_basic_collection_grid().
 */
function UofM_2_preprocess_islandora_basic_collection_grid(&$variables) {
    try {
          if (isset($variables['associated_objects_array'])) {
              foreach ($variables['associated_objects_array'] as $pid => $obj){
                  $new_class = "";
                  unset($type_icon);
                  $classes = $variables['associated_objects_array'][$pid]['class'];
                  $models = $obj['object']->models;
                  if (in_array('islandora:collectionCModel', $models)) {
                      $new_class .= ' item-type-collection';
                  } else if (in_array('islandora:sp_videoCModel', $models)) {
                      $new_class .= ' item-type-video';
                      $type_icon = '<span class="islandora-solr-grid-video"></span>';
                  }
                  $thumb_img = $variables['associated_objects_array'][$pid]['thumbnail'] . (isset($type_icon) ? $type_icon : "");
                  $path = $variables['associated_objects_array'][$pid]['path'];
                  $title = $variables['associated_objects_array'][$pid]['title'];
                  $variables['associated_objects_array'][$pid]['thumb_link'] = l($thumb_img, $path, array('html' => TRUE, 'attributes' => array('class' => $classes.$new_class)));
                  $variables['associated_objects_array'][$pid]['title_link'] = l($title, $path, array('html' => TRUE, 'attributes' => array()));
                  $variables['associated_objects_array'][$pid]['class'] = $classes.$new_class;
              }
          }
      }
      catch (Exception $e){
          drupal_set_message(t('Error collection models for object %t', array(
            '%t'=>$e->getMessage()
          )),'error',FALSE);
      }
}

/**
 * Implements template_preprocess_hook().
 *
 * Splits the islandora_object_mapper class to get the pid,
 * then add classes for collections.
 */
function UofM_2_preprocess_islandora_objects_grid(&$variables) {
  foreach ($variables['objects'] as $key => $obj){
    $new_class = "";
    unset($type_icon);
    $classes = $obj['class'];
    $parts = explode('-', $classes);
    $namespace = array_shift($parts);
    $pid = $namespace . ':' . implode('-', $parts);
    $object = islandora_object_load($pid);
    if (!$object) {
      $pid = $namespace . ':' . implode('_', $parts);
      $object = islandora_object_load($pid);
    }
    if ($object) {
      $models = $object->models;
      if (in_array('islandora:collectionCModel', $models)) {
        $new_class .= ' item-type-collection';
      } else if (in_array('islandora:sp_videoCModel', $models)) {
        $new_class .= ' item-type-video';
        $type_icon = '<span class="islandora-solr-grid-video"></span>';
      }
      $obj['thumb'] .= (isset($type_icon) ? $type_icon : "");
    }
    $obj['class'] .= $new_class;
    $variables['objects'][$key]['thumb'] = $obj['thumb'];
    $variables['objects'][$key]['class'] = $obj['class'];
  }
}

/**
 * Implements theme_preprocess_islandora_solr_grid().
  */
function UofM_2_preprocess_islandora_solr_grid(&$variables) {
  $results = $variables['results'];
  foreach ($results as $key => $result) {
    // Thumbnail.
    $path = url($result['thumbnail_url'], array('query' => $result['thumbnail_url_params']));
    $image = theme('image', array('path' => $path));

    $options = array('html' => TRUE);
    if (isset($result['object_label'])) {
      $options['attributes']['title'] = $result['object_label'];
    }
    if (isset($result['object_url_params'])) {
      $options['query'] = $result['object_url_params'];
    }
    if (isset($result['object_url_fragment'])) {
      $options['fragment'] = $result['object_url_fragment'];
    }
    // Thumbnail link.
    $variables['results'][$key]['thumbnail'] = l($image, $result['object_url'], $options);
    // Classes
    $variables['results'][$key]['classes'] = array();
    if (array_key_exists('type_of_resource_facet_ms', $variables['results'][$key]['solr_doc']) &&
      in_array('moving image', $variables['results'][$key]['solr_doc']['type_of_resource_facet_ms'])) {
      $variables['results'][$key]['classes'][] = 'item-type-video';
    }
    else if (array_key_exists('content_models', $variables['results'][$key]) &&
      in_array('info:fedora/islandora:collectionCModel', $variables['results'][$key]['content_models'])) {
      $variables['results'][$key]['classes'][] = 'item-type-collection';
    }
  }
}

/**
 * Implements hook_preprocess_islandora_large_image()
 *
 * Adds the $variables['dental_info'] to display the
 * specialized dental tags on the View tab
 */
function UofM_2_preprocess_islandora_large_image(&$variables) {
  module_load_include('inc', 'islandora', 'includes/utilities'); // To get the islandora function
  $object = $variables['islandora_object'];
  if (!$variables['parent_collections'] || (is_array($variables['parent_collections']) && count($variables['parent_collections']) == 0)){
    $parent_collections = islandora_get_parents_from_rels_ext($object);
    if (is_array($parent_collections) && count($parent_collections) == 0){
      $part = $object->relationships->get(FEDORA_RELS_EXT_URI,variable_get('islandora_compound_object_relationship', 'isConstituentOf'));
      if (is_array($part) && count($part) > 0){
        $new_id = $part[0]['object']['value'];
        $new_object = islandora_object_load($new_id);
        if ($new_object instanceof AbstractObject) {
          $variables['parent_collections'] = islandora_get_parents_from_rels_ext($new_object);
        }
      }
    }
  }
}

/**
 * Preprocess to get collections for newspaper issues
 */
function UofM_2_preprocess_islandora_newspaper_issue(&$variables) {
  module_load_include('inc', 'islandora', 'includes/utilities');
  $object = $variables['object'];
  $variables['islandora_object'] = $object;
  $collections = islandora_get_parents_from_rels_ext($object);
  if (array_key_exists('parent_collections', $variables)) {
    $variables['parent_collections'] = array_merge($variables['parent_collections'], $collections);
  }
  else {
    $variables['parent_collections'] = $collections;
  }
}

/**
 * Preprocess to get collections for newspaper pages
 */
function UofM_2_preprocess_islandora_newspaper_page(&$variables) {
  $object = $variables['object'];
  $variables['islandora_object'] = $object;
  $collections = UofM_2_newspaper_page_to_paper($object);
  if (array_key_exists('parent_collections', $variables)) {
    $variables['parent_collections'] = array_merge($variables['parent_collections'], $collections);
  }
  else {
    $variables['parent_collections'] = $collections;
  }
}

/**
 * Theme newspaper page controls.
 */
function UofM_2_preprocess_islandora_newspaper_page_controls(array &$variables) {
  module_load_include('inc', 'islandora', 'includes/datastream');
  module_load_include('inc', 'islandora', 'includes/utilities');
  $object = $variables['object'];
  $newspapers = UofM_2_newspaper_page_to_paper($object);
  $newspaper = reset($newspapers);
  $controls = &$variables['controls'];
  // Remove View OCR
  unset($controls['text_view']);
  // Remove tiff download
  unset($controls['tiff_download']);
  // Remove page pager
  unset($controls['page_pager']);
  // Remove issue pager
  unset($controls['issue_pager']);

  if ($newspaper) {
    $links[] = array(
      'title' => t('All Issues'),
      'href' => url("islandora/object/{$newspaper}", array('absolute' => TRUE)),
    );
    $attributes = array('class' => array('links', 'inline'));
    $controls['issue_navigator'] = theme('links', array('links' => $links, 'attributes' => $attributes));
  }
}

function UofM_2_newspaper_page_to_paper($page) {
  $query = <<<EOQ
  PREFIX fedora-rels-ext: <info:fedora/fedora-system:def/relations-external#>
  PREFIX fedora-model: <info:fedora/fedora-system:def/model#>
  SELECT ?paper
  FROM <#ri>
  WHERE {
    <info:fedora/{$page->id}> fedora-rels-ext:isMemberOf ?issue .
    ?issue fedora-rels-ext:isMemberOf ?paper ;
         fedora-model:hasModel <info:fedora/islandora:newspaperIssueCModel> ;
         fedora-model:state fedora-model:Active .
    ?paper fedora-model:hasModel <info:fedora/islandora:newspaperCModel> .
  }
EOQ;

  $results = $page->repository->ri->sparqlQuery($query);
  $issues = array();
  foreach ($results as $info) {
    $issues[] = $info['paper']['value'];
  }
  return $issues;
}

function UofM_2_block_view_islandora_compound_object_compound_jail_display_alter(&$data, $block) {
  // Create our wrapper element.
  $wrapper = array(
    '#type' => 'markup',
    '#prefix' => '<div class="islandora-compound-jail-thumbs">',
    '#suffix' => '</div>',
  );
  // Put manage link in with title to save space.
  if (isset($data['content']['part_title'])) {
    $data['content']['part_title']['#type'] = 'markup';
    $data['content']['part_title']['#prefix'] = '<span class="islandora-compound-title">';
    $data['content']['part_title']['#suffix'] = '</span>';
    if (isset($data['content']['manage_link'])) {
      $data['content']['part_title']['#markup'] .= " " . $data['content']['manage_link']['#markup'];
      unset($data['content']['manage_link']);
    }
  }
  // Get rid of default compound_jail.js and use ours.
  if (isset($data['content']['#attached']['js'])) {
    foreach ($data['content']['#attached']['js'] as $key => $element) {
      if (strpos($key, 'compound_jail.js') > 0) {
        unset($data['content']['#attached']['js'][$key]);
      }
    }
    $data['content']['#attached']['js'][drupal_get_path('theme', 'UofM_2') . '/js/compound_jail.js'] = array(
      'group' => JS_LIBRARY,
    );
  }
  $counter = 0;
  // Add all the thumbnails into the wrapper element and unset them.
  foreach ($data['content'] as $key => $element) {
    if (isset($element['#type']) && $element['#type'] == 'container') {
      $element['#attributes'] += array('class' => array('islandora-compound-thumb'));
      if (isset($element['link'])) {
        if (isset($element['link']['#options']['attributes'])) {
          $element['link']['#options']['attributes'] += array('class' => array('islandora-compound-caption'));
        }
        else {
          $element['link']['#options']['attributes'] = array('class' => array('islandora-compound-caption'));
        }
      }
      $wrapper[$key] = $element;
      unset($data['content'][$key]);
      $counter += 1;
    }
  }
  if ($counter > 0) {
    $data['content']['jail-wrapper'] = $wrapper;
  }
}

/**
 * Implements hook_process_theme().
 *
 * Makes the print dialog appear on print pages using the image clipper.
 */
function UofM_2_process_islandora_object_print(&$variables) {
  // Prompt to print.
  drupal_add_js('jQuery(document).ready(function () { window.print(); });', 'inline');
}
