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
<div class="comment <?php print $comment_classes; ?>">
  <div class="comment-inner inner">

		<?php if ($title): ?>
		  <h3 class="comment-title">
		    <?php print '#'. $id .' '. $title; ?> <?php if ($comment->new): ?><span class="new"><?php print $new; ?></span><?php endif; ?>
		  </h3>
		  <?php elseif ($comment->new): ?><div class="new"><?php print $new; ?></div>
		<?php endif; ?>

		<?php if ($unpublished): ?>
			 <div class="unpublished"><?php print t('Unpublished'); ?></div>
		<?php endif; ?>

		<?php if ($picture): ?>
		  <div class="picture"><?php print $picture; ?></div>
		<?php endif; ?>

		<?php if ($submitted): ?>
		  <div class="submitted">
				  <?php print $submitted; ?>
			 </div>
		<?php endif; ?>

		<div class="comment-content">
			<?php print $content; ?>
			<?php if ($signature): ?>
			  <div class="user-signature clear-block">
					  <?php print $signature; ?>
				 </div>
			<?php endif; ?>
		</div>

		<?php if ($links): ?>
			 <div class="links">
				  <?php print $links; ?>
			 </div>
		<?php endif; ?>

  </div>
</div> <!-- /comment-inner, /comment -->