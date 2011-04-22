<?php
// $Id$

/**
 * Preprocess and Process Functions SEE: http://drupal.org/node/254940#variables-processor
 * 1. Rename each function to match your subthemes name,
 *    e.g. if you name your theme "themeName" then the function
 *    name will be "themeName_preprocess_hook". Tip - you can
 *    search/replace on "genesis_gastagus".
 * 2. Uncomment the required function to use.
 */

/**
 * Override or insert variables into all templates.
 */
/* -- Delete this line if you want to use these functions
function genesis_gastagus_preprocess(&$vars, $hook) {
}
function genesis_gastagus_process(&$vars, $hook) {
}
// */

/**
 * Override or insert variables into the html templates.
 */
/* -- Delete this line if you want to use these functions
function genesis_gastagus_preprocess_html(&$vars) {
  // Uncomment the folowing line to add a conditional stylesheet for IE 7 or less.
  // drupal_add_css(path_to_theme() . '/css/ie/ie-lte-7.css', array('weight' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'preprocess' => FALSE));
}
function genesis_gastagus_process_html(&$vars) {
}
// */

/**
 * Override or insert variables into the page templates.
 */
/* -- Delete this line if you want to use these functions
function genesis_gastagus_preprocess_page(&$vars) {
}
function genesis_gastagus_process_page(&$vars) {
}
// */

/**
 * Override or insert variables into the node templates.
 */
/* -- Delete this line if you want to use these functions
function genesis_gastagus_preprocess_node(&$vars) {
}
function genesis_gastagus_process_node(&$vars) {
}
// */

/**
 * Override or insert variables into the comment templates.
 */
/* -- Delete this line if you want to use these functions
function genesis_gastagus_preprocess_comment(&$vars) {
}
function genesis_gastagus_process_comment(&$vars) {
}
// */

/**
 * Override or insert variables into the block templates.
 */
/* -- Delete this line if you want to use these functions
function genesis_gastagus_preprocess_block(&$vars) {
}
function genesis_gastagus_process_block(&$vars) {
}
// */

// Put this in template.tpl - Yodiaditya - yoodey.com
function genesis_gastagus_page_alter($page) {
   $meta_description = array(
            '#type' => 'html_tag',
            '#tag' => 'meta',
            '#attributes' => array(
                'name' => 'description',
                'content' =>  'O GASTagus é uma associação juvenil sem fins lucrativos sediada no Instituto Superior Técnico, cujo objectivo é alertar e sensibilizar a juventude para a importância da dignidade da pessoa humana e para as desigualdades sociais que persistem no mundo em que vivemos, através do trabalho voluntário em Portugal e África.'
            )
   ); 
}
