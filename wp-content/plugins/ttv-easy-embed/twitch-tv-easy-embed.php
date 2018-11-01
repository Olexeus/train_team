<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.streamweasels.com
 * @since             1.2
 * @package           Twitch_Tv_Easy_Embed
 *
 * @wordpress-plugin
 * Plugin Name:       Twitch TV Easy Embed (Rail)
 * Plugin URI:        https://www.streamweasels.com
 * Description:       Easily embed a group of Twitch Streams in your site with a simple shortcode and easy admin menu.
 * Version:           1.9.3
 * Author:            StreamWeasels
 * Author URI:        https://www.streamweasels.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       twitch-tv-easy-embed
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_VERSION', '1.9.3' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-twitch-tv-easy-embed-activator.php
 */
function activate_twitch_tv_easy_embed() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twitch-tv-easy-embed-activator.php';
	Twitch_Tv_Easy_Embed_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-twitch-tv-easy-embed-deactivator.php
 */
function deactivate_twitch_tv_easy_embed() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twitch-tv-easy-embed-deactivator.php';
	Twitch_Tv_Easy_Embed_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_twitch_tv_easy_embed' );
register_deactivation_hook( __FILE__, 'deactivate_twitch_tv_easy_embed' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-twitch-tv-easy-embed.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_twitch_tv_easy_embed() {

	$plugin = new Twitch_Tv_Easy_Embed();
	$plugin->run();

}
run_twitch_tv_easy_embed();
