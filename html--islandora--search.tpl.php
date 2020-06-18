<?php
/**
 * @file
 * Copy of the html.tpl.php to add specific Matomo search javascript, this page does not call trackPageView
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see zen_preprocess_html()
 * @see template_process()
 */
?><!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7" <?php print $html_attributes; ?>><![endif]-->
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7" <?php print $html_attributes; ?>><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8" <?php print $html_attributes; ?>><![endif]-->
<!--[if IE 8]><html class="lt-ie9" <?php print $html_attributes; ?>><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><html class="gte-ie9" <?php print $html_attributes;// . $rdf_namespaces; ?>><![endif]-->
<!--><html <?php print $html_attributes;?>><!--//-->

<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>

  <?php if ($default_mobile_metatags): ?>
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <?php endif; ?>
  <!--[if IEMobile]>
  <meta http-equiv="cleartype" content="on">
  <![endif]-->

  <?php print $styles; ?>
  <?php print $scripts; ?>
  <?php if ($add_respond_js): ?>
    <!--[if lt IE 9]>
    <!--<script src="<?php print $base_path . $path_to_zen; ?>/js/html5-respond.js"></script>-->
    <script src="<?php print $base_path . drupal_get_path('theme','UofM_2');?>/js/respond.min.js"></script>
    <![endif]-->
  <?php elseif ($add_html5_shim): ?>
    <!--[if lt IE 9]>
    <script src="<?php print $base_path . $path_to_zen; ?>/js/html5.js"></script>
    <![endif]-->
  <?php endif; ?>
  <?php
  if (!is_null($goog_enabled) && $goog_enabled == 1): ?>
  <!-- Google Analytics (Part 1) -->
  <script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php print $goog_analytics; ?>', 'auto');  // Replace with your property ID.
  </script>
  <!-- End Google Analytics (Part 1) -->
  <?php endif;
  if (!is_null($matomo_enabled) && $matomo_enabled == 1): ?>
<!-- Matomo -->
<script type="text/javascript">
  var _paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//<?php print $matomo_host; ?>/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '<?php print $matomo_code; ?>']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->
<?php endif;
  if (!is_null($goog_translate) && strlen($goog_translate) > 0): ?>
  <meta name="google-translate-customization" content="<?php print $goog_translate;?>"></meta>
  <?php endif; ?>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <?php if ($skip_link_text && $skip_link_anchor): ?>
    <p id="skip-link">
      <a href="#<?php print $skip_link_anchor; ?>" class="element-invisible element-focusable"><?php print $skip_link_text; ?></a>
    </p>
  <?php endif; ?>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
  <?php if (!is_null($goog_enabled) && $goog_enabled == 1): ?>
  <!-- Google Analytics (Part 2) -->
  <script type="text/javascript">
  ga('send','pageview');
  </script>
  <!-- End Google Analytics (Part 2) -->
  <?php endif;
  if (!is_null($matomo_enabled) && $matomo_enabled == 1 && isset($solr_query)): ?>
  <!-- Matomo (Part 2) -->
  <script type="text/javascript">
  var _paq = window._paq || [];
   _paq.push(['trackSiteSearch', "<?php print $solr_query; ?>", false, <?php print $solr_result_count; ?>]);
  </script>
  <!-- End Matomo (Part 2) -->
<?php endif; ?>
</body>
</html>
