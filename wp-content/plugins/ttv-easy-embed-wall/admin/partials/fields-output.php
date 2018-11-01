<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function twitch_wall_settings_game() {
$options = get_option('ttv_ezembed_options_wall'); ?>
<input class='twitch_settings_gct' id='twitch_settings_game' name='ttv_ezembed_options_wall[twitch_settings_game]' size='40' type='text' value="<?php echo $options['twitch_settings_game']; ?>" placeholder='Hearthstone'/><br><label>The <strong>game</strong> to fill the Twitch Wall with. This will pull the top streamers for the game.</label><br><p>Limited to <strong>20 streams</strong>.</p><span class='error'>Choose either the GAME field, the CHANNEL field or the TEAM field.</span>
<?php }

function twitch_wall_settings_channel() {
$options = get_option('ttv_ezembed_options_wall');
echo "<input class='twitch_settings_gct' id='twitch_settings_channel' name='ttv_ezembed_options_wall[twitch_settings_channel]' size='40' type='text' value='{$options['twitch_settings_channel']}' placeholder='ninja,shroud,tsm_myth'/><br><label>The twitch.tv <strong>channels</strong> to fill the Twitch Wall with. This can be a single channel or multiple channels. Seperate multiple channels with a comma.</label><br><p>Limited to <strong>20 streams</strong>. <span class='upsell'>Upgrade to <a href='https://www.streamweasels.com/store/plugins/twitch-tv-wall-pro/' target='_blank'>Twitch TV Wall PRO</a> to increase this limit to 100.</span></p><span class='error'>Choose either the GAME field, the CHANNEL field or the TEAM field.</span>";
}

function twitch_wall_settings_team() {
$options = get_option('ttv_ezembed_options_wall');
echo "<input class='twitch_settings_gct' id='twitch_settings_team' name='ttv_ezembed_options_wall[twitch_settings_team]' size='40' type='text' value='{$options['twitch_settings_team']}' placeholder='connection_lost'/><br><label>The twitch.tv <strong>team</strong> to fill the Twitch Wall with. This will pull the entire team but it will only show team members which are online.</label><br><p>Limited to <strong>20 streams</strong>. <span class='upsell'>Upgrade to <a href='https://www.streamweasels.com/store/plugins/twitch-tv-wall-pro/' target='_blank'>Twitch TV Wall PRO</a> to increase this limit to 100.</span></p><span class='error'>Choose either the GAME field, the CHANNEL field or the TEAM field.</span>";
}

function twitch_wall_settings_language() {
$options = get_option('ttv_ezembed_options_wall');
echo "<input id='twitch_settings_language' name='ttv_ezembed_options_wall[twitch_settings_language]' size='40' type='text' value='{$options['twitch_settings_language']}' placeholder='en'/><br><label>If you want to limit the <strong>game</strong> feed to a specific language, do that here. Use the <a target='_blank' href='https://en.wikipedia.org/wiki/ISO_639-1'>ISO 639-1</a> language code. Leave this blank for all languages.</label>";
}

function twitch_wall_settings_limit() {
$options = get_option('ttv_ezembed_options_wall');
echo "<input id='twitch_settings_limit' name='ttv_ezembed_options_wall[twitch_settings_limit]' size='40' type='text' value='{$options['twitch_settings_limit']}' placeholder='9'/><br><label>The limit on the number of streams returned. Maximum of 20.</label><br><p class='upsell'>Upgrade to <a href='https://www.streamweasels.com/store/plugins/twitch-tv-wall-pro/' target='_blank'>Twitch TV Wall PRO</a> to increase the CHANNEL and TEAM limit to 100.</p>";
}

function twitch_wall_appearance_colour_theme() {
$options = get_option('ttv_ezembed_appearance_options_wall');
$html = '<select id="twitch_appearance_colour_theme" name="ttv_ezembed_appearance_options_wall[twitch_appearance_colour_theme]"/>
            <option value="dark-theme" '.selected( $options['twitch_appearance_colour_theme'], 'dark-theme', false ).'>Dark Theme</option>
            <option value="light-theme" '.selected( $options['twitch_appearance_colour_theme'], 'light-theme', false ).'>Light Theme</option>
        </select>';
    echo $html;
}

function twitch_wall_settings_channel_offline() {
$options = get_option('ttv_ezembed_options_wall');
echo "<input disabled class='disabled' id='twitch_settings_channel_offline' name='ttv_ezembed_options_wall[twitch_settings_channel_offline]' type='checkbox' value='1' " . checked( 1, $options['twitch_settings_channel_offline'], false ) . "/><label class='disabled' for='twitch_settings_channel_offline'>Show all channels, even if they're offline.</label><div><p class='upsell'>This feature is only available in <a href='https://www.streamweasels.com/store/plugins/twitch-tv-wall-pro/' target='_blank'>Twitch TV Wall PRO</a>. Get this feature and all the others, plus premium support for only $10.</p></div>";
}

function twitch_settings_show_default() {
$options = get_option('ttv_ezembed_options_wall_pro');
echo "<input disabled class='disabled' id='twitch_settings_show_default' name='ttv_ezembed_options_wall_pro[twitch_settings_show_default]' type='checkbox' value='1' " . checked( 1, $options['twitch_settings_show_default'], false ) . "/><label  class='disabled' for='twitch_settings_show_default'>If at least one user is online, load the Featured Stream by default.</label><div><p class='upsell'>This feature is only available in <a href='https://www.streamweasels.com/store/plugins/twitch-tv-wall-pro/' target='_blank'>Twitch TV Wall PRO</a>. Get this feature and all the others, plus premium support for only $10.</p></div>";
}

?>