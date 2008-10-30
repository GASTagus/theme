<?php
// $Id$

/**
 * @file comment-wrapper.tpl.php
 * Default theme implementation to wrap comments.
 *
 * @see template_preprocess_comment_wrapper()
 * @see theme_comment_wrapper()
 */
?>
<?php if ($content): ?>
  <div id="comments">

    <?php if ($node->type != 'forum'): ?>
      <h2 id="comment-wrapper-title"><?php print t('Comments'); ?></h2>
    <?php endif; ?>

    <?php print $content; ?>

  </div>
<?php endif; ?> <!-- /silence coder -->