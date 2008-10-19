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
 * Override or insert preprocess variables into page templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called ("page" in this case.)
 */
function genesis_preprocess_page(&$vars, $hook) {
  global $theme;

  // Don't display empty help from node_help().
  if ($vars['help'] == "<div class=\"help\"><p></p>\n</div>") {
    $vars['help'] = '';
  }

  // Wrapper Classes. Allows advanced theming based on path,
  // node type etc.
  $page_classes = array();
  if (!$vars['is_front']) {
    // Add classes for each page and section
    $path = drupal_get_path_alias($_GET['q']);
    list($section, ) = explode('/', $path, 2);
    $page_classes[] = genesis_id_safe('page-'. $path);
    $page_classes[] = genesis_id_safe('section-'. $section);
      if (arg(0) == 'node') {
        if (arg(1) == 'add') {
          $page_classes[] = 'section-node-add'; // Add 'section-node-add'
        }
        elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
          $page_classes[] = 'section-node-'. arg(2); // Add 'section-node-edit' or 'section-node-delete'
        }
      }
      // Add a unique class when viewing a node
      if (arg(0) == 'node' && is_numeric(arg(1))) {
        $page_classes[] = 'node-full-view'; // Add 'node-full-view'
      }
    }
    if (!$vars['is_front']) {
      $vars['page_classes'] = 'class="'. implode(' ', $page_classes) .'"'; // Concatenate with spaces
    }

  // Primary and Secondary Links wrapper class.
  if ($vars['primary_links'] && $vars['secondary_links']) {
    $vars['nav_class'] = 'primary-secondary';
  }
  if ($vars['primary_links'] && !$vars['secondary_links']) {
    $vars['nav_class'] = 'with-primary';
  }
  if (!$vars['primary_links'] && $vars['secondary_links']) {
    $vars['nav_class'] = 'with-secondary';
  }

}

/**
 * Override or insert preprocess variables into the node templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called ("node" in this case.)
 *
 */
function genesis_preprocess_node(&$vars, $hook) {
  global $user;

  // Special classes for nodes
  $node_classes = array();
  if ($vars['sticky']) {
    $node_classes[] = 'sticky';
  }
  if (!$vars['node']->status) {
    $node_classes[] = 'node-unpublished';
    $vars['unpublished'] = TRUE;
  }
  else {
    $vars['unpublished'] = FALSE;
  }
  if ($vars['node']->uid && $vars['node']->uid == $user->uid) {
    // Node is authored by current user
    $node_classes[] = 'node-mine';
  }
  if ($vars['teaser']) {
    // Node is displayed as teaser
    $node_classes[] = 'node-teaser';
  }
  // Class for node type: "node-type-page", "node-type-story", "node-type-my-custom-type", etc.
  $node_classes[] = 'node-type-'. $vars['node']->type;
  $vars['node_classes'] = implode(' ', $node_classes); // Concatenate with spaces

  // Customised dates; set new variables so themers can use $submitted as per normal.
  $vars['long_date']  = format_date($vars['node']->created, 'custom', "l, F j, Y - H:i");
  $vars['short_date'] = format_date($vars['node']->created, 'custom', "F j, Y");

}

/**
 * Override or insert preprocess variables into the comment templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called ("comment" in this case.)
 *
 */
function genesis_preprocess_comment(&$vars, $hook) {
  global $user;

  // We load the node object that the current comment is attached to
  $node = node_load($vars['comment']->nid);
  // If the author of this comment is equal to the author of the node, we
  // set a variable so we can theme this comment uniquely.
  $vars['author_comment'] = $vars['comment']->uid == $node->uid ? TRUE : FALSE;

  $comment_classes = array();

  // Odd/even handling
  static $comment_odd = TRUE;
  $comment_classes[] = $comment_odd ? 'odd' : 'even';
  $comment_odd = !$comment_odd;

  if ($vars['comment']->status == COMMENT_NOT_PUBLISHED) {
    $comment_classes[] = 'comment-unpublished';
    $vars['unpublished'] = TRUE;
  }
  else {
    $vars['unpublished'] = FALSE;
  }
  if ($vars['author_comment']) {
    // Comment is by the node author
    $comment_classes[] = 'comment-by-author';
  }
  if ($vars['comment']->uid == 0) {
    // Comment is by an anonymous user
    $comment_classes[] = 'comment-by-anon';
  }
  if ($user->uid && $vars['comment']->uid == $user->uid) {
    // Comment was posted by current user
    $comment_classes[] = 'comment-mine';
  }
  $vars['comment_classes'] = implode(' ', $comment_classes);

  // If comment subjects are disabled, don't display 'em
  if (variable_get('comment_subject_field', 1) == 0) {
    $vars['title'] = '';
  }

  // Set comment vars for the customised dates.
  $vars['long_date']  = format_date($vars['node']->created, 'custom', "l, F j, Y - H:i");
  $vars['short_date'] = format_date($vars['node']->created, 'custom', "F j, Y");

}

/**
 * Override or insert PHPTemplate variables into the block templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called ("block" in this case.)
 *
 * @see http://drupal.org/project/zen
 */
function genesis_preprocess_block(&$vars, $hook) {
  $block = $vars['block'];

  // Special classes for blocks
  $block_classes = array();
  $block_classes[] = 'block-'. $block->module;
  $block_classes[] = 'region-'. $vars['block_zebra'];
  $block_classes[] = $vars['zebra'];
  $block_classes[] = 'region-count-'. $vars['block_id'];
  $block_classes[] = 'count-'. $vars['id'];
  $vars['block_classes'] = implode(' ', $block_classes);

  if (user_access('administer blocks')) {
    // Display 'edit block' for custom blocks
    if ($block->module == 'block') {
      $edit_links[] = l( t('edit block'), 'admin/build/block/configure/'. $block->module .'/'. $block->delta, array('title' => t('edit the content of this block'), 'class' => 'block-edit'), drupal_get_destination(), NULL, FALSE, TRUE);
    }
    // Display 'configure' for other blocks
    else {
      $edit_links[] = l(t('configure'), 'admin/build/block/configure/'. $block->module .'/'. $block->delta, array('title' => t('configure this block'), 'class' => 'block-config'), drupal_get_destination(), NULL, FALSE, TRUE);
    }
    // Display 'edit menu' for menu blocks
    if (($block->module == 'menu' || ($block->module == 'user' && $block->delta == 1)) && user_access('administer menu')) {
      $edit_links[] = l(t('edit menu'), 'admin/build/menu', array('title' => t('edit the menu that defines this block'), 'class' => 'block-edit-menu'), drupal_get_destination(), NULL, FALSE, TRUE);
    }
  $vars['edit_links_array'] = $edit_links;
  $vars['edit_links'] = '<div class="edit">'. implode(' ', $edit_links) .'</div>';
  }

}

/**
 * Converts a string to a suitable html ID attribute.
 *
 * http://www.w3.org/TR/html4/struct/global.html#h-7.5.2 specifies what makes a
 * valid ID attribute in HTML. This function:
 *
 * - Ensure an ID starts with an alpha character by optionally adding an 'n'.
 * - Replaces any character except A-Z, numbers, and underscores with dashes.
 * - Converts entire string to lowercase.
 *
 * @param $string
 *   The string
 * @return
 *   The converted string
 *
 * @see http://drupal.org/project/zen
 */
function genesis_id_safe($string) {
  // Replace with dashes anything that isn't A-Z, numbers, dashes, or underscores.
  $string = strtolower(preg_replace('/[^a-zA-Z0-9_-]+/', '-', $string));
  // If the first character is not a-z, add 'n' in front.
  if (!ctype_lower($string{0})) { // Don't use ctype_alpha since its locale aware.
    $string = 'id'. $string;
  }
  return $string;
}

/**
 * Implements theme_menu_item_link()
 */
function genesis_menu_item_link($link) {
  if (empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }

  // If an item is a LOCAL TASK, render it as a tab
  if ($link['type'] & MENU_IS_LOCAL_TASK) {
    $link['title'] = '<span class="tab">'. check_plain($link['title']) .'</span>';
    $link['localized_options']['html'] = TRUE;
  }

  return l($link['title'], $link['href'], $link['localized_options']);
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clear-block to tabs.
 */
function genesis_menu_local_tasks() {
  $output = '';

  if ($primary = menu_primary_local_tasks()) {
    $output .= '<ul class="tabs primary clear-block">'. $primary .'</ul>';
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $output .= '<ul class="tabs secondary clear-block">'. $secondary .'</ul>';
  }

  return $output;
}

/**
 * Theme override for user_picture
 *
 * @return
 *  The un-themed variable
 */
function phptemplate_user_picture(&$account) {
  if (variable_get('user_pictures', 0)) {
    if ($account->picture && file_exists($account->picture)) {
      $picture = file_create_url($account->picture);
    }
    else if (variable_get('user_picture_default', '')) {
      $picture = variable_get('user_picture_default', '');
    }
    if (isset($picture)) {
      $alt = t("@user's picture", array('@user' => $account->name ? $account->name : variable_get('anonymous', t('Anonymous'))));
      $picture = theme('image', $picture, $alt, $alt, '', FALSE);
      if (!empty($account->uid) && user_access('access user profiles')) {
        $attributes = array('attributes' => array('title' => t('View user profile.')), 'html' => TRUE);
        $picture = l($picture, "user/$account->uid", $attributes);
      }
      return $picture;
    }
  }
}

/**
 * Return a themed breadcrumb trail.
 */
function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    return '<div class="breadcrumb">'. implode(' &raquo; ', $breadcrumb) .'</div>';
  }
}

/**
 * Implements HOOK_theme().
 *
 * The Zen base theme (where this comes from) uses this function as a work-around 
 * for a bug in Drupal 6.0-6.4: #252430 (Allow BASETHEME_ prefix in preprocessor 
 * function names).
 *
 * Sub-themes Also use this function by calling it from their HOOK_theme() in
 * order to get around a design limitation in Drupal 6: #249532 (Allow subthemes
 * to have preprocess hooks without tpl files.)
 *
 * @param $existing
 *   An array of existing implementations that may be used for override purposes.
 * @param $type
 *   What 'type' is being processed.
 * @param $theme
 *   The actual name of theme that is being being checked.
 * @param $path
 *   The directory path of the theme or module, so that it doesn't need to be looked up.
 */
function genesis_theme(&$existing, $type, $theme, $path) {
  // Each theme has two possible preprocess functions that can act on a hook.
  // This function applies to every hook.
  $functions[0] = $theme .'_preprocess';
  // Inspect the preprocess functions for every hook in the theme registry.
  foreach (array_keys($existing) AS $hook) {
    // Each theme has two possible preprocess functions that can act on a hook.
    // This function only applies to this hook.
    $functions[1] = $theme .'_preprocess_'. $hook;
    foreach ($functions AS $key => $function) {
      // Add any functions that are not already in the registry.
      if (function_exists($function) && !in_array($function, $existing[$hook]['preprocess functions'])) {
        // We add the preprocess function to the end of the existing list.
        $existing[$hook]['preprocess functions'][] = $function;
      }
    }
  }
  // Since we modify the $existing cache directly, return nothing.
  return array();
}