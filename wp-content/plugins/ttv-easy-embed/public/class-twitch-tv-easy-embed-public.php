<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.jamieburleigh.co.uk
 * @since      1.0.0
 *
 * @package    Twitch_Tv_Easy_Embed
 * @subpackage Twitch_Tv_Easy_Embed/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Twitch_Tv_Easy_Embed
 * @subpackage Twitch_Tv_Easy_Embed/public
 * @author     Jamie Burleigh <j.burleigh1@gmail.com>
 */
class Twitch_Tv_Easy_Embed_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

			wp_enqueue_style( $this->plugin_name, plugins_url( 'public/css/twitch-tv-easy-embed-public.css', dirname(__FILE__) ), array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

			wp_enqueue_script( 'twitch-slick', plugins_url( '/public/js/slick.1.6.0.min.js', dirname( __FILE__ ) ), array('jquery'), $this->version, false );
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
	public function getTwitchOutput($args) {
		include ('partials/output.php');
	}
	public function getTwitchRailShortcode() {
		add_shortcode('getTwitchRail',  array( $this, 'getTwitchRail_content'));
	}

	public function getTwitchRail_content($args, $content=''){
        ob_start();    
        $this->getTwitchOutput($args);
        return ob_get_clean();
	}



}
