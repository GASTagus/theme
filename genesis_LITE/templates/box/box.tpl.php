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

  <?php if ($title): ?>
    <h2 class="title"><?php print $title ?></h2>
  <?php endif; ?>

  <?php print $content ?>

</div>