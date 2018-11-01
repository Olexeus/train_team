<?php

/*
  Plugin Name: Bait Stream for Twitch
  Plugin URI: 
  Description: Alert visitors to your live Twitch stream with an unobtrusive popup alert.
  Version: 1.0.0
  Author: Graecyn K.
  Author URI: http://www.pcgamergirl.com
  License: GPL2
 */


class baitStream
{

	private $version = '1.6.1';
	private $pluginPrefix = 'bait-stream';
	private $channelname = 'pcgamergirlgk';
	private $clientid    = 'fxthsmephb4z6vuac5d20r5p75qvlw';
	private $requesttime = 120;

	public function __construct()
	{
		if (is_admin()) {
			$this->backendInit();
		}

		$this->frontendInit();
		add_action( 'wp_head', 'taDivTime' );
		function taDivTime() {
			if(is_front_page()) {
		?>
			<div id="taAlertMe"></div>
		<?php
			}
		}
	}

	/**
	 * Actions for backend.
	 */
	public function backendInit()
	{
		add_action('wp_enqueue_scripts', array($this, 'enqueScripts'));
		add_action('admin_menu', array($this, 'registerSettingsPage'));
		add_action('admin_init', array($this, 'registerSettings'));
	}

	public function frontendInit()
	{
		add_action('wp_print_styles', array($this, 'enqueScripts'));
	}

	/**
	 * Registers settings for plugin.
	 */
	public function registerSettings()
	{
		register_setting($this->pluginPrefix . '-settings-group', $this->pluginPrefix . '-channelname');
		register_setting($this->pluginPrefix . '-settings-group', $this->pluginPrefix . '-clientid');
		register_setting($this->pluginPrefix . '-settings-group', $this->pluginPrefix . '-requesttime');
	}

	/**
	 * Add a menu item to the admin bar.
	 */
	public function registerSettingsPage()
	{
		add_options_page('Bait Stream Settings', 'Bait Stream Settings', 'manage_options', $this->pluginPrefix, array($this, 'showSettingsPage'));
	}

	/**
	 * Includes the settings page.
	 */
	public function showSettingsPage()
	{
		include('pages/settings.php');
	}


	public function enqueScripts()
	{
		wp_enqueue_style(
			$this->pluginPrefix . '-styles', WP_PLUGIN_URL . "/bait-stream/jquery.baitStream.css", false, $this->version);

		wp_enqueue_script(
			$this->pluginPrefix, WP_PLUGIN_URL . "/bait-stream/jquery.baitStream.js", array("jquery"), $this->version );

		/* populate option fields with defaults and open them for jQuery to read. */
		$params = array(
			'channelname' => get_option( $this->pluginPrefix . '-channelname', $this->channelname ),
			'clientid'    => get_option( $this->pluginPrefix . '-clientid',    $this->clientid ),
			'requesttime' => get_option( $this->pluginPrefix . '-requesttime', $this->requesttime ),
		);

		wp_localize_script($this->pluginPrefix, 'baitStreamSettings', $params);

	}
}

new baitStream;

?>