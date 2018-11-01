<?php

if ( ! defined( 'ABSPATH' ) ) exit;

// validate our options
function ttv_ezembed_options_validate($input) {
$new_input = array();
$sanitized_colour_theme = '';
$sanitized_publish_status = '';
        if( isset( $input['twitch_settings_game'] ) ) {
            $new_input['twitch_settings_game'] = sanitize_text_field( $input['twitch_settings_game'] );
            if (($input['twitch_settings_game'] !== '' ) &&  ($input['twitch_settings_channel'] !== '')) {
              add_settings_error('twitch_settings_game', 'channel-game-error', 'You must choose either GAME or CHANNEL. Not both.', 'error');
            }
        }
        if( isset( $input['twitch_settings_channel'] ) )
            $new_input['twitch_settings_channel'] = sanitize_text_field( $input['twitch_settings_channel'] );

        if( isset( $input['twitch_settings_team'] ) )
            $new_input['twitch_settings_team'] = sanitize_text_field( $input['twitch_settings_team'] );

        if( isset( $input['twitch_settings_language'] ) )
            $new_input['twitch_settings_language'] = sanitize_text_field( $input['twitch_settings_language'] );

        if( isset( $input['twitch_settings_limit'] ) )
            $new_input['twitch_settings_limit'] = sanitize_text_field( $input['twitch_settings_limit'] );

        if( isset( $input['twitch_settings_channel_offline'] ) ) {
                $new_input['twitch_settings_channel_offline'] = (int) $input['twitch_settings_channel_offline'];
            } else {
                $new_input['twitch_settings_channel_offline'] = 0;
            }

        if( isset( $input['twitch_settings_title'] ) )
            $new_input['twitch_settings_title'] = sanitize_text_field( $input['twitch_settings_title'] );

        if( isset( $input['twitch_settings_subtitle'] ) )
            $new_input['twitch_settings_subtitle'] = sanitize_text_field( $input['twitch_settings_subtitle'] );

        if( isset( $input['twitch_settings_button_text'] ) )
            $new_input['twitch_settings_button_text'] = sanitize_text_field( $input['twitch_settings_button_text'] );

        if( isset( $input['twitch_settings_button_link'] ) )
            $new_input['twitch_settings_button_link'] = esc_url($input['twitch_settings_button_link']);

        if( isset( $input['twitch_appearance_colour_theme'] ) ) {
            // Should only be set to either 'dark-theme' or 'light-theme'.
            $sanitized_colour_theme = sanitize_text_field( $input['twitch_appearance_colour_theme'] );
            if ($sanitized_colour_theme !== 'light-theme' && $sanitized_colour_theme !== 'dark-theme') {
                $new_input['twitch_appearance_colour_theme'] = 'dark-theme';
            } else {
                $new_input['twitch_appearance_colour_theme'] = $sanitized_colour_theme;
            }
        }

        if( isset( $input['twitch_appearance_secondary_colour'] ) )
        if (empty($input['twitch_appearance_secondary_colour'])) {
            $new_input['twitch_appearance_secondary_colour'] = '#7f1618';
        } else {
            $new_input['twitch_appearance_secondary_colour'] = sanitize_text_field( $input['twitch_appearance_secondary_colour'] );
        }

        if( isset( $input['twitch_settings_publish_status'] ) ) {
            // Should only be set to either 'published' or 'not-published'.
            $sanitized_publish_status = sanitize_text_field( $input['twitch_settings_publish_status'] );
            if ($sanitized_publish_status !== 'published' && $sanitized_publish_status !== 'not-published') {
                $new_input['twitch_settings_publish_status'] = 'not-published';
            } else {
                $new_input['twitch_settings_publish_status'] = $sanitized_publish_status;
            }
        }

        if( isset( $input['twitch_appearance_font1'] ) ) {
            // Should default to 'Arial Black' if empty.
            if (empty($input['twitch_appearance_font1'])) {
                $new_input['twitch_appearance_font1'] = 'Arial Black';
            } else {
                $new_input['twitch_appearance_font1'] = sanitize_text_field( $input['twitch_appearance_font1'] );
            }
        }

        if( isset( $input['twitch_appearance_font2'] ) ) {
            // Should default to 'Arial' if empty.
            if (empty($input['twitch_appearance_font1'])) {
                $new_input['twitch_appearance_font2'] = 'Arial';
            } else {
                $new_input['twitch_appearance_font2'] = sanitize_text_field( $input['twitch_appearance_font2'] );
            }
        }
        
        if( isset( $input['twitch_links_click'] ) ) {
                $new_input['twitch_links_click'] = (int) $input['twitch_links_click'];
            } else {
                $new_input['twitch_links_click'] = 0;
            }
            
        if( isset( $input['twitch_links_chat'] ) ) {
                $new_input['twitch_links_chat'] = (int) $input['twitch_links_chat'];
            } else {
                $new_input['twitch_links_chat'] = 0;
            }            

        return $new_input;
}
?>
