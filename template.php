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
  drupal_add_css('http://openfontlibrary.org/face/linear-regular', array('type' => 'external'));
  drupal_add_css('http://openfontlibrary.org/face/open-baskerville', array('type' => 'external'));
  drupal_add_css('http://openfontlibrary.org/face/news-cycle', array('type' => 'external'));
  drupal_add_library('system', 'ui.widget');
  drupal_add_js(drupal_get_path('theme','UofM_2') . '/js/collection_page.js',array('group'=>JS_THEME));
  
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
  if (array_key_exists('page',$variables) && array_key_exists('content',$variables['page']) && array_key_exists('system_main',$variables['page']['content']) && array_key_exists('Collection View',$variables['page']['content']['system_main'])) {
    $variables['theme_hook_suggestions'][] = 'page__islandora__collection';
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
      if (!empty($new_class)) {
        $thumb_img = $variables['associated_objects_array'][$pid]['thumbnail'] . (isset($type_icon) ? $type_icon : "");
        $path = $variables['associated_objects_array'][$pid]['path'];
        $title = $variables['associated_objects_array'][$pid]['title'];
        $variables['associated_objects_array'][$pid]['thumb_link'] = l($thumb_img, $path, array('html' => TRUE, 'attributes' => array('title' => $title,'class' => $classes.$new_class)));
        $variables['associated_objects_array'][$pid]['class'] = $classes.$new_class;
      }
    }
  } catch (Exception $e){
    drupal_set_message(t('Error collection models for object %s %t', array('%s'=>$islandora_object->id,'%t'=>$e->getMessage())),'error',FALSE);
  } 
}

function UofM_2_preprocess_islandora_solr_grid(&$variables) {
  for ($x = 0; $x < count($variables['results']); $x += 1) {
    $variables['results'][$x]['classes'] = array();
    if (array_key_exists('type_of_resource_facet_ms', $variables['results'][$x]['solr_doc']) &&
    in_array('moving image', $variables['results'][$x]['solr_doc']['type_of_resource_facet_ms'])) {
      $variables['results'][$x]['classes'][] = 'item-type-video';
    }
    else if (array_key_exists('content_models', $variables['results'][$x]) &&
    in_array('info:fedora/islandora:collectionCModel', $variables['results'][$x]['content_models'])) {
      $variables['results'][$x]['classes'][] = 'item-type-collection';
    }
  } // end for
}
