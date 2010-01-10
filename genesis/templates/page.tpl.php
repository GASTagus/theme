<?php
// $Id$

/**
 * @file page.tpl.php
 * Theme implementation to display a single Drupal page.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
?>

    <?php if ($page['leaderboard']): ?>
      <div id="leaderboard" class="region clearfix">
        <div class="leaderboard-inner inner"><?php print render($page['leaderboard']); ?></div>
      </div>
    <?php endif; ?>

    <div id="header-nav">
      <div id="header" class="clearfix">
        <div class="header-inner inner">

          <?php if ($logo || $site_name || $site_slogan): ?>
            <div id="branding">
            
    <!-- default site information -->
      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>

      <?php if ($site_name || $site_slogan): ?>
        <div id="name-and-slogan">
          <?php if ($site_name): ?>
            <?php if ($title): ?>
              <div id="site-name"><strong>
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </strong></div>
            <?php else: /* Use h1 when the content title is empty */ ?>
              <h1 id="site-name">
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </h1>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ($site_slogan): ?>
            <div id="site-slogan"><?php print $site_slogan; ?></div>
          <?php endif; ?>
        </div> <!-- /#name-and-slogan -->
      <?php endif; ?>
      <!-- // END default site information -->
      
            </div>
          <?php endif; ?>

          <?php if ($page['header']): ?>
            <div id="header-blocks" class="region">
              <div class="region-inner inner"><?php print render($page['header']); ?></div>
            </div>
          <?php endif; ?>

        </div>
      </div>

      <?php if ($main_menu or $secondary_menu): ?>
        <div id="nav">
          <div class="nav-inner">
            <?php if ($main_menu): ?>
              <div id="primary" class="clearfix">
                <div class="primary-inner">
<?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'clearfix')), 'heading' => t('Main menu'))); ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if ($secondary_menu): ?>
              <div id="secondary" class="clearfix">
                <div class="secondary-inner">
 <?php print theme('links__system_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary-menu', 'class' => array('links', 'clearfix')), 'heading' => t('Secondary menu'))); ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>

    </div>

    <?php if ($breadcrumb): ?>
      <div id="breadcrumb">
        <div class="breadcrumb-inner inner"><?php print $breadcrumb; ?></div>
      </div>
    <?php endif; ?>

    <?php if ($page['secondary_content']): ?>
      <div id="secondary-content" class="region clear clearfix">
        <div class="region-inner inner"><?php print render($page['secondary_content']); ?></div>
      </div>
    <?php endif; ?>

    <div id="columns" class="clear">
     
      <div id="content-column">
        <div class="content-inner">

          <?php if ($page['content_top']): ?>
            <div id="content-top" class="region"><?php print render($page['content_top']); ?></div>
          <?php endif; ?>
          
        <?php if ($page['highlight']): ?><div id="highlight"><?php print render($page['highlight']); ?></div><?php endif; ?>
        <a id="main-content"></a>
        
          <div id="main-content">
            <?php print render($title_prefix); ?>							
            <?php if ($title): ?>
              <h1 id="page-title"><?php print $title; ?></h1>
            <?php endif; ?>
            <?php print render($title_suffix); ?>
            
            <?php if ($tabs): ?>
              <div class="local-tasks"><?php print render($tabs); ?></div>
            <?php endif; ?>

            <?php print $messages; ?>
            <?php print render($page['help']); ?>

            <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
        
            <div id="content">
              <?php print render($page['content']); ?>
            </div>								
          </div>

          <?php if ($page['content_bottom']): ?>
            <div id="content-bottom" class="region"><?php print render($page['content_bottom']); ?></div>
          <?php endif; ?>

        </div>
      </div>

      <?php if ($page['sidebar_first']): ?>
        <div id="sidebar-first"><?php print render($page['sidebar_first']); ?></div>
      <?php endif; ?>

      <?php if ($page['sidebar_second']): ?>
        <div id="sidebar-second"><?php print render($page['sidebar_second']); ?></div>
      <?php endif; ?>

    </div>

    <?php if ($page['tertiary_content']): ?>
      <div id="tertiary-content" class="region clear clearfix">
        <div class="region-inner inner"><?php print render($page['tertiary_content']); ?></div> 
      </div>
    <?php endif; ?>

    <?php if ($page['footer']): ?>
      <div id="foot-wrapper" class="clear clearfix">
				

        <?php print render($page['footer']); ?>
        <?php print $feed_icons; ?>

      </div>
    <?php endif; ?>
