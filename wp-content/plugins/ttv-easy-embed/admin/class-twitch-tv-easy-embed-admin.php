<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.jamieburleigh.co.uk
 * @since      1.0.0
 *
 * @package    Twitch_Tv_Easy_Embed
 * @subpackage Twitch_Tv_Easy_Embed/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Twitch_Tv_Easy_Embed
 * @subpackage Twitch_Tv_Easy_Embed/admin
 * @author     Jamie Burleigh <j.burleigh1@gmail.com>
 */
class Twitch_Tv_Easy_Embed_Admin {

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
		 * defined in Twitch_Tv_Easy_Embed_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Twitch_Tv_Easy_Embed_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if (isset($_GET['page']) && $_GET['page'] == 'twitch-tv-rail') {
			wp_enqueue_style( $this->plugin_name, plugins_url( 'public/css/twitch-tv-easy-embed-public.css', dirname(__FILE__) ), array(), $this->version, 'all' );
			wp_enqueue_style( 'twitch-tv-easy-embed-admin-css', plugin_dir_url( __FILE__ ) . 'css/twitch-tv-easy-embed-admin.css', array(), $this->version, 'all' );
    	    wp_enqueue_style( 'wp-color-picker' );
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
		 * defined in Twitch_Tv_Easy_Embed_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Twitch_Tv_Easy_Embed_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if (isset($_GET['page']) && $_GET['page'] == 'twitch-tv-rail') {
            wp_enqueue_script( 'twitch-API', 'https://embed.twitch.tv/embed/v1.js', array( 'jquery' ), '', false );        
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/twitch-tv-easy-embed-admin.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( 'twitch-slick', plugins_url( '/public/js/slick.1.6.0.min.js', dirname( __FILE__ ) ), array('jquery'), $this->version, false );
			wp_enqueue_script( 'twitch-colourpicker', plugin_dir_url( __FILE__ ) . 'js/colour-picker.js', array( 'wp-color-picker' ), $this->version, false );
            wp_enqueue_script( 'twitch-ttv-rail-js', plugins_url( '/public/js/twitch-tv-easy-embed-public.js', dirname( __FILE__ ) ), array('jquery'), $this->version, false );
            $twitchRailVars = array(
                'id'            => 0,
                'language'      => sanitize_text_field(get_option('ttv_ezembed_options')['twitch_settings_language']),  
                'twitchGames'   => sanitize_text_field(get_option('ttv_ezembed_options')['twitch_settings_game']),
                'twitchNames'   => str_replace(' ', '', sanitize_text_field(get_option('ttv_ezembed_options')['twitch_settings_channel'])),
                'twitchTeam'    => sanitize_text_field(get_option('ttv_ezembed_options')['twitch_settings_team']),
                'leftArrow'     => plugins_url("../public/img/slick-left.svg", __FILE__),
                'rightArrow'     => plugins_url("../public/img/slick-right.svg", __FILE__),
            );            
            wp_localize_script( 'twitch-ttv-rail-js', 'twitch_rail_vars', $twitchRailVars);
		}
	}

	public function create_admin_page() {
		add_options_page( 'Twitch TV Rail', 'Easy Embed for Twitch TV (RAIL)', 'manage_options', 'twitch-tv-rail', 'ttv_ezembed_options' );

		function ttv_ezembed_options() {
		    $twitchOptions = get_option('ttv_ezembed_options');
		    $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'main_options';

		    echo '<div>
		    <h2>Easy Embed for Twitch TV (Rail)</h2>
		    <p>Easily add a customizable Twitch.tv embedded rail anywhere on your site. Fill in the options below to customize your rail.</p>';
            echo '<h2 style="text-align:center;">Layout Options</h2>';                
            echo '<p style="text-align:center;">Why not try one of our other Easy Embed Twitch TV plugins?</p>';
            echo '<p style="text-align:center;">Or if you\'re a streamer, why not try our FREE WordPress theme, integrated with Twitch straight out the box - <a href="https://www.streamweasels.com" target="_blank">Broadcast</a></p>';
            echo '<div class="twitch-plugins-upsell">';
            echo '<div class="twitch-plugins-upsell-item"><img src="'.plugin_dir_url( __FILE__ ).'../admin/img/twitch-rail.png"><span>A customizable Twitch Rail - which shows three streams at a time and lets the users swipe streams left and right.</span><a href="https://en-gb.wordpress.org/plugins/ttv-easy-embed/" target="_blank">Twitch Rail</a></div>';
            echo '<div class="twitch-plugins-upsell-item"><img src="'.plugin_dir_url( __FILE__ ).'../admin/img/twitch-wall.png"><span>A customizable Twitch Wall - which shows many streams, which when clicked - activate the \'featured stream\' at the top. Includes chat.</span><a href="https://en-gb.wordpress.org/plugins/ttv-easy-embed-wall/" target="_blank">Twitch Wall</a></div>';     
            echo '<div class="twitch-plugins-upsell-item"><img src="'.plugin_dir_url( __FILE__ ).'../admin/img/twitch-player.png"><span>A customizable Twitch Player - which shows many streams, when clicked - activate the \'featured stream\' in the middle. Includes offline.</span><a href="https://en-gb.wordpress.org/plugins/ttv-easy-embed-player/" target="_blank">Twitch Player</a></div>';                
            echo '</div>';            
		    echo '<h2 class="nav-tab-wrapper">
			    <a href="?page=twitch-tv-rail&tab=main_options" class="nav-tab '.  ($active_tab == 'main_options' ? 'nav-tab-active' : '') .'">Main Options</a>
			    <a href="?page=twitch-tv-rail&tab=appearance_options" class="nav-tab '.  ($active_tab == 'appearance_options' ? 'nav-tab-active' : '') .'">Appearance Options</a>
				</h2>';
            echo '<h2 style="text-align:center;">Rail Preview</h2>';
		    echo '<p style="text-align:center;">Shortcode to output the Twitch TV Rail: [getTwitchRail]</p></div>';
            echo '<p style="text-align:center;">Upgrade to <a href="https://www.streamweasels.com/store/plugins/twitch-tv-rail-pro/" target="_blank">Twitch TV Rail PRO</a> to get advanced shortcode usage, which allows for <strong>multiple rails</strong>.</p>';
            
		    include (plugin_dir_path( __FILE__ ) . '/../public/partials/output.php');
		    echo '<form class="twitch-form" action="options.php" method="post">';
		    if( $active_tab == 'main_options' ) {
		    settings_fields('ttv_ezembed_options');
		    do_settings_sections('twitch');
		    } elseif ( $active_tab == 'appearance_options' ) {
		    settings_fields('ttv_ezembed_appearance_options');
		    do_settings_sections('twitch_appearance');
		    } elseif ( $active_tab == 'link_options' ) {
		    settings_fields('ttv_ezembed_link_options');
		    do_settings_sections('twitch_links');
		    }
		    echo '<input name="Submit" type="submit" value="Save Changes" />
		    </form>';
		}
	}

	function ttv_ezembed_admin_init() {

	include ('partials/fields-output.php');
	include ('partials/sanitize.php');

	register_setting( 'ttv_ezembed_options', 'ttv_ezembed_options', 'ttv_ezembed_options_validate');
	register_setting( 'ttv_ezembed_appearance_options', 'ttv_ezembed_appearance_options', 'ttv_ezembed_options_validate');
	register_setting( 'ttv_ezembed_link_options', 'ttv_ezembed_link_options', 'ttv_ezembed_options_validate');
	add_settings_section('twitch_main', 'Main Settings', 'twitch_section_text', 'twitch');
	add_settings_section('twitch_appearance', 'Appearance Settings', 'twitch_section_appearance_text', 'twitch_appearance');
	add_settings_section('twitch_links', 'Click Settings', 'twitch_section_link_text', 'twitch_links');
	add_settings_field('twitch_settings_title', 'Title', 'twitch_settings_title', 'twitch_appearance', 'twitch_appearance');
	add_settings_field('twitch_settings_subtitle', 'Subtitle', 'twitch_settings_subtitle', 'twitch_appearance', 'twitch_appearance');
	add_settings_field('twitch_settings_button_text', 'Button Text (<em>optional</em>)', 'twitch_settings_button_text', 'twitch_appearance', 'twitch_appearance');
	add_settings_field('twitch_settings_button_link', 'Button URL (<em>optional</em>)', 'twitch_settings_button_link', 'twitch_appearance', 'twitch_appearance');
	add_settings_field('twitch_settings_game', 'Game', 'twitch_settings_game', 'twitch', 'twitch_main');
	add_settings_field('twitch_settings_language', 'Language', 'twitch_settings_language', 'twitch', 'twitch_main');    
	add_settings_field('twitch_settings_channel', 'Channel', 'twitch_settings_channel', 'twitch', 'twitch_main');
	add_settings_field('twitch_settings_team', 'Team', 'twitch_settings_team', 'twitch', 'twitch_main');
	add_settings_field('twitch_settings_channel_offline', 'Show Offline Channels?', 'twitch_settings_channel_offline', 'twitch', 'twitch_main');        
	//add_settings_field('twitch_settings_limit', 'Limit', 'twitch_settings_limit', 'twitch', 'twitch_main');
	add_settings_field('twitch_appearance_colour_theme', 'Colour Theme', 'twitch_appearance_colour_theme', 'twitch_appearance', 'twitch_appearance');
	add_settings_field('twitch_appearance_secondary_colour', 'Secondary Colour', 'twitch_appearance_secondary_colour', 'twitch_appearance', 'twitch_appearance');
	add_settings_field('twitch_appearance_font1', 'Primary Font', 'twitch_appearance_font1', 'twitch_appearance', 'twitch_appearance');
	add_settings_field('twitch_appearance_font2', 'Secondary Font', 'twitch_appearance_font2', 'twitch_appearance', 'twitch_appearance');
	add_settings_field('twitch_links_click', 'Show Stream in popup?', 'twitch_links_click', 'twitch', 'twitch_main');
	add_settings_field('twitch_links_chat', 'Show Chat in popup?', 'twitch_links_chat', 'twitch', 'twitch_main');

	function twitch_section_text() {
	echo '<p>Fill in the below fields to hook your Twitch Rail upto twitch.tv. Fill in either the game field or the channels field to start pulling streams from twitch!</p>';
	}
	function twitch_section_appearance_text() {
	echo '<p>Fill in the below fields to fully configure the twitch.tv rail.</p>';
	}
	function twitch_section_link_text() {
	echo '<p>Fill in the below fields to configure how the Twitch Rail handles click events.</p>';
	}
    function ttv_premium_notice() {
        echo '<div class="notice premium-notice is-dismissible"><p><strong>Twitch TV Easy Embed (Rail):</strong> Show offline streams, use multiple rails and more with our new plugin - Twitch TV Rail PRO. <a href="https://www.streamweasels.com/store/plugins/twitch-tv-rail-pro/" target="_blank">Buy Now</a>.</p></div>';
    }    
    $acfNotice = get_option( 'twitch-acf-notice-dismissed' );
    if( empty( $acfNotice ) ) {
        add_action( 'admin_notices', 'ttv_premium_notice' );
    } 
    function twitch_dismiss_acf_notice() {
        update_option( 'twitch-acf-notice-dismissed', 1 );
    } 
        add_action( 'wp_ajax_twitch_dismiss_acf_notice', 'twitch_dismiss_acf_notice' );
	}
}
