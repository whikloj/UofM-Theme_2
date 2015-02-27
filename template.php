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
  drupal_add_js(drupal_get_path('theme','UofM_2') . '/js/collection_page.js',array('group'=>JS_THEME));
  
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
  if (array_key_exists('page',$variables) && array_key_exists('content',$variables['page']) && array_key_exists('system_main',$variables['page']['content']) && array_key_exists('Collection View',$variables['page']['content']['system_main'])) {
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
    foreach ($variables['associated_objects_array'] as $pid => $obj){
      $new_class = "";
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
      $variables['associated_objects_array'][$pid]['class'] = $classes.$new_class;
    }
  } catch (Exception $e){
    drupal_set_message(t('Error collection models for object %s %t', array('%s'=>$islandora_object->id,'%t'=>$e->getMessage())),'error',FALSE);
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
  $mods_text = $object->repository->api->a->getDatastreamDissemination($object->id, 'MODS');
  if ($mods_text) {
    $xslt_processor = new XSLTProcessor();
    $xsl = new DOMDocument();
    $file = drupal_get_path('theme', 'UofM_2') . '/xsl/UofM_2_mods_dental.xsl';
    $xsl->load($file);
    $input = new DOMDocument();
    $did_load = $input->loadXML($mods_text);
    if ($did_load) {
      global $base_url;
      $xslt_processor->importStylesheet($xsl);
      $param_array = array(
        'islandoraUrl' => $base_url,
        'PID' => $object->id,
      );
      $xslt_processor->setParameter('', $param_array);
      $mods_transformed = $xslt_processor->transformToXml($input);
      if (strlen($mods_transformed) > 0) {
        drupal_add_js( drupal_get_path('theme', 'UofM_2') . '/js/dental.js', 'file');
        $variables['dental_info'] = $mods_transformed;
      }
    }
  }
  $object_id = $object->id;
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
 * Preprocess to get collections for newspaper pages
 */
function UofM_2_preprocess_islandora_newspaper_page(&$variables) {
  $object = $variables['object'];
  $variables['islandora_object'] = $object;
  $query = <<<EOQ
  SELECT ?paper
  FROM <#ri>
  WHERE {
    <info:fedora/{$object->id}> <fedora-rels-ext:isMemberOf> ?issue .
    ?issue <fedora-rels-ext:isMemberOf> ?paper ;
         <fedora-model:hasModel> <info:fedora/islandora:newspaperIssueCModel> ;
         <fedora-model:state> <fedora-model:Active> .
    ?paper <fedora-model:hasModel> <info:fedora/islandora:newspaperCModel> .
  }
EOQ;

  $results = $object->repository->ri->sparqlQuery($query);
  $collections = array();
  foreach ($results as $info) {
    $collections[] = $info['paper']['value'];
  }
  if (array_key_exists('parent_collections', $variables)) {
    $variables['parent_collections'] = array_merge($variables['parent_collections'], $collections);
  }
  else {
    $variables['parent_collections'] = $collections;
  }
}

/**
 * Theme the page selector.
 */
function UofM_2_islandora_newspaper_page_select(array $variables) {
  module_load_include('inc', 'islandora_paged_content', 'includes/utilities');
  $path = drupal_get_path('module', 'islandora_newspaper');
  drupal_add_js($path . '/js/islandora_newspaper.js');
  $object = $variables['object'];
  $results = $object->relationships->get(ISLANDORA_RELS_EXT_URI, 'isPageOf');
  $result = reset($results);
  $parent = $result ? islandora_object_load($result['object']['value']) : FALSE;
  $pages = $parent ? islandora_paged_content_get_pages($parent) : FALSE;
  if (!$pages) {
    return;
  }

  $variables = array(
    '#options' => array(),
    '#attributes' => array('class' => array('page-select')),
    '#value' => $object->id,
  );
  foreach ($pages as $pid => $page) {
    $variables['#options'][$pid] = $page['page'];
  }
  $prefix = '<strong>' . t('Page') . ':</strong> ';
  return $prefix . t('!page_selector of @total', array(
    '!page_selector' => theme('select', array('element' => $variables)),
    '@total' => count($pages),
  ));
}

function UofM_2_preprocess_islandora_newspaper_page_controls(array &$variables) {
  module_load_include('inc', 'islandora', 'includes/datastream');
  module_load_include('inc', 'islandora', 'includes/utilities');
  global $base_url;
  $view_prefix = '<strong>' . t('View:') . ' </strong>';
  $download_prefix = '<strong>' . t('Download:') . ' </strong>';
  $object = $variables['object'];
  $issue = islandora_newspaper_get_issue($object);
  if ($issue) {
    $issue = $issue ? islandora_object_load($issue) : FALSE;
    $newspaper = islandora_newspaper_get_newspaper($issue);
  }
  $controls = array(
    'page_select' => theme('islandora_newspaper_page_select', array('object' => $object)),
  );

  if ($newspaper) {
    $links[] = array(
      'title' => t('All Issues'),
      'href' => url("islandora/object/{$newspaper}", array('absolute' => TRUE)),
    );
    $attributes = array('class' => array('links', 'inline'));
    $controls['issue_navigator'] = theme('links', array('links' => $links, 'attributes' => $attributes));
  }
  if (isset($object['JP2']) && islandora_datastream_access(ISLANDORA_VIEW_OBJECTS, $object['JP2'])) {
    // JP2 download.
    $controls['clip'] = "<strong>Clip image:</strong> " . theme(
      'islandora_openseadragon_clipper',
      array('pid' => $object->id)
    );
  }
  $variables['controls'] = $controls;
}
