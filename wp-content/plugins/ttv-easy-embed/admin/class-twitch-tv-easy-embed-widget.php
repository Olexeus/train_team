<?php

function load_scripts() {
    wp_enqueue_script('twitch-tv-easy-embed-', plugins_url( '/public/js/slick.1.6.0.min.js', dirname( __FILE__ ) ), array('jquery'), $this->version, false );
}

	class TTV_Easy_Embed_Widget extends WP_Widget {
		function __construct() {
		    parent::__construct(
		        // base ID of the widget
		        'ttv-easy-embed-widget',
		        // name of the widget
		        'Easy Embed Twitch Widget',
		        // widget options
		        array (
		            'description' => 'Displays the Easy Embed Twitch.tv Widget.'
		        )
		    );		
		}
		function form( $instance ) {
		    $defaults = array(
		        'channel' => '',
						'title' => ''
		    );
		    $channel = $instance[ 'channel' ];
				$title = $instance[ 'title' ];
		    // markup for form ?>
				<p>
		        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title (optional):</label>
		        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>">
		    </p>
		    <p>
		        <label for="<?php echo $this->get_field_id( 'channel' ); ?>">Twitch Channel:</label>
		        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'channel' ); ?>" name="<?php echo $this->get_field_name( 'channel' ); ?>" value="<?php echo esc_attr( $channel ); ?>">
		    </p>
		<?php
		}
		function update( $new_instance, $old_instance ) {
		    $instance = $old_instance;
		    $instance[ 'channel' ] = strip_tags( $new_instance[ 'channel' ] );
		    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		    return $instance;
		}
		function widget( $args, $instance ) {
		    // kick things off
		    extract( $args );
		    echo $before_widget;
		    echo $before_title . $instance[ 'title' ] . $after_title;
				include (plugin_dir_path( __FILE__ ) . '/../public/partials/widget-output.php');
				}
	}

	function ttv_register_easy_embed_widget() {
	    register_widget( 'TTV_Easy_Embed_Widget' );
	}

function tutsplus_check_for_page_tree() {
    //start by checking if we're on a page
    if( is_page() ) {
        global $post;
        // next check if the page has parents
        if ( $post->post_parent ){
            // fetch the list of ancestors
            $parents = array_reverse( get_post_ancestors( $post->ID ) );
            // get the top level ancestor
            return $parents[0];
        }
        // return the id  - this will be the topmost ancestor if there is one, or the current page if not
        return $post->ID;
    }
}

	add_action( 'widgets_init', 'ttv_register_easy_embed_widget' );
