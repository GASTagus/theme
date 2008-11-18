<?php 
// $Id$

/**
 * @file block.tpl.php
	*
 * Theme implementation to display a block.
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
?>
<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="block <?php print $block_classes; ?>">
  <div class="block-inner inner">

    <?php if ($block->subject): ?>
      <h2 class="block-title"><?php print $block->subject; ?></h2>
    <?php endif; ?>

    <div class="block-content">
      <?php print $block->content ?>
    </div>

    <?php
    /**
     * To disable block edit links for your subtheme, 
     * copy this file to your subtheme and either 
     * remove or comment out the $edit_links variable.
     * You should unset the block-edit.css in your
     * genesis_subtheme.info file also.
     */
    ?>
    <?php print $edit_links; ?>

  </div>
</div>