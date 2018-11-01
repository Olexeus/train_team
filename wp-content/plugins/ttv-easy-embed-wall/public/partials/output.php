<?php
$id = 0;
$twitchOptions = get_option('ttv_ezembed_options_wall');
$appearanceOptions = get_option('ttv_ezembed_appearance_options_wall');
$linkOptions = get_option('ttv_ezembed_link_options');
$defaultTheme = (empty($appearanceOptions['twitch_appearance_colour_theme']) ? 'dark-theme' : sanitize_text_field($appearanceOptions['twitch_appearance_colour_theme']));
$twitchGames = sanitize_text_field($twitchOptions['twitch_settings_game']);
$twitchNames = str_replace(' ', '', sanitize_text_field($twitchOptions['twitch_settings_channel']));
$twitchTeam = sanitize_text_field($twitchOptions['twitch_settings_team']);
$language = sanitize_text_field($twitchOptions['twitch_settings_language']);
$limit = sanitize_text_field($twitchOptions['twitch_settings_limit']);
  include (plugin_dir_path( __FILE__ ) . '../../templates/twitch-wall.php' );
?>