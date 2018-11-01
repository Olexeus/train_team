<?php

if ( ! defined( 'ABSPATH' ) ) exit;

// validate our options
function ttv_ezembed_options_wall_validate($input) {
$i = 0;
$new_input = array();
$sanitized_colour_theme = '';
$sanitized_publish_status = '';
        if( isset( $input['twitch_settings_game'] ) ) {
            if ($input['twitch_settings_game'] !== '') $i++;
            $new_input['twitch_settings_game'] = sanitize_text_field( $input['twitch_settings_game'] );
        }
        if( isset( $input['twitch_settings_channel'] ) ) {
            if ($input['twitch_settings_channel'] !== '') $i++;
            $new_input['twitch_settings_channel'] = sanitize_text_field( $input['twitch_settings_channel'] );
        }
        if( isset( $input['twitch_settings_team'] ) ) {
            if ($input['twitch_settings_team'] !== '') $i++;
            $new_input['twitch_settings_team'] = sanitize_text_field( $input['twitch_settings_team'] );
        }
        if ($i > 1) {
          add_settings_error('twitch_settings_game', 'channel-game-error', 'You must choose either GAME or CHANNEL or TEAM. Only one will work at a time.', 'error');
        }
        if( isset( $input['twitch_settings_language'] ) )
            $new_input['twitch_settings_language'] = sanitize_text_field( $input['twitch_settings_language'] );

        if( isset($input['twitch_settings_limit']) && ($input['twitch_settings_limit'] < 21 ) ) {
                $new_input['twitch_settings_limit'] = sanitize_text_field( $input['twitch_settings_limit'] );
            } else {
                $new_input['twitch_settings_limit'] = 20;
            }

        if( isset( $input['twitch_appearance_colour_theme'] ) ) {
            // Should only be set to either 'dark-theme' or 'light-theme'.
            $sanitized_colour_theme = sanitize_text_field( $input['twitch_appearance_colour_theme'] );
            if ($sanitized_colour_theme !== 'light-theme' && $sanitized_colour_theme !== 'dark-theme') {
                $new_input['twitch_appearance_colour_theme'] = 'dark-theme';
            } else {
                $new_input['twitch_appearance_colour_theme'] = $sanitized_colour_theme;
            }
        }
        
        if( isset( $input['twitch_settings_channel_offline'] ) ) {
                $new_input['twitch_settings_channel_offline'] = (int) $input['twitch_settings_channel_offline'];
            } else {
                $new_input['twitch_settings_channel_offline'] = 0;
            }       
            
        if( isset( $input['twitch_settings_show_default'] ) ) {
                $new_input['twitch_settings_show_default'] = (int) $input['twitch_settings_show_default'];
            } else {
                $new_input['twitch_settings_show_default'] = 0;
            }              
            
        return $new_input;
}
?>