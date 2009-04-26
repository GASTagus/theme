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
 * Override or insert variables into page templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called.
 */
function genesis_preprocess_page(&$vars, $hook) {
  global $theme;

  // Don't display empty help from node_help().
  if ($vars['help'] == "<div class=\"help\"> \n</div>") {
    $vars['help'] = '';
  }

  // Set variables for the logo and site_name.
  if ($vars['logo']) {
    $vars['site_logo'] = '<a href="'. $vars['front_page'] .'" title="'. t('Home page') .'" rel="home"><img src="'. $vars['logo'] .'" alt="'. $vars['site_name'] .' '. t('logo') .'" /></a>';
  }

  if ($vars['site_name']) {
    $vars['site_name'] = '<a href="'. $vars['front_page'] .'" title="'. t('Home page') .'" rel="home">'. $vars['site_name'] .'</a>';
  }

  // Set variables for the primary and secondary links.
  $vars['primary_menu'] = theme('links', $vars['primary_links'], array('class' => 'links primary-links'));
  $vars['secondary_menu'] = theme('links', $vars['secondary_links'], array('class' => 'links secondary-links'));

  // Page classes (these are not $body_classes, they are seperate variables in Genesis).
  $page_classes = array();
  if (!$vars['is_front']) {
    // Add classes for each page and section.
    $path = drupal_get_path_alias($_GET['q']);
    list($section, ) = explode('/', $path, 2);
    $page_classes[] = safe_string('section-'. $section);
    $page_classes[] = safe_string('page-'. $path);
    if (arg(0) == 'node') {
      if (arg(1) == 'add') {
        $page_classes[] = 'node-add'; // Add .node-add class.
      }
      elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
        $page_classes[] = 'node-'. arg(2); // Add .node-edit or .node-delete classes.
      }
    }
  }
  // Don't print on the front page.
  if (!$vars['is_front']) {
    $vars['page_classes'] = 'class="'. implode(' ', $page_classes) .'"'; // Concatenate with spaces.
  }
}

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called.
 */
function genesis_preprocess_node(&$vars, $hook) {
  global $user;

  // Special classes for nodes
  $node_classes = array();
  $node_classes[] = 'node';
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
    // Node is authored by current user.
    $node_classes[] = 'node-mine';
  }
  if ($vars['teaser']) {
    // Node is displayed as teaser.
    $node_classes[] = 'node-teaser';
  }
  if (!$vars['teaser']) {
    // Node is displayed as teaser.
    $node_classes[] = 'node-view';
  }
  // Class for node type: "node-type-page", "node-type-story", "node-type-my-custom-type", etc.
  $node_classes[] = 'node-type-'. $vars['node']->type;
  $vars['node_classes'] = implode(' ', $node_classes); // Concatenate with spaces.
		
		// Set messages if node is unpublished.
  if (!$vars['node']->status) {
		  if ($vars['page']) {
				  drupal_set_message(t('This node is currently unpublished.'), $type = 'warning');
				}
				else {
			   $vars['unpublished'] = '<span class="unpublished">'. t('Unpublished') .'</span>';
				}
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
function genesis_preprocess_comment(&$vars, $hook) {
  global $user;

  // Load the node object that the current comment is attached to.
  $node = node_load($vars['comment']->nid);
  // If the author is equal to the author of the node, set a variable.
  $vars['author_comment'] = $vars['comment']->uid == $node->uid ? TRUE : FALSE;

  $comment_classes = array();
  $comment_classes[] = 'comment';
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
    // Comment is by the node author.
    $comment_classes[] = 'comment-by-author';
  }
  if ($vars['comment']->uid == 0) {
    // Comment is by an anonymous user.
    $comment_classes[] = 'comment-by-anon';
  }
  if ($user->uid && $vars['comment']->uid == $user->uid) {
    // Comment was posted by current user.
    $comment_classes[] = 'comment-mine';
  }
  $vars['comment_classes'] = implode(' ', $comment_classes);

  // If comment subjects are disabled, don't display them.
  if (variable_get('comment_subject_field', 1) == 0) {
    $vars['title'] = '';
  }
		
		// Set messages if comment is unpublished.
		$message = t('Comment'). ' #'. $vars['id'] . t(' is currently unpublished.');
  if ($vars['comment']->status == COMMENT_NOT_PUBLISHED) {
				drupal_set_message($message, $type = 'warning');
				$vars['unpublished'] = '<span class="unpublished">'. t('Unpublished') .'</span>';
  }
}

/**
 * Add a "Comments" heading above comments except on forum pages.
 */
function genesis_preprocess_comment_wrapper(&$vars) {
  if ($vars['content'] && $vars['node']->type != 'forum') {
    $vars['content'] = '<h2 id="comment-wrapper-title">'. t('Comments') .'</h2>'.  $vars['content'];
  }
}

/**
 * Override or insert variables into block templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called.
 */
function genesis_preprocess_block(&$vars, $hook) {
  $block = $vars['block'];

  // Special classes for blocks
  $block_classes = array();
  $block_classes[] = 'block';
  $block_classes[] = 'block-'. $block->module;
  $block_classes[] = $vars['block_zebra'] .'-block';
  //$block_classes[] = 'block-'. $block->region;
  $block_classes[] = 'block-count-'. $vars['id'];
  $vars['block_classes'] = implode(' ', $block_classes);

  if (user_access('administer blocks')) {
    // Display 'edit block' for custom blocks.
    if ($block->module == 'block') {
      $edit_links[] = l( t('edit block'), 'admin/build/block/configure/'. $block->module .'/'. $block->delta, array('title' => t('edit the content of this block'), 'class' => 'block-edit'), drupal_get_destination(), NULL, FALSE, TRUE);
    }
    // Display 'configure' for other blocks.
    else {
      $edit_links[] = l(t('configure'), 'admin/build/block/configure/'. $block->module .'/'. $block->delta, array('title' => t('configure this block'), 'class' => 'block-config'), drupal_get_destination(), NULL, FALSE, TRUE);
    }
    // Display 'edit menu' for menu blocks.
    if (($block->module == 'menu' || ($block->module == 'user' && $block->delta == 1)) && user_access('administer menu')) {
      $edit_links[] = l(t('edit menu'), 'admin/build/menu', array('title' => t('edit the menu that defines this block'), 'class' => 'block-edit-menu'), drupal_get_destination(), NULL, FALSE, TRUE);
    }
    $vars['edit_links_array'] = $edit_links;
    $vars['edit_links'] = '<div class="edit">'. implode(' ', $edit_links) .'</div>';
  }
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

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return
 *   A string containing the breadcrumb output.
 */
function genesis_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    return implode(' » ', $breadcrumb);
  }
}

/**
 * Implements HOOK_theme().
 *
 * The Zen base theme (where this comes from) uses this function as a work-around 
 * for a bug in Drupal 6.0-6.4: #252430 (Allow BASETHEME_ prefix in preprocessor 
 * function names).
 *
 * Sub-themes also use this function by calling it from their HOOK_theme() in
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