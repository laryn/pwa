<?php

/**
 * @file
 * Hooks provided by the Progressive Web App module.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Manually alter manifest.json
 *
 * This hook allows manual configuration of the manifest.json file. Some of the
 * options can be configured in the admin settings of the module, but it can all
 * be altered within the hook.
 *
 * After you make your modifications you do NOT need to return the results.
 * Since $manifest is passed by reference, any changes made to $manifest are
 * automatically registered.
 *
 * @param array &$manifest Modified options that are used to build manifest.json
 */
function hook_pwa_manifest_alter(&$manifest) {
  // Change a string-based property.
  $manifest['name'] = variable_get('pwa_name', variable_get('site_name'));

  // Change array-based properties. In this case we're manually specifying which
  // icons will appear in the manifest. Normally you have to specify each size
  // listed here to meet criteria for "Add to Homescreen"
  $manifest['icons'] = [
    [
      'src' => url(drupal_get_path('theme', 'MY_THEME') . '/assets/logo-512.png'),
      'sizes' => '512x512',
      'type' => 'image/png',
    ],
    [
      'src' => url(drupal_get_path('theme', 'MY_THEME') . '/assets/logo-192.png'),
      'sizes' => '192x192',
      'type' => 'image/png',
    ],
    [
      'src' => url(drupal_get_path('theme', 'MY_THEME') . '/assets/logo-144.png'),
      'sizes' => '144x144',
      'type' => 'image/png',
    ],
    [
      'src' => url(drupal_get_path('theme', 'MY_THEME') . '/assets/logo.svg'),
      'type' => 'image/svg+xml',
    ],
  ];

  // Add a new parameter
  //
  // Here we are specifying `orientation`. If your website is designed to be
  // viewed ONLY in landscape, the `orientation` setting can help the PWA look
  // good while the splash/loading screens are displaying.
  //
  // We omit this property by default from the module for accessibility reasons.
  // For more information see the d.o issue and WCAG documentation:
  //
  // @see https://www.drupal.org/project/pwa/issues/3070058
  // @see https://www.w3.org/WAI/WCAG21/Understanding/orientation.html
  $manifest['orientation'] = 'landscape';
}

/**
 * @} End of "addtogroup hooks".
 */
