<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              none
 * @since             1.0.0
 * @package           Twitch_Wall
 *
 * @wordpress-plugin
 * Plugin Name:       Twitch TV Easy Embed (Wall)
 * Plugin URI:        https://www.streamweasels.com
 * Description:       Easily embed a group of Twitch Streams in your site with a simple shortcode and easy admin menu.
 * Version:           1.3.3
 * Author:            StreamWeasels
 * Author URI:        https://www.streamweasels.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       twitch-wall
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-twitch-wall-activator.php
 */
function activate_twitch_wall() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twitch-wall-activator.php';
	Twitch_Wall_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-twitch-wall-deactivator.php
 */
function deactivate_twitch_wall() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twitch-wall-deactivator.php';
	Twitch_Wall_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_twitch_wall' );
register_deactivation_hook( __FILE__, 'deactivate_twitch_wall' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-twitch-wall.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_twitch_wall() {

	$plugin = new Twitch_Wall();
	$plugin->run();

}
run_twitch_wall();
