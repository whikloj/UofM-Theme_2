<?php
/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function UofM_2_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL)  {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }

  // Create the form using Forms API: http://api.drupal.org/api/7

  /* -- Delete this line if you want to use this setting
  $form['UofM_example'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('UofM sample setting'),
    '#default_value' => theme_get_setting('UofM_example'),
    '#description'   => t("This option doesn't do anything; it's just an example."),
  );
  // */
  $form['UofM_2_analytics_code'] = array(
    '#type' => 'textfield',
    '#title' => t('Google Analytics Tracking Code'),
    '#default_value' => theme_get_setting('UofM_2_analytics_code'),
    '#description' => t("Tracking code for your Google Analytics account to use builtin collection tracking code."),
  );
  $form['UofM_2_translate_code'] = array(
    '#type' => 'textfield',
    '#title' => t('Google Translate Code'),
    '#default_value' => theme_get_setting('UofM_2_translate_code'),
    '#description' => t("Tracking code for Google Translate to use a website translation widget."),
  );

  // Remove some of the base theme's settings.
  /* -- Delete this line if you want to turn off this setting.
  unset($form['themedev']['zen_wireframes']); // We don't need to toggle wireframes on this site.
  // */

  // We are editing the $form in place, so we don't need to return anything.
}
