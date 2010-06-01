<?php
// $Id$

/**
 * @file template.php
 */

/**
 * Automatically rebuild the theme registry.
	* Uncomment to use during development.
	*/
//drupal_rebuild_theme_registry();

/**
 * Override or insert variables into the html template.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
function genesis_preprocess_html(&$vars) {

  // Additional body classes to help out themers.
  if (!$vars['is_front']) {
    // Add unique class for each page.
    $path = drupal_get_path_alias($_GET['q']);
    // Add unique class for each website section.
    list($section, ) = explode('/', $path, 2);
    if (arg(0) == 'node') {
      if (arg(1) == 'add') {
        $section = 'page-node-add';
      }
      elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
        $section = 'page-node-' . arg(2);
      }
    }
    $vars['classes_array'][] = drupal_html_class('section-' . $section);
  }
}

/**
 * Override or insert variables into the all templates.
 */
function genesis_process(&$variables) {
  // Provide a variable to check if the page is in the overlay.
  if (module_exists('overlay')) {
    $variables['in_overlay'] = (overlay_get_mode() == 'child');
  }
  else {
    $variables['in_overlay'] = FALSE;
  }
}

/**
 * Override or insert variables into the page template.
 */
function genesis_process_page(&$variables) {
  // Add a wrapper div using the title_prefix and title_suffix render elements.
  if (!empty($variables['title_suffix']['add_or_remove_shortcut']) ) {
    $variables['title_prefix']['shortcut_wrapper'] = array(
      '#markup' => '<div class="shortcut-wrapper clearfix">',
      '#weight' => 100,
    );
    $variables['title_suffix']['shortcut_wrapper'] = array(
      '#markup' => '</div>',
      '#weight' => -99,
    );
    // Make sure the shortcut link is the first item in title_suffix.
    $variables['title_suffix']['add_or_remove_shortcut']['#weight'] = -100;
  }
}

/**
 * Override or insert variables into page templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called.
 */
function genesis_preprocess_page(&$vars) {
  global $theme;
  // Set variables for the logo and site_name.
  if ($vars['logo']) {
    $vars['site_logo'] = '<a href="'. $vars['front_page'] .'" title="'. t('Home page') .'" rel="home"><img src="'. $vars['logo'] .'" alt="'. $vars['site_name'] .' '. t('logo') .'" /></a>';
  }
  if ($vars['site_name']) {
    $vars['site_name'] = '<a href="'. $vars['front_page'] .'" title="'. t('Home page') .'" rel="home">'. $vars['site_name'] .'</a>';
  }
  // Set variables for the primary and secondary links.
  $vars['main_menu_links'] = theme('links__system_main_menu', array('links' => $vars['main_menu'], 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'clearfix')), 'heading' => t('Main menu')));
  $vars['secondary_menu_links'] = theme('links__system_secondary_menu', array('links' => $vars['secondary_menu'], 'attributes' => array('id' => 'secondary-menu', 'class' => array('links', 'clearfix')), 'heading' => t('Secondary menu')));
}

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called.
 */
function genesis_preprocess_node(&$vars) {
  global $user;

  $node = $vars['node'];

  // node_title is inconsistant
  $vars['title'] = $node->title;

  // Add to node classes.
  if ($node->uid && $node->uid == $user->uid) {
    // Node is authored by current user.
   $vars['classes_array'][] = 'node-mine';
  }
  if ($vars['page']) {
    // Node is displayed as teaser.
    $vars['classes_array'][] = 'node-view';
  }

  // setup booleen for unpublished
  if (!$vars['status']) {
    $vars['unpublished'] = TRUE;
  }
  else {
    $vars['unpublished'] = FALSE;
  }
}

/**
 * Override or insert variables in comment templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called.
 */
function genesis_preprocess_comment(&$vars) {
  // Add odd and even classes to comments
  $vars['classes_array'][] = $vars['zebra'];
}

/**
 * Override or insert variables into block templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called.
 */
function genesis_preprocess_block(&$vars) {
  $block = $vars['block'];
  $vars['title'] = $block->subject;
  // Special classes for blocks
  $vars['classes_array'][] = $vars['block_zebra'] .'-block';
  $vars['classes_array'][] = 'block-'. $block->region;
  //$vars['classes_array'][] = 'block-count-'. $vars['id'];
}

/**
 * Converts a string to an id.
 *
 * @param $string
 *   The string
 * @return
 *   The converted string
 *
 * @see http://drupal.org/project/zen
 */
function safe_string($string) {
  $string = strtolower(preg_replace('/[^a-zA-Z0-9_-]+/', '-', $string));
  if (!ctype_lower($string{0})) {
    $string = 'id'. $string;
  }
  return $string;
}
