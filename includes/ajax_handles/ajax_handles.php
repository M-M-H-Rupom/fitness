<?php
// ajax handle balanced update
function balance_ajax_callback(){
    $current_user = wp_get_current_user();
    if(isset($_POST['balanced_val'])){
        $balance_value = $_POST['balanced_val'];
        if(!empty($balance_value)){
            update_post_meta( $current_user->ID, 'user_current_balance', $balance_value );
        }
    }
    $current_balance = get_post_meta( $current_user->ID, 'user_current_balance', true);
    wp_send_json($current_balance);
}
add_action( 'wp_ajax_balance_ajax', 'balance_ajax_callback');

// ajax handle discount update
function discount_ajax_callback(){
    $current_user = wp_get_current_user();
    if(isset($_POST['discount_val'])){
        $discount_value = $_POST['discount_val'];
        if(!empty($discount_value)){
            update_post_meta( $current_user->ID, 'discount_balance', $discount_value );
        }
    }
    $current_discount = get_post_meta( $current_user->ID, 'discount_balance', true);
    wp_send_json($current_discount);
}
add_action( 'wp_ajax_discount_ajax', 'discount_ajax_callback');