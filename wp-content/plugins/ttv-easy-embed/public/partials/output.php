<?php
$id = 0;
$twitchOptions = get_option('ttv_ezembed_options');
$appearanceOptions = get_option('ttv_ezembed_appearance_options');
$linkOptions = get_option('ttv_ezembed_link_options');
$defaultTheme = (empty($appearanceOptions['twitch_appearance_colour_theme']) ? 'dark-theme' : sanitize_text_field($appearanceOptions['twitch_appearance_colour_theme']));
$buttonText = sanitize_text_field($appearanceOptions['twitch_settings_button_text']);
$buttonLink = sanitize_text_field($appearanceOptions['twitch_settings_button_link']);
$twitchTitle = sanitize_text_field($appearanceOptions['twitch_settings_title']);
$twitchSubtitle = sanitize_text_field($appearanceOptions['twitch_settings_subtitle']);
$twitchGames = sanitize_text_field($twitchOptions['twitch_settings_game']);
$twitchNames = str_replace(' ', '', sanitize_text_field($twitchOptions['twitch_settings_channel']));
$twitchTeam = sanitize_text_field($twitchOptions['twitch_settings_team']);
$language = sanitize_text_field($twitchOptions['twitch_settings_language']);
$secondaryColour =  sanitize_text_field($appearanceOptions['twitch_appearance_secondary_colour']);
$primaryFont = sanitize_text_field($appearanceOptions['twitch_appearance_font1']);
$secondaryFont = sanitize_text_field($appearanceOptions['twitch_appearance_font2']);
$clickOptions = sanitize_text_field($linkOptions['twitch_links_click']);
  include (plugin_dir_path( __FILE__ ) . '../../templates/twitch-rail.php' );
  include (plugin_dir_path( __FILE__ ) . '../../templates/twitch-styles.php');
?>
