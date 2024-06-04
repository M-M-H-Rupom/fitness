<?php

class bookingMetabox {
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_fields' ) );
    }
	
    public function add_meta_boxes() {
            add_meta_box(
                'booking',
                'Booking',
                array( $this, 'booking_meta_box_callback' ),
                'booking_rules',
                'advanced',
                'default'
            );
    }
    
    public function booking_meta_box_callback( $post ) {
        wp_nonce_field( 'booking_data', 'booking_nonce' );
        $this->booking_field_generator( $post );
    }
    public function booking_field_generator( $post ) {
        $bkng_room = get_post_meta( $post->ID, 'bkng_room', true );
        $bkng_days = get_post_meta( $post->ID, 'bkng_days', true );
        $bkng_start_time = get_post_meta( $post->ID, 'bkng_start_time', true );
        $bkng_end_time = get_post_meta( $post->ID, 'bkng_end_time', true );
        $bkng_cancellation = get_post_meta( $post->ID, 'bkng_cancellation', true );

        ?> 
        <div class="booking_metabox_container">
            <div class="bkng_room">
                <label for="">
                    <span>Room : </span>
                    <select name="bkng_room" id="bkng_room">
                        <option value="1" <?php echo ($bkng_room == '1') ? 'selected' : ''; ?>> 1 </option>
                        <option value="2" <?php echo ($bkng_room == '2') ? 'selected' : ''; ?>> 2 </option>
                    </select>
                </label>
            </div>
            <div class="bkng_days">
                <label for="">
                    <span>Days :</span>
                    <select name="bkng_days" id="bkng_days">
                        <option value="Saturday"> Saturday </option>
                        <option value="Sunday"> Sunday </option>
                        <option value="Monday"> Monday </option>
                        <option value="Tuesday"> Tuesday </option>
                        <option value="Wednesday"> Wednesday </option>
                        <option value="Thursday"> Thursday </option>
                        <option value="Friday"> Friday </option>
                    </select>
                </label>
            </div>
            <div class="bkng_start_time">
                <label for="">
                    <span>Start Time :</span>
                    <input type="text" name="bkng_start_time" id="bkng_start_time" value="<?php echo $bkng_start_time ?>">
                </label>
            </div>
            <div class="bkng_end_time">
                <label for="">
                    <span>End Time :</span>
                    <input type="text" name="bkng_end_time" id="bkng_end_time" value="<?php echo $bkng_end_time ?>">
                </label>
            </div>
            <div class="bkng_cancellation">
                <label for="">
                    <span>Cancellation :</span>
                    <select name="bkng_cancellation" id="bkng_cancellation">
                        <option value="24h"> 24h</option>
                        <option value="48h"> 48h</option>
                    </select>
                </label>
            </div>
            <div class="meta_package_price_title">
                <span> Add Package Price</span>
            </div>
            <div class="gmf_package_container">
                <div class="gmf_package">
                    <div class="package_select">
                        <select name="package_category" id="">
                        <?php
                        $parent_args = [
                            'taxonomy'     => 'package',
                            'parent'        => 0,
                            'hide_empty'    => false
                        ];
                        $package_terms = get_terms( $parent_args );
                        foreach($package_terms as $a_package_term){
                            ?>
                            <option value=""> <?php echo $a_package_term->name ?> </option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                    <div class="package_discount_field">
                        <input type="number" name="balance_discount" id="" class="balance_discount">
                    </div>
                    <div class="package_close_img">
                        <img src="https://placehold.co/30x30" alt="">
                    </div>
                </div>
            </div>
            <div class="add_more_package">
                <span class="more_package">Add more </span>
            </div> 
        </div>
        <?php 
    }

    public function save_fields( $post_id ) {
        $nonce = $_POST['booking_nonce'];
        if ( ! isset( $_POST['booking_nonce'] ) && !wp_verify_nonce( $nonce, 'booking_data' ) ){
            return $post_id;
        }
        if ( isset( $_POST['bkng_room' ] ) ) {   // update room field
            update_post_meta( $post_id, 'bkng_room', $_POST['bkng_room'] );
        }
        if ( isset($_POST['bkng_days']) ) {     // update days field
            update_post_meta($post_id, 'bkng_days', $_POST['bkng_days']);
        }
        if ( isset($_POST['bkng_start_time']) ) {   // update start time field
            update_post_meta($post_id, 'bkng_start_time', $_POST['bkng_start_time']);
        }
        if ( isset($_POST['bkng_end_time']) ) {   // update end time field
            update_post_meta($post_id, 'bkng_end_time', $_POST['bkng_end_time']);
        }
        if ( isset($_POST['bkng_cancellation']) ) {   // update cancellation field
            update_post_meta($post_id, 'bkng_cancellation', $_POST['bkng_cancellation']);
        }
    }
}
new bookingMetabox();
