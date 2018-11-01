=== Twitch TV Easy Embed (Rail)  ===
Contributors: Jamie Burleigh
Tags: twitch, twitch.tv, twitch.tv widget, twitch.tv embed
Requires at least: 3.0.1
Tested up to: 4.9
Stable tag: 1.9.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily embed a group of Twitch Streams in your site with a simple shortcode and easy admin menu.

== Description ==

# The Easiest Way To Embed Twitch Streams

Need a plugin which lets you embed Twitch.tv streams in an easy and manageable way? Twitch TV Easy Embed allows you to embed a group of streams and customise the appearance.

* Show twitch streamers all playing a specific game.
* Show twitch streamers based on usernames.
* Show twitch streamers based on a twitch team.
* Customise language selections, show offline streamers, show stream and chat in a popup.
* Customise the appearance by changing the colours and fonts to match you site.
* Custom manager screen and shortcode support.

The plugin works fluidly accross all screen widths and devices, just add the code to your theme or use the shortcode and you're ready to go!

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Settings->Easy Embed for Twitch TV screen to configure the plugin
4. To customize the feed from Twitch TV, fill either the 'Game' field or the 'Channel' field or the 'Team' field. Only fill one of these fields, or the feed will not work.
5. To add the widget to your site, you can use the shortcode [getTwitchRail] within any page or post. Advanced Wordpress users could also add the function call directly to their theme to use the widget outside of a page or post (more on this below)

#### Shortcode Usage

Simply use the following shortcode anywhere in a post or page within Wordpress:

[getTwitchRail]

#### Advanced Usage

For those of you who know your way around a Wordpress theme, it's possible to embed the Twitch TV Rail widget directly within your theme using the wordpress function do_shortcode. This will allow you to put the widget anywhere in your theme, even outside of a post or a page.

To do so, use the following PHP code anywhere in your theme.

`<?php echo do_shortcode('[getTwitchRail]') ?>`

== Frequently Asked Questions ==

= Can I use multiple instances of this widget on one page =

With The PRO version, yes. You can download that [here](https://www.streamweasels.com/store/plugins/twitch-tv-rail-pro/)

= Can I show streams, even if they're offline? =

With The PRO version, yes. You can download that [here](https://www.streamweasels.com/store/plugins/twitch-tv-rail-pro/)

== Screenshots ==

1. The admin interface - customize the text, colours, buttons and of course - which games or streamers you want to pull into the widget.
2. The widget on an example theme - using the light colour scheme.
3. The widget on another example theme - using the dark colour scheme.


== Thanks ==

The cycling functionality of this plugin simply would not work without [slick](http://kenwheeler.github.io/slick/). Thank you to the slick team for producing such an awesome plugin.


== Changelog ==

= 1.9.3 =
* Fixed an issue with foreign characters in display names breaking stream URLs (chinese, korean ETC)
* Fixes an issue with ' characters in the GAME name. Games such as PlayerUnknown's Battlegrounds will now work correctly.
* Detached the JS into a seperate file.
* Further Optimizations.

= 1.9.2 =
* Optimizations.
* Cleared up some confusion about limits in the admin screen.

= 1.9.1 = 
* Optimizations.
* Added callout for Twitch Player.

= 1.9 =
* Minor bug fix for users with WP Debug enabled.

= 1.8 =
* Minor bug fix.
* Removed some leftover code.

= 1.7 =
* Upgraded (most of) Twitch API to helix.
* Added support for offline streams (PRO Only).
* Added support for multiple rails (PRO Only).
* Added PRO upgrade notice.
* All rails now lazy load by default.
* Added the green / red online indicator.
* Some code cleanup.

= 1.6 =
* Name tweak.
* Fixed a shortcode issue.

= 1.5 =
* Fixed a number of PHP errors.

= 1.4 =
* Small tweaks for WP 4.9.4.
* thumbnail change.

= 1.3 =
* BREAKING CHANGES - anyone using the function `getTwitchOutput();` in their theme needs to change this to `echo do_shortcode('[getTwitchRail]');`.
* Added support for Twitch TEAMS.
* Added support for streamers of a specific language.
* Added a stream limit.
* Added lazy loading.
* Minor layout tweaks / fixes.
* Now using Slick Slider instead of Flex Slider.
* Added more awesome.

= 1.2 =
* Fixed an issue with Twitch's new API rules where streams would not display.

= 1.1 =
* Added a 'Stream offline' indicator when no streams are online.
* Fixed an issue when WP_DEBUG enabled and plugin set to 'disabled'.

= 1.0 =
* First version. Tested & Working.

== Upgrade Notice ==

= 1.2 =
Due to a recent change in twitch.tv's API guidelines, versions older than v1.2 will not work. Users should upgrade immediately to fix.
