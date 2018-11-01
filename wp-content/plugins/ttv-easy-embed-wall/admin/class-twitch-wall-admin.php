<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       none
 * @since      1.0.0
 *
 * @package    Twitch_Wall
 * @subpackage Twitch_Wall/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Twitch_Wall
 * @subpackage Twitch_Wall/admin
 * @author     StreamWeasels <admin@streamweasels.com>
 */
class Twitch_Wall_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Twitch_Wall_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Twitch_Wall_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if (isset($_GET['page']) && $_GET['page'] == 'twitch-tv-wall') {
			wp_enqueue_style( 'twitch-tv-easy-embed-admin-css', plugin_dir_url( __FILE__ ) . 'css/twitch-wall-admin.css', array(), $this->version, 'all' );
            wp_enqueue_style( 'twitch-tv-easy-embed-plugin-css', plugins_url( 'public/css/twitch-wall-public.css', dirname(__FILE__) ), array(), $this->version, 'all' );
    	    wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'twitch-ttv-wall-js', plugins_url( '/public/js/twitch-wall-public.js', dirname( __FILE__ ) ), array('jquery'), $this->version, false );   
            $twitchWallVars = array(
                'id'            => 0,
                'limit'         => sanitize_text_field(get_option('ttv_ezembed_options_wall')['twitch_settings_limit']),  
                'theme'         => sanitize_text_field(get_option('ttv_ezembed_appearance_options_wall')['twitch_appearance_colour_theme']),                        
                'language'      => sanitize_text_field(get_option('ttv_ezembed_options_wall')['twitch_settings_language']),  
                'twitchGames'   => sanitize_text_field(get_option('ttv_ezembed_options_wall')['twitch_settings_game']),
                'twitchNames'   => str_replace(' ', '', sanitize_text_field(get_option('ttv_ezembed_options_wall')['twitch_settings_channel'])),
                'twitchTeam'    => sanitize_text_field(get_option('ttv_ezembed_options_wall')['twitch_settings_team']),
                'play'          => plugins_url("../templates/assets/play.svg", __FILE__),
            );            
            wp_localize_script( 'twitch-ttv-wall-js', 'twitch_wall_vars', $twitchWallVars);
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Twitch_Wall_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Twitch_Wall_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if (isset($_GET['page']) && $_GET['page'] == 'twitch-tv-wall') {
            wp_enqueue_script( 'twitch-API', 'https://embed.twitch.tv/embed/v1.js', array( 'jquery' ), '', false );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/twitch-wall-admin.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( 'twitch-colourpicker', plugin_dir_url( __FILE__ ) . 'js/colour-picker.js', array( 'wp-color-picker' ), $this->version, false );
		}

	}
    
	public function create_admin_page() {
		add_options_page( 'Twitch TV Wall', 'Easy Embed for Twitch TV (WALL)', 'manage_options', 'twitch-tv-wall', 'ttv_ezembed_options_wall' );

		function ttv_ezembed_options_wall() {
		    $twitchOptions = get_option('ttv_ezembed_options_wall');
		    $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'main_options';

		    echo '<div>
		    <h2>Easy Embed for Twitch TV (Wall)</h2>
		    <p>Easily add a customizable Twitch.tv embedded wall anywhere on your site. Fill in the options below to customize your wall.</p>';
            echo '<h2 style="text-align:center;">Layout Options</h2>';                
            echo '<p style="text-align:center;">Why not try one of our other Easy Embed Twitch TV plugins?</p>';
            echo '<p style="text-align:center;">Or if you\'re a streamer, why not try our FREE WordPress theme, integrated with Twitch straight out the box - <a href="https://www.streamweasels.com" target="_blank">Broadcast</a></p>';
            echo '<div class="twitch-plugins-upsell">';
            echo '<div class="twitch-plugins-upsell-item"><img src="'.plugin_dir_url( __FILE__ ).'../admin/img/twitch-rail.png"><span>A customizable Twitch Rail - which shows three streams at a time and lets the users swipe streams left and right.</span><a href="https://en-gb.wordpress.org/plugins/ttv-easy-embed/" target="_blank">Twitch Rail</a></div>';
            echo '<div class="twitch-plugins-upsell-item"><img src="'.plugin_dir_url( __FILE__ ).'../admin/img/twitch-wall.png"><span>A customizable Twitch Wall - which shows many streams, which when clicked - activate the \'featured stream\' at the top. Includes chat.</span><a href="https://en-gb.wordpress.org/plugins/ttv-easy-embed-wall/" target="_blank">Twitch Wall</a></div>';     
            echo '<div class="twitch-plugins-upsell-item"><img src="'.plugin_dir_url( __FILE__ ).'../admin/img/twitch-player.png"><span>A customizable Twitch Player - which shows many streams, when clicked - activate the \'featured stream\' in the middle. Includes offline.</span><a href="https://en-gb.wordpress.org/plugins/ttv-easy-embed-player/" target="_blank">Twitch Player</a></div>';            
            echo '</div>';            
		    echo '<h2 class="nav-tab-wrapper">
			    <a href="?page=twitch-tv-wall&tab=main_options" class="nav-tab '.  ($active_tab == 'main_options' ? 'nav-tab-active' : '') .'">Main Options</a>
			    <a href="?page=twitch-tv-wall&tab=appearance_options" class="nav-tab '.  ($active_tab == 'appearance_options' ? 'nav-tab-active' : '') .'">Appearance Options</a>
				</h2>';
            echo '<h2 style="text-align:center;">Wall Preview</h2>';
		    echo '<p style="text-align:center;">Shortcode to output the Twitch TV Wall: [getTwitchWall]</p></div>';
            echo '<p style="text-align:center;">Upgrade to <a href="https://www.streamweasels.com/store/plugins/twitch-tv-wall-pro/" target="_blank">Twitch TV Wall PRO</a> to get advanced shortcode usage, which allows for <strong>multiple walls</strong>.</p>';
		    include (plugin_dir_path( __FILE__ ) . '/../public/partials/output.php');
		    echo '<form class="twitch-form" action="options.php" method="post">';
		    if( $active_tab == 'main_options' ) {
		    settings_fields('ttv_ezembed_options_wall');
		    do_settings_sections('twitch_wall');
		    } elseif ( $active_tab == 'appearance_options' ) {
		    settings_fields('ttv_ezembed_appearance_options_wall');
		    do_settings_sections('twitch_wall_2');
		    }
		    echo '<input name="Submit" type="submit" value="Save Changes" />
		    </form>';
		}
	}

	function ttv_ezembed_admin_init() {

	include ('partials/fields-output.php');
	include ('partials/sanitize.php');

	register_setting( 'ttv_ezembed_options_wall', 'ttv_ezembed_options_wall', 'ttv_ezembed_options_wall_validate');
	register_setting( 'ttv_ezembed_appearance_options_wall', 'ttv_ezembed_appearance_options_wall', 'ttv_ezembed_options_wall_validate');
	add_settings_section('twitch_main_wall', 'Main Settings', 'twitch_wall_section_text', 'twitch_wall');
	add_settings_section('twitch_appearance_wall', 'Appearance Settings', 'twitch_wall_section_appearance_text', 'twitch_wall_2');
	add_settings_field('twitch_settings_game', 'Game', 'twitch_wall_settings_game', 'twitch_wall', 'twitch_main_wall');
	add_settings_field('twitch_settings_language', 'Language', 'twitch_wall_settings_language', 'twitch_wall', 'twitch_main_wall');    
	add_settings_field('twitch_settings_channel', 'Channel', 'twitch_wall_settings_channel', 'twitch_wall', 'twitch_main_wall');
	add_settings_field('twitch_settings_team', 'Team', 'twitch_wall_settings_team', 'twitch_wall', 'twitch_main_wall');
	add_settings_field('twitch_settings_limit', 'Limit', 'twitch_wall_settings_limit', 'twitch_wall', 'twitch_main_wall');
	add_settings_field('twitch_appearance_colour_theme', 'Colour Theme', 'twitch_wall_appearance_colour_theme', 'twitch_wall_2', 'twitch_appearance_wall');
	add_settings_field('twitch_settings_channel_offline', 'Show Offline Channels?', 'twitch_wall_settings_channel_offline', 'twitch_wall', 'twitch_main_wall');    
	add_settings_field('twitch_settings_show_default', 'Show Featured Stream by default?', 'twitch_settings_show_default', 'twitch_wall', 'twitch_main_wall');      

	function twitch_wall_section_text() {
	echo '<p>Fill in the below fields to hook your Twitch Wall upto twitch.tv. Fill in either the game field or the channels field to start pulling streams from twitch!</p>';
	}
	function twitch_wall_section_appearance_text() {
	echo '<p>Fill in the below fields to fully configure the twitch.tv wall.</p>';
	}
    function twitch_wall_premium_notice() {
        echo '<div class="notice premium-notice is-dismissible"><p><strong>Twitch TV Easy Embed (Wall):</strong> Show offline streams, use multiple walls and more with our new plugin - Twitch TV Wall PRO. <a href="https://www.streamweasels.com/store/plugins/twitch-tv-wall-pro/" target="_blank">Buy Now</a>.</p></div>';
    }    
    $twNotice = get_option( 'twitch-wall-notice-dismissed' );
    if( empty( $twNotice ) ) {
        add_action( 'admin_notices', 'twitch_wall_premium_notice' );
    } 
    function twitch_wall_dismiss_acf_notice() {
        update_option( 'twitch-wall-notice-dismissed', 1 );
    } 
        add_action( 'wp_ajax_twitch_wall_dismiss_acf_notice', 'twitch_wall_dismiss_acf_notice' );
}

}
