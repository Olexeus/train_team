<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function twitch_settings_game() {
$options = get_option('ttv_ezembed_options'); ?>
<input class='twitch_settings_gct' id='twitch_settings_game' name='ttv_ezembed_options[twitch_settings_game]' size='40' type='text' value="<?php echo $options[twitch_settings_game]; ?>" placeholder='Hearthstone'/><br><label>The <strong>game</strong> to fill the Twitch Rail with. This will pull the top streamers for the game.</label><br><p>Limited to <strong>20 streams</strong>. </p><span class='error'>Choose either the GAME field, the CHANNEL field or the TEAM field.</span>
<?php }

function twitch_settings_channel() {
$options = get_option('ttv_ezembed_options');
echo "<input class='twitch_settings_gct' id='twitch_settings_channel' name='ttv_ezembed_options[twitch_settings_channel]' size='40' type='text' value='{$options['twitch_settings_channel']}' placeholder='syndicate,summit1g,lirik'/><br><label>The twitch.tv <strong>channels</strong> to fill the Twitch Rail with. This can be a single channel or multiple channels. Seperate multiple channels with a comma.</label><br><p>Limited to <strong>20 streams</strong>. <span class='upsell'>Upgrade to <a href='https://www.streamweasels.com/store/plugins/twitch-tv-rail-pro/' target='_blank'>Twitch TV Rail PRO</a> to increase this limit to 100.</span></p><span class='error'>Choose either the GAME field, the CHANNEL field or the TEAM field.</span>";
}

function twitch_settings_team() {
$options = get_option('ttv_ezembed_options');
echo "<input class='twitch_settings_gct' id='twitch_settings_team' name='ttv_ezembed_options[twitch_settings_team]' size='40' type='text' value='{$options['twitch_settings_team']}' placeholder='connection_lost'/><br><label>The twitch.tv <strong>team</strong> to fill the twitch rail with. This will pull the entire team but it will only show team members which are online.</label><br><p>Limited to <strong>20 streams</strong>. <span class='upsell'>Upgrade to <a href='https://www.streamweasels.com/store/plugins/twitch-tv-rail-pro/' target='_blank'>Twitch TV Rail PRO</a> to increase this limit to 100.</span></p><span class='error'>Choose either the GAME field, the CHANNEL field or the TEAM field.</span>";
}

function twitch_settings_language() {
$options = get_option('ttv_ezembed_options');
echo "<input id='twitch_settings_language' name='ttv_ezembed_options[twitch_settings_language]' size='40' type='text' value='{$options['twitch_settings_language']}' placeholder='en'/><br><label>If you want to limit the <strong>game</strong> feed to a specific language, do that here. Use the <a target='_blank' href='https://en.wikipedia.org/wiki/ISO_639-1'>ISO 639-1</a> language code. Leave this blank for all languages.</label>";
}

//// function twitch_settings_limit() {
//$options = get_option('ttv_ezembed_options');
//echo "<input id='twitch_settings_limit' name='ttv_ezembed_options[twitch_settings_limit]' size='40' type='text' value='{$options['twitch_settings_limit']}'/><br><label>The limit on the number of streams returned. Maximum of 100.</label>";
//}

function twitch_settings_channel_offline() {
$options = get_option('ttv_ezembed_options');
echo "<input disabled class='disabled' id='twitch_settings_channel_offline' name='ttv_ezembed_options[twitch_settings_channel_offline]' type='checkbox' value='1' " . checked( 1, $options['twitch_settings_channel_offline'], false ) . "/><label class='disabled' for='twitch_settings_channel_offline'>Show all channels, even if they're offline.</label><div><p class='upsell'>This feature is only available in <a href='https://www.streamweasels.com/store/plugins/twitch-tv-rail-pro/' target='_blank'>Twitch TV Rail PRO</a>. Get this feature and all the others, plus premium support for only $10.</p></div>";
}
function twitch_settings_title() {
$options = get_option('ttv_ezembed_appearance_options');
echo "<input id='twitch_settings_title' name='ttv_ezembed_appearance_options[twitch_settings_title]' size='40' type='text' value='{$options['twitch_settings_title']}' /><br><label>The title for the twitch rail, appears on line 1 beside the twitch logo.</label>";
}

function twitch_settings_subtitle() {
$options = get_option('ttv_ezembed_appearance_options');
echo "<input id='twitch_settings_subtitle' name='ttv_ezembed_appearance_options[twitch_settings_subtitle]' size='40' type='text' value='{$options['twitch_settings_subtitle']}' /><br><label>The subtitle for the twitch rail, appears on line 2 beside the twitch logo.</label>";
}

function twitch_settings_button_text() {
$options = get_option('ttv_ezembed_appearance_options');
echo "<input id='twitch_settings_button_text' name='ttv_ezembed_appearance_options[twitch_settings_button_text]' size='40' type='text' value='{$options['twitch_settings_button_text']}' /><br><label>The text for the optional 'call to action' button in the twitch rail. <strong>Leave this field blank for NO button</strong>.</label>";
}

function twitch_settings_button_link() {
$options = get_option('ttv_ezembed_appearance_options');
echo "<input id='twitch_settings_button_link' name='ttv_ezembed_appearance_options[twitch_settings_button_link]' size='40' type='text' value='{$options['twitch_settings_button_link']}' /><br><label>The URL link for the optional 'call to action' button in the twitch rail. This should start with a valid protocol EG <strong>'HTTP://'</strong> or <strong>'HTTPS://'</strong>.</label>";
}

function twitch_appearance_colour_theme() {
$options = get_option('ttv_ezembed_appearance_options');
$html = '<select id="twitch_appearance_colour_theme" name="ttv_ezembed_appearance_options[twitch_appearance_colour_theme]"/>
            <option value="dark-theme" '.selected( $options['twitch_appearance_colour_theme'], 'dark-theme', false ).'>Dark Theme</option>
            <option value="light-theme" '.selected( $options['twitch_appearance_colour_theme'], 'light-theme', false ).'>Light Theme</option>
        </select>';
    echo $html;
}

function twitch_appearance_secondary_colour() {
$options = get_option('ttv_ezembed_appearance_options');
echo "<input id='twitch_appearance_secondary_colour' class='color-1' data-default-color='#7f1618' name='ttv_ezembed_appearance_options[twitch_appearance_secondary_colour]' size='40' type='text' value='{$options['twitch_appearance_secondary_colour']}' /><br><label>Choose a secondary colour to fit with your site. The default colour is red (#7f1618).</label>";
}

function twitch_appearance_font1() {
$options = get_option('ttv_ezembed_appearance_options');
$font1 = (!empty($options['twitch_appearance_font1']) ? $options['twitch_appearance_font1'] : 'Arial Black');
echo "<input id='twitch_appearance_font1' name='ttv_ezembed_appearance_options[twitch_appearance_font1]' size='40' type='text' value='".$font1."' placeholder='Arial Black'/><br><label>The Primary Font.</label>";
}

function twitch_appearance_font2() {
$options = get_option('ttv_ezembed_appearance_options');
$font2 = (!empty($options['twitch_appearance_font2']) ? $options['twitch_appearance_font2'] : 'Arial');
echo "<input id='twitch_appearance_font2' name='ttv_ezembed_appearance_options[twitch_appearance_font2]' size='40' type='text' value='".$font2."' placeholder='Arial'/><br><label>The Secondary Font.</label>";
}

function twitch_links_click() {
$options = get_option('ttv_ezembed_options');
echo "<input disabled class='disabled' id='twitch_links_click' name='ttv_ezembed_options[twitch_links_click]' type='checkbox' value='1' " . checked( 1, $options['twitch_links_click'], false ) . "/><label class='disabled' for='twitch_links_click'>When clicked, open stream in a popup.</label><div><p class='upsell'>This feature is only available in <a href='https://www.streamweasels.com/store/plugins/twitch-tv-rail-pro/' target='_blank'>Twitch TV Rail PRO</a>. Get this feature and all the others, plus premium support for only $10.</p></div>";
}

function twitch_links_chat() {
$options = get_option('ttv_ezembed_options');
echo "<input disabled class='disabled' id='twitch_links_chat' name='ttv_ezembed_options[twitch_links_chat]' type='checkbox' value='1' " . checked( 1, $options['twitch_links_chat'], false ) . "/><label class='disabled' for='twitch_links_chat'>When clicked, show stream and chat side-by-side.</label><div><p class='upsell'>This feature is only available in <a href='https://www.streamweasels.com/store/plugins/twitch-tv-rail-pro/' target='_blank'>Twitch TV Rail PRO</a>. Get this feature and all the others, plus premium support for only $10.</p></div>";
}

?>
