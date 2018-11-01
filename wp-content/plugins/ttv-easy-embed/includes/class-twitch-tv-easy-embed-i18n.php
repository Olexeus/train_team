<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.jamieburleigh.co.uk
 * @since      1.0.0
 *
 * @package    Twitch_Tv_Easy_Embed
 * @subpackage Twitch_Tv_Easy_Embed/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Twitch_Tv_Easy_Embed
 * @subpackage Twitch_Tv_Easy_Embed/includes
 * @author     Jamie Burleigh <j.burleigh1@gmail.com>
 */
class Twitch_Tv_Easy_Embed_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'twitch-tv-easy-embed',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
