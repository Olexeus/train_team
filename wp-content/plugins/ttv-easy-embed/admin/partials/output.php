<?php
$twitchOptions = get_option('ttv_ezembed_options');
$appearanceOptions = get_option('ttv_ezembed_appearance_options');
$defaultTheme = (empty($appearanceOptions['twitch_appearance_colour_theme']) ? 'dark-theme' : sanitize_text_field($appearanceOptions['twitch_appearance_colour_theme']));
$output = '';
$output .= '<!--Start of Twitch TV Rail-->';
if (sanitize_text_field($twitchOptions['twitch_settings_publish_status']) == 'published' || (isset($_GET['page'])) == 'twitch-tv-rail') {
$output .= '<div id="twitch-module" class="'.sanitize_text_field($appearanceOptions['twitch_appearance_colour_theme']).'">
  <div class="twitch-module-wrapper">
    <div class="twitch-module-header">
      <div class="twitch-module-header-left">
        <div class="twitch-logo"><img src="'.plugins_url("../../includes/img/twitch-logo-".$defaultTheme.".svg", __FILE__).'"></div>
      <div><span>'.sanitize_text_field($twitchOptions['twitch_settings_title']).'</span></div>
        <div><span>'.sanitize_text_field($twitchOptions['twitch_settings_subtitle']).'</span></div></div>';
if ($twitchOptions['twitch_settings_button_text'] !== '') {
    $output .= '<a href="'.esc_url($twitchOptions['twitch_settings_button_link']).'" class="find-out-more">'.sanitize_text_field($twitchOptions['twitch_settings_button_text']).'</a>';
}
$output .= '</div>
      <div id="stream-container">
        <ul class="slides">
        </ul>
      </div>
      <span class="offline-slide">All streams are currently offline.</span>
    </div>
  </div>';
$output .= '<style>
.flex-direction-nav .flex-next {background-image:url('.plugins_url('../img/right-chevron.svg', __FILE__ ).')}
.flex-direction-nav .flex-prev {background-image:url('.plugins_url('../img/left-chevron.svg', __FILE__ ).')}
#twitch-module .twitch-module-header a.find-out-more {background:'.sanitize_text_field($appearanceOptions['twitch_appearance_secondary_colour']).'}
#twitch-module .twitch-module-header .twitch-module-header-left a {color:'.sanitize_text_field($appearanceOptions['twitch_appearance_secondary_colour']).'}
#twitch-module #stream-container .flex-prev:hover, #stream-container .flex-next:hover {background-color:'.sanitize_text_field($appearanceOptions['twitch_appearance_secondary_colour']).'}
#twitch-module .twitch-module-header a.find-out-more, #twitch-module .twitch-module-header span, #twitch-module #stream-container ul li.offline-slide, #twitch-module .stream #twitch-title  {font-family:'.sanitize_text_field($appearanceOptions['twitch_appearance_font1']).', arial}
#twitch-module .stream #twitch-meta {font-family:'.sanitize_text_field($appearanceOptions['twitch_appearance_font2']).', arial}
#twitch-module #stream-container .flex-nav-next:hover, #stream-container .flex-nav-prev:hover {background-color:'.sanitize_text_field($appearanceOptions['twitch_appearance_secondary_colour']).'}
</style>';
$output .= '<script type="text/javascript">
( function( $ ) {';
if ($twitchOptions['twitch_settings_game'] != '') {
$output .= 'var url ="https://api.twitch.tv/kraken/streams?game='.sanitize_text_field($twitchOptions['twitch_settings_game']).'";';
}
if ($twitchOptions['twitch_settings_channel'] != '') {
$output .= 'var url ="https://api.twitch.tv/kraken/streams?channel='.sanitize_text_field($twitchOptions['twitch_settings_channel']).'";';
}
$output .= 'var streaming;
$.ajax({
    url: url,
    type: \'GET\',
    headers: {
       \'Client-ID\': \'c9y13nevu8fzazuq2ty6zdqz9f7xlem\'
    },
    success: function(data)
  {
    for (var i in data.streams) {
      var display_name = data.streams[i].channel.display_name;
      var channel_name = data.streams[i].channel.status
      var preview = data.streams[i].preview.large;
      var game = data.streams[i].game;
      var url = data.streams[i].channel.url;
      var viewers = data.streams[i].viewers;
      var stream = \'<li class="stream"><a target="_blank" href="\'+url+\'" title="Watch \'+display_name+\' Now!"><div class="twitch-image"><img src="\'+preview+\'"></div><div class="twitch-info"><div class="twitch-title">"\'+channel_name+\'"</div><div class="twitch-meta"><span class="twitch-name">"\'+display_name+\'"</span> playing <span class="twitch-game">\'+game+\'</span> @ <span class="twitch-viewers">\'+ viewers+ \' viewers</span></div></a></li>\'
      $("#stream-container ul li.offline-slide").remove()
      $(stream).appendTo("#stream-container ul")
  }
  if ($(".stream").length > 4) {
    $("#stream-container ul").slick({
        dots: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        swipeToSlide: true,
        prevArrow: \'<button type="button" class="slick-prev"><img src="'.plugins_url("../../includes/img/slick-left-".$defaultTheme.".svg", __FILE__).'"></button>\',
        nextArrow: \'<button type="button" class="slick-next"><img src="'.plugins_url("../../includes/img/slick-right-".$defaultTheme.".svg", __FILE__).'"></button>\',
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2
            }
          },
          {
            breakpoint: 560,
            settings: {
              slidesToShow: 1
            }
          }
        ]
    })
    }
}
});
} )( jQuery );
</script>'; } else {
$output .= '<!--Twitch TV Rail Not Published-->';
};
$output .= '<!--End of Twitch TV Rail-->';
echo $output;
