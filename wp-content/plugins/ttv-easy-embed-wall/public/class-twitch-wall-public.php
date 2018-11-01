<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       none
 * @since      1.0.0
 *
 * @package    Twitch_Wall
 * @subpackage Twitch_Wall/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Twitch_Wall
 * @subpackage Twitch_Wall/public
 * @author     StreamWeasels <admin@streamweasels.com>
 */
class Twitch_Wall_Public {

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
		 * defined in Twitch_Wall_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Twitch_Wall_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/twitch-wall-public.css', array(), $this->version, 'all' );

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
		 * defined in Twitch_Wall_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Twitch_Wall_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'twitch-API', 'https://embed.twitch.tv/embed/v1.js', array( 'jquery' ), '', false );
        wp_enqueue_script( 'twitch-ttv-wall-js', plugins_url( '/public/js/twitch-wall-public.js', dirname( __FILE__ ) ), array('jquery'), $this->version, false );   
        $twitchWallVars = array(
            'id'            => 0,
            'limit'         => sanitize_text_field(get_option('ttv_ezembed_options_wall')['twitch_settings_limit']),  
            'theme'         => sanitize_text_field(get_option('ttv_ezembed_options_wall')['twitch_appearance_colour_theme']),                        
            'language'      => sanitize_text_field(get_option('ttv_ezembed_options_wall')['twitch_settings_language']),  
            'twitchGames'   => sanitize_text_field(get_option('ttv_ezembed_options_wall')['twitch_settings_game']),
            'twitchNames'   => str_replace(' ', '', sanitize_text_field(get_option('ttv_ezembed_options_wall')['twitch_settings_channel'])),
            'twitchTeam'    => sanitize_text_field(get_option('ttv_ezembed_options_wall')['twitch_settings_team']),
            'play'          => plugins_url("../templates/assets/play.svg", __FILE__),
        );            
        wp_localize_script( 'twitch-ttv-wall-js', 'twitch_wall_vars', $twitchWallVars);
	}
    
    public function getTwitchOutput(){
        include ('partials/output.php');
    }
    
	public function getTwitchWallShortcode() {
		add_shortcode('getTwitchWall',  array( $this, 'getTwitchWall_content'));
	}
    
	public function getTwitchWall_content($args, $content=null){
        ob_start();
        $this->getTwitchOutput();
        return ob_get_clean();
	}
    
}

