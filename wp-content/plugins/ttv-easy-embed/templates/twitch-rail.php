<div id="twitch-module" class="twitch-rail twitch-rail-<?php echo $id; ?> <?php echo $defaultTheme; ?> loading">
  <div class="twitch-module-wrapper">
    <div class="twitch-module-header <?php echo (($buttonText !== '') ? 'cta-active' : ''); ?>">
      <div class="twitch-module-header-left">
        <div class="twitch-logo"><img src="<?php echo plugins_url("../public/img/twitch-logo-".$defaultTheme.".svg", __FILE__) ?>"></div>
        <div class="twitch-module-header-title"><span><?php echo $twitchTitle; ?></span></div>
        <div class="twitch-module-header-subtitle"><span><?php echo $twitchSubtitle; ?></span></div></div>
  <?php if ($buttonText !== '') { ?>
    <a href="<?php echo esc_url($buttonLink); ?>" class="find-out-more"><?php echo $buttonText; ?></a>
  <?php } ?>
  </div>
  <div id="stream-container">
    <ul class="slides">
    </ul>
    <div class="offline-slide">All streams are currently offline.</div>
    <div class="loader-wrapper">
      <div class="loader">Loading...</div>
    </div>
  </div>
  </div>
</div>
