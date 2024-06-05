<?php 
$current_user = wp_get_current_user();
?>  
<div class="gmf_user_container">
   <div class="gmf_user_heading">
        <div class="gmf_user_id item">
            <span>User Id</span>    
        </div>
        <div class="gmf_user_name item">
            <span>User Name</span>
        </div>
        <div class="gmf_user_balance item">
            <span>Balance</span>
        </div>
        <div class="gmf_update_balance">
            <span>Update Balance</span>
        </div>
   </div>
   <div class="gmf_user_content">
        <div class="user_id_data item">
            <span><?php echo $current_user->ID; ?> </span>
        </div>
        <div class="user_name_data item">
            <span><?php echo $current_user->user_login; ?> </span>
        </div>
        <div class="user_balance_data item">
            <span><?php echo get_post_meta( $current_user->ID, 'user_current_balance', true) ?> </span>
        </div>
        <div class="user_balance_field">
            <input type="number" name="user_balance" class="user_balance">
            <button class="update_balanced"> Update Balance</button>
        </div>
   </div>
   <div class="discount_container">
        <div class="add_discount_title">
            <span>Add discount</span>
        </div>
        <div class="discount_package">
            <span>Packages :</span>
        </div>
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
                <img src="<?php echo GMF_URL . 'assets/images/close_btn.png' ?>" alt="">
            </div>
        </div>
    </div>
    <div class="add_more_package customer_table_pack" >
        <span class="more_package">Add more </span>
    </div>
</div>
