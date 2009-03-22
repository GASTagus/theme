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
<div id="node-<?php print $node->nid; ?>" class="<?php print $node_classes; ?>">
  <div class="node-inner inner">

				<?php if ($page == 0): ?>
						<h2 class="node-title"><a href="<?php print $node_url; ?>" rel="bookmark"><?php print $title; ?></a></h2>
				<?php endif; ?>

				<?php if ($unpublished): ?>
						<div class="unpublished"><?php print t('Unpublished'); ?></div>
				<?php endif; ?>

				<?php if ($submitted): ?>
					<div class="node-submitted">
							<?php print $submitted; ?>
					</div>
				<?php endif; ?>

				<?php print $picture; ?>

				<div class="node-content">
						<?php print $content; ?>
				</div>

				<?php if (count($taxonomy)): ?>
						<div class="node-terms"><?php print $terms; ?></div>
				<?php endif; ?>

				<?php if ($links): ?>
						<div class="node-links"><?php print $links; ?></div>
				<?php endif; ?>

	 </div>
</div> <!-- /node -->