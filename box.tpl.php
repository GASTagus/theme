<?php
// $Id$

/**
 * @file box.tpl.php
 * Theme implementation to display a box.
 *
 * @see template_preprocess()
 */
?>
<div class="box">
 <div class="box-inner">

		<?php if ($title): ?>
			<h2><?php print $title ?></h2>
		<?php endif; ?>

		<div class="content"><?php print $content ?></div>

	</div>
</div>