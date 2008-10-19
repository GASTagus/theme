<?php 
// $Id$

/**
 * @file node.tpl.php
 * Theme implementation to display a node.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 */
?>
<div class="node <?php print $node_classes; ?>" id="node_<?php print $node->nid; ?>">
  <div class="node-inner inner">

		<?php if ($page == 0): ?>
			<h2 class="title"><a href="<?php print $node_url; ?>" rel="bookmark"><?php print $title; ?></a></h2>
		<?php endif; ?>

		<?php if ($unpublished): ?>
			<div class="unpublished"><?php print t('Unpublished'); ?></div>
		<?php endif; ?>

		<?php if ($submitted): ?>
			<div class="submitted">
				<abbr class="date" title="<?php print $long_date; ?>"> <?php print $short_date; ?></abbr>
				<span class="author"><?php print t(' by ') . $name; ?></span>
			</div>
		<?php endif; ?>

		<?php if (!empty($picture)): ?>
			<div class="picture">
				<?php print $picture; ?>
			</div>
		<?php endif; ?>

		<?php print $content; ?>

		<?php if (count($taxonomy)): ?>
			<div class="tags"><?php print $terms; ?></div>
		<?php endif; ?>

		<?php if ($links): ?>
			<div class="actions"><?php print $links; ?></div>
		<?php endif; ?>

	</div>
</div> <!-- /node -->