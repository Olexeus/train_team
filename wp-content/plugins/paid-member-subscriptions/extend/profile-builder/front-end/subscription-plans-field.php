<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/* handle field output */
function pms_pb_subscription_plans_handler( $output, $form_location, $field, $user_id, $field_check_errors, $request_data ) {

    if ( $field['field'] == 'Subscription Plans' ){

        $output = '';

        // Display fields on register forms
        if( $form_location == 'register' ) {


            /*
             * E-mail Confirmation compatibility issues
             * We remove all filters that add data to
             *
             */
            $wppb_general_settings  = get_option( 'wppb_general_settings' );
            $has_email_confirmation = ( !empty( $wppb_general_settings['emailConfirmation'] ) && $wppb_general_settings['emailConfirmation'] == 'yes' ? true : false );

            if( $has_email_confirmation ) {

                remove_filter( 'pms_output_subscription_plans', 'pms_output_subscription_plans_payment_gateways', 10 );
                remove_filter( 'pms_output_subscription_plans', 'pms_dc_output_discount_box', 25 );
                remove_filter( 'pms_output_subscription_plans', 'pms_renewal_option_field', 10 );

            }


            $selected_subscription_plan = ( isset( $field['subscription-plan-selected'] ) && !empty( $field['subscription-plan-selected'] ) ? $field['subscription-plan-selected'] : -1 );

            // Field title
            if( !empty( $field['field-title'] ) )
                $output .= '<h4>' . $field['field-title'] . '</h4>';

            // Field descriptions
            if( !empty( $field['description'] ) )
                $output .= '<span class="description">' . $field['description'] . '</span>';

            // Subscription plans
            if( !empty( $field['subscription-plans'] ) ) {

                $subscription_plans = explode( ', ', $field['subscription-plans'] );
                $output .= pms_output_subscription_plans( $subscription_plans, array(), false, $selected_subscription_plan, 'register' );

            // If no subscription plans where selected display all subscription plans
            } else {
                $output .= pms_output_subscription_plans( array(), array(), false, $selected_subscription_plan, 'register' );
            }

            // Add a simple message to let users know that they will be able to complete the payment
            // after they confirm the e-mail address
            if( $has_email_confirmation )
                $output .= apply_filters( 'pms_pb_subscription_plans_field_payment_attention_message', '<p class="pms-email-confirmation-payment-message wppb-success">' . __( 'You will be able to complete the payment after you have confirmed your e-mail address.', 'paid-member-subscriptions' ) . '</p>' );

        }

        // Display field on edit profile form
        if( $form_location == 'edit_profile' ) {

            $member = pms_get_member( $user_id );

            if( $member->is_member() ) {

                ob_start();

                echo do_shortcode('[pms-account show_edit_profile="no"]');

                $output .= ob_get_contents();

                ob_end_clean();

            }

        }

        return apply_filters( 'wppb_'.$form_location.'_subscription_plans_field', $output, $form_location, $field, $user_id, $field_check_errors, $request_data );

    }
}
add_filter( 'wppb_output_form_field_subscription-plans', 'pms_pb_subscription_plans_handler', 10, 6 );
add_filter( 'wppb_admin_output_form_field_subscription-plans', 'pms_pb_subscription_plans_handler', 10, 6 );


/*
 * Function that handles the field validation for this field
 *
 */
function pms_pb_check_subscription_plans_value( $message, $field, $request_data, $form_location ) {

    if( $form_location != 'register' )
        return $message;

    $validate = PMS_Form_Handler::validate_subscription_plans( $request_data );

    if( $validate == false ) {

        $code    = pms_errors()->get_error_code();
        $message = pms_errors()->get_error_message( $code );

    }

    return $message;
}
add_filter( 'wppb_check_form_field_subscription-plans', 'pms_pb_check_subscription_plans_value', 10, 4 );


/*
 * Function that handles the field save for this field
 *
 */
function pms_pb_save_subscription_plans_value( $field, $user_id, $request_data, $form_location ){

    // Exit if this field is not the subscription plans one
    if( $field['field'] != 'Subscription Plans' )
        return;

    if( $form_location != 'register' )
        return;

    // Prepare user data
    $user_data = PMS_Form_Handler::get_request_member_data( $user_id );

    // Process checkout
    PMS_Form_Handler::process_checkout( $user_data );

}
add_action( 'wppb_save_form_field', 'pms_pb_save_subscription_plans_value', 10, 4 );
add_action( 'wppb_backend_save_form_field', 'pms_pb_save_subscription_plans_value', 10, 4 );


/*
 * Function that adds subscription plan names in Manage fields array to be used in conditional logic
 *
 */
function pms_pb_add_subscription_plan_names( $manage_fields ){
    foreach ( $manage_fields as $key => $value ) {
        if ( $manage_fields[$key]['field'] == 'Subscription Plans' ){
            if ( empty ( $manage_fields[$key]['subscription-plans'] ) ) {
                // if no plan is selected then include all plans
                $selected_subscription_plans = '';
                $include_all_plans = true;
            }else{
                $selected_subscription_plans = explode(',', $manage_fields[$key]['subscription-plans']);
                $include_all_plans = false;
            }

            $subscription_plan_names = array();
            $subscription_plan_ids = array();
            foreach (pms_get_subscription_plans() as $subscription_plan){
                if ( $include_all_plans || in_array( $subscription_plan->id, $selected_subscription_plans ) ) {
                    $subscription_plan_names[] = $subscription_plan->name;
                    $subscription_plan_ids[] = $subscription_plan->id;
                }
            }
            $manage_fields[$key]['subscription-plan-names'] = implode( ',', $subscription_plan_names );
            $manage_fields[$key]['subscription-plan-ids'] = implode( ',', $subscription_plan_ids );
        }
    }

    return $manage_fields;
}
add_filter ( 'wppb_cf_form_fields', 'pms_pb_add_subscription_plan_names' );
