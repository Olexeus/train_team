<?php
include 'libs/chat/class.db.php';
require ('libs/steamauth/steamauth.php');
//require ('libs/steamauth/userInfo.php');
unset($_SESSION['steam_uptodate']);
include 'libs/chat/dialog.php';

add_theme_support( 'title-tag' );
add_filter('pmpro_register_redirect', '__return_false');
function OnOffLine($state)
{
    
	if ($state==1 or $state==5 or $state==6) {
		echo '<i class="fa fa-circle on" aria-hidden="true"></i>';
	} else {
		echo '<i class="fa fa-circle off" aria-hidden="true"></i>';
	}
}

/*if ( function_exists('register_sidebar') ) {
  register_sidebar(array(
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<span class="widgettitle">',
    'after_title' => '</span>',
  ));
}*/
function arphabet_widgets_init() {
  register_sidebar(array(
    'name'          => 'Widget Twitch',
    'id'            => 'twitch-widget',
    'before_widget' => '<div class = "twitch-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));
}
add_action( 'widgets_init', 'arphabet_widgets_init' );


function wpsites_before_post_widget( $content ) {
    if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'before-post' ) && is_main_query() ) {
        dynamic_sidebar('before-post');
    }
    return $content;
}
add_filter( 'the_content', 'wpsites_before_post_widget' );

function tm_background_image(){
    global $current_user;
    get_currentuserinfo();
    $user_id = $current_user->ID;
    
    if ( ! function_exists( 'wp_handle_upload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }

    if( $_FILES['tm_background']['error'] === UPLOAD_ERR_OK ) {
        $upload_overrides = array( 'test_form' => false );
        $r = wp_handle_upload( $_FILES['tm_background'], $upload_overrides );
        update_user_meta( $user_id, 'bck_picture', $r );
    }
}

function if_tm_background($userId){
    $havemeta = get_user_meta($userId, 'bck_picture', true);
    $url = !empty($havemeta['url']) ? $havemeta['url'] : 'wp-content/themes/team_fight/img/background_main.png';
    return $url;
}

function tm_header_color($userId){
    $havemeta = get_user_meta($userId, 'tm_header_color', true);
    $url = !empty($havemeta) ? $havemeta : '#F5F9FC';
    return $url;
}

function tm_footer_color($userId){
    $havemeta = get_user_meta($userId, 'tm_footer_color', true);
    $url = !empty($havemeta) ? $havemeta : '#F5F9FC';
    return $url;
}
function tm_button_color($userId){
    $havemeta = get_user_meta($userId, 'tm_button_color', true);
    $url = !empty($havemeta) ? $havemeta : '#f8632b';
    return $url;
}

function tm_is_paid_member(){
	//echo get_current_user_id();
    $member   = pms_get_member(get_current_user_id() );
    
    // print_r($member);
    // die();
    return ($member->subscriptions && $member->subscriptions[0] && $member->subscriptions[0]['status'] == 'active') ? true : false;
}

function is_reset($userId){
    $havemeta = get_user_meta($userId, 'tm_reset', true);
    $o = !empty($havemeta) ? true : false;
    return $o;
}