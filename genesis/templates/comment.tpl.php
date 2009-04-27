<?php
// $Id$

/**
 * @file comment.tpl.php
 * Default theme implementation for comments.
 *
 * These two variables are provided for context.
 * - $comment: Full comment object.
 * - $node: Node object the comments are attached to.
 *
 * @see template_preprocess_comment()
 * @see theme_comment()
 */
?>
<div class="<?php print $comment_classes; ?>">
  <div class="comment-inner inner">

    <?php if ($title): ?>
      <h3 class="comment-title">
        <span class="comment-id"><?php print '#'. $id; ?></span> 
        <?php print $title; ?> 
        <?php if ($comment->new): ?>
          <span class="new"><?php print $new; ?></span>
        <?php endif; ?>
								<?php print $unpublished; ?>
      </h3>
    <?php endif; ?>

    <?php print $picture; ?>

    <?php if ($submitted): ?>
      <div class="comment-submitted"><?php print $submitted; ?></div>
    <?php endif; ?>

    <div class="comment-content">
      <?php print $content; ?>
      <?php if ($signature): ?>
        <div class="user-signature clearfix"><?php print $signature; ?></div>
      <?php endif; ?>
    </div>

    <?php if ($links): ?>
      <div class="comment-links"><?php print $links; ?></div>
    <?php endif; ?>

  </div>
</div> <!-- /comment-inner, /comment -->