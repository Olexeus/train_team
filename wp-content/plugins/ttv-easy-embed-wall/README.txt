=== Plugin Name ===
Contributors: StreamWeasels
Tags: twitch, twitch.tv, twitch.tv widget, twitch.tv embed
Requires at least: 4.9
Tested up to: 4.9
Stable tag: 1.3.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily embed a group of Twitch Streams in your site with a simple shortcode and easy admin menu.

== Description ==

Need a plugin which lets you embed a Twitch.tv wall of streams in an easy and manageable way? Twitch TV Easy Embed Wall allows you to embed a group of streams and customise the appearance.

* Show twitch streamers all playing a specific game.
* Show twitch streamers based on usernames.
* Show twitch streamers based on a twitch team.
* Customise language selections and limit the number of streams.
* Customise the appearance by changing the colour scheme.
* Custom manager screen and shortcode support.

The plugin works fluidly accross all screen widths and devices, just add the code to your theme or use the shortcode and you're ready to go!

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Settings->Easy Embed for Twitch TV (Wall) screen to configure the plugin
4. To customize the feed from Twitch TV, fill either the 'Game' field or the 'Channel' field or the 'Team' field. Only fill one of these fields, or the feed will not work.
5. To add the widget to your site, you can use the shortcode [getTwitchWall] within any page or post. Advanced Wordpress users could also add the function call directly to their theme to use the widget outside of a page or post (more on this below)

#### Shortcode Usage

Simply use the following shortcode anywhere in a post or page within Wordpress:

[getTwitchWall]

#### Advanced Usage

For those of you who know your way around a Wordpress theme, it's possible to embed the Twitch TV Wall widget directly within your theme using the wordpress function do_shortcode. This will allow you to put the widget anywhere in your theme, even outside of a post or a page.

To do so, use the following PHP code anywhere in your theme.

`<?php echo do_shortcode('[getTwitchWall]') ?>`

== Changelog ==

= 1.3.3 =
* Fixed an issue with foreign characters in display names breaking stream URLs (chinese, korean ETC)
* Fixes an issue with ' characters in the GAME name. Games such as PlayerUnknown's Battlegrounds will now work correctly.
* Detached the JS into a seperate file.
* Further Optimizations.

= 1.3.2 =
* Optimizations
* Cleared up some confusion about limits in the admin screen.

= 1.3.1 =
* Optimizations
* Added callout for Twitch Player

= 1.3 =
* Added support for light and dark Twitch themes.

= 1.2 =
* Fixed a bug causing admin screen errors!

= 1.1 =
* Upgraded the Twitch API to helix.
* Changed the loading animations and tweaked some styles.
* Increased the screenshot image dimensions which improves quality.
* Improved the Scroll code when clicking on a stream.
* Added upsell links for Twitch TV Wall PRO.

= 1.0 =
* Initial release.