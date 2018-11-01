<?php
if (!defined('ABSPATH')) {
	die(__('No'));
}
?>

<div id="wrap">
	<h1><?php _e('Bait Stream Settings', 'baitStream'); ?></h1>

	<form method="post" action="options.php">

		<?php settings_fields($this->pluginPrefix . '-settings-group'); ?>
		<?php do_settings_sections($this->pluginPrefix . '-settings-group'); ?>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="<?php echo $this->pluginPrefix; ?>-channelname">
							<?php _e('Twitch Channel', 'baitStream'); ?>
						</label>
					</th>
					<td>
						<Textarea name="<?php echo $this->pluginPrefix; ?>-channelname" type="text" rows="5" id="<?php echo $this->pluginPrefix; ?>-channelname" class="regular-text"><?php echo get_option($this->pluginPrefix .  '-channelname',$this->channelname) ?></Textarea>
						<p class="description"><?php _e('The Twitch.TV channel/user name. (Example: a URL of www.twitch.tv/pcgamergirlgk - pcgamergirlgk would be the entry for this field.)', 'baitStream'); ?></p>
						<p class="description"><?php _e(' To more than user name enter them separated by Comma (Example: pcgamergirlgk, johndeo)', 'baitStream'); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="<?php echo $this->pluginPrefix; ?>-clientid">
							<?php _e('Client ID', 'baitStream'); ?>
						</label>
					</th>
					<td>
						<input name="<?php echo $this->pluginPrefix; ?>-clientid" type="text" id="<?php echo $this->pluginPrefix; ?>-clientid" value="<?php echo get_option($this->pluginPrefix .  '-clientid',$this->clientid) ?>" class="regular-text">
						<p class="description"><?php _e('Enter client ID.', 'baitStream'); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="<?php echo $this->pluginPrefix; ?>-requesttime">
							<?php _e('Request Time', 'baitStream'); ?>
						</label>
					</th>
					<td>
						<input name="<?php echo $this->pluginPrefix; ?>-requesttime" type="number" id="<?php echo $this->pluginPrefix; ?>-requesttime" value="<?php echo get_option($this->pluginPrefix .  '-requesttime',$this->requesttime) ?>" class="regular-text">
						<p class="description"><?php _e('Requested Time is the interval period per seconds between each request if the page not refreshed.', 'baitStream'); ?></p>
					</td>
				</tr>
			</tbody>
		</table>
		<p><b>NOTE:</b> This plugin will <i>only</i> display an alert on the <b>front page</b> of your site when your Twitch stream is active. If your stream is <b>not</b> active, no message will be displayed.</p><p>&nbsp;</p>
			<p><b>Plugin Created By:</b> <a href="http://www.pcgamergirl.com" target="_BLANK">PCGamerGirl.COM</a> | <a href="http://www.pcgamergirl.com/wordpress-plugin-donations/" target="_BLANK">Donate</a></p>
		<?php submit_button(); ?>

	</form>
</div>