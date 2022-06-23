<?php if ( ! defined( 'ABSPATH' ) ) exit;  ?>
<?php

$success_message = '';
$error_message = '';


include('settings.php');


wp_enqueue_media();


if( isset($_POST['cndev_chat_button_nonce']) ) {

    if( wp_verify_nonce($_POST['cndev_chat_button_nonce'], 'cndev_chat_button_action') ) {

      -

        $display_button_checkbox = cndev_chat_btn_checkbox_isset('display_button_checkbox');
        $chat_number = sanitize_text_field( $_POST['chat_number'] );
        $chat_message = sanitize_text_field( $_POST['chat_message'] );
        $button_width = intval( $_POST['button_width'] );
        $button_height = intval( $_POST['button_height'] );
        $horizontal_position = sanitize_text_field( $_POST['horizontal_position'] );
        $horizontal_spacing = sanitize_text_field( $_POST['horizontal_spacing'] );
        $vertical_position = sanitize_text_field( $_POST['vertical_position'] );
        $vertical_spacing = sanitize_text_field( $_POST['vertical_spacing'] );
        $button_z_index = intval( $_POST['button_z_index'] );
        $icon_image_url = esc_url_raw( $_POST['icon_image_url'] );
        $chat_button_type = sanitize_text_field( $_POST['chat_button_type'] );
        $hide_button_on_desktop = cndev_chat_btn_checkbox_isset('hide_button_on_desktop');
        $hide_button_on_mobile = cndev_chat_btn_checkbox_isset('hide_button_on_mobile');
        $mobile_width = intval( $_POST['mobile_width'] );
        $mobile_button_position_checkbox = cndev_chat_btn_checkbox_isset('mobile_button_position_checkbox');
        $mobile_horizontal_position = sanitize_text_field( $_POST['mobile_horizontal_position'] );
        $mobile_horizontal_spacing = sanitize_text_field( $_POST['mobile_horizontal_spacing'] );
        $mobile_vertical_position = sanitize_text_field( $_POST['mobile_vertical_position'] );
        $mobile_vertical_spacing = sanitize_text_field( $_POST['mobile_vertical_spacing'] );

        $exclude_option = sanitize_text_field( $_POST['exclude_option'] );
        $exclude_ids = sanitize_text_field( $_POST['exclude_ids'] );



        $plugin_data_array = array(
            'display_button_checkbox' => $display_button_checkbox,
            'chat_number' => $chat_number,
            'chat_message' => $chat_message,
            'button_width' => $button_width,
            'button_height' => $button_height,
            'horizontal_position' => $horizontal_position,
            'horizontal_spacing' => $horizontal_spacing,
            'vertical_position' => $vertical_position,
            'vertical_spacing' => $vertical_spacing,
            'button_z_index' => $button_z_index,
            'icon_image_url' => $icon_image_url,
            'chat_button_type' => $chat_button_type,
            'hide_button_on_desktop' => $hide_button_on_desktop,
            'hide_button_on_mobile' => $hide_button_on_mobile,
            'mobile_width' => $mobile_width,
            'mobile_button_position_checkbox' => $mobile_button_position_checkbox,
            'mobile_horizontal_position' => $mobile_horizontal_position,
            'mobile_horizontal_spacing' => $mobile_horizontal_spacing,
            'mobile_vertical_position' => $mobile_vertical_position,
            'mobile_vertical_spacing' => $mobile_vertical_spacing,

            'exclude_option' => $exclude_option,
            'exclude_ids' => $exclude_ids,
        ); -

        $array_key_name = '';
        $array_item_value = '';

	    foreach($plugin_data_array as $key=>$item) {
	        $array_key_name .= "####" . $key;
			$array_item_value .= "####" . $item;
	    }
        $plugin_data = $array_key_name . "***" . $array_item_value;
        $plugin_data = sanitize_text_field($plugin_data);

        // update optuon on the database into wp_options
        update_option($wp_options_name, $plugin_data);

        $success_message = "The data was updated successfully";

    } else {
        $error_message = "Form nonce was incorrect";
    }

}
$getting_plugin_data = get_option($wp_options_name);

if( !empty($getting_plugin_data) ) {

    // ----------------------------------------------
    // breaking the string into to 2 variables. the array namd and vakue
    // ----------------------------------------------

    $break_array = explode("***", $getting_plugin_data);

    $item_name = explode("####", $break_array[0]);
    $key_name = explode("####", $break_array[1]);

    $array_count = count($key_name);



    for($count_number = 0; $count_number < $array_count; $count_number++) {
    	$plugin_data_array[ $item_name[$count_number] ] = $key_name[$count_number];
    }

}

?>

<div class="wrap cndevelopment-btn-chat">

    <h2 class="display-inline"> Button Settings</h2>
    <?php cndev_chat_btn_echo_success_message_if_exists($success_message); ?>
    <?php cndev_chat_btn_echo_error_message_if_exists($error_message); ?>

    <div class="insert-new">

<form class="edit-form-data" method="POST" action="">

        <br />
        <h2> Basic Settings: </h2>

        <div class="cndev_chat_btn_line">
            <input type="checkbox" id="display_button_checkbox" class="checkbox" name="display_button_checkbox" value="1" <?php if($plugin_data_array['display_button_checkbox'] == 1) {echo "checked";} ?> />
            <label for="display_button_checkbox">Display button on the site (when unselected the button won't show up)</label>
        </div><!--cndev_chat_btn_line-->

        <div class="cndev_chat_btn_line">
            <label for="chat_number">Whatsapp Number: </label>
            <input type="text" id="chat_number" class="input-short" name="chat_number" value="<?php echo cndev_chat_btn_html_output($plugin_data_array['chat_number']); ?>" />
            <small>Example: 972739999999</small>
        </div><!--cndev_chat_btn_line-->

        <div class="cndev_chat_btn_line">
            <label for="chat_message">Whatsapp Message: </label>
            <input type="text" id="chat_message" class="input-short" name="chat_message" value="<?php echo cndev_chat_btn_html_output($plugin_data_array['chat_message']); ?>" />
            <small>Example: Thanks for contacting us</small>
        </div><!--cndev_chat_btn_line-->

        <div class="cndev_chat_btn_line">
            <label for="button_width">Image Width: </label>
            <input type="text" id="button_width" class="input-very-short" name="button_width" value="<?php echo cndev_chat_btn_html_output($plugin_data_array['button_width']); ?>" /> PX
        </div><!--cndev_chat_btn_line-->

        <div class="cndev_chat_btn_line">
            <label for="button_height">Image Height: </label>
            <input type="text" id="button_height" class="input-very-short" name="button_height" value="<?php echo cndev_chat_btn_html_output($plugin_data_array['button_height']); ?>" /> PX
        </div><!--cndev_chat_btn_line-->

        <div class="cndev_chat_btn_line">
            <label for="button_z_index">Z-index: </label>
            <input type="text" id="button_z_index" class="input-very-short" name="button_z_index" value="<?php echo cndev_chat_btn_html_output($plugin_data_array['button_z_index']); ?>" />
            <small>Example: 9999</small>
        </div><!--cndev_chat_btn_line-->

        <div class="cndev_chat_btn_line">
            <label for="horizontal_position">Horizontal Position: </label>

            <select name="horizontal_position">
                <option value="left" <?php if($plugin_data_array['horizontal_position'] == "left") {echo "selected";} ?> >Left</option>
                <option value="right" <?php if ($plugin_data_array['horizontal_position'] == "right") {echo "selected";} ?> >Right</option>
            </select>

            <label for="horizontal_spacing">Horizontal Spacing: </label>
            <input type="text" id="horizontal_spacing" class="input-very-short" name="horizontal_spacing" value="<?php echo cndev_chat_btn_html_output($plugin_data_array['horizontal_spacing']); ?>" />
            <small>Examples: 10px, 50%</small>
        </div><!--cndev_chat_btn_line-->


        <div class="cndev_chat_btn_line">
            <label for="vertical_position">Vertical Position: </label>

            <select name="vertical_position">
                <option value="top" <?php if($plugin_data_array['vertical_position'] == "top") {echo "selected";} ?> >Top</option>
                <option value="bottom" <?php if ($plugin_data_array['vertical_position'] == "bottom") {echo "selected";} ?> >Bottom</option>
            </select>

            <label for="vertical_spacing">Vertical Spacing: </label>
            <input type="text" id="vertical_spacing" class="input-very-short" name="vertical_spacing" value="<?php echo cndev_chat_btn_html_output($plugin_data_array['vertical_spacing']); ?>" />
            <small>Examples: 10px, 50%</small>
        </div><!--cndev_chat_btn_line-->

        <div class="cndev_chat_btn_line">
            <img class="cndev_light_img_bg" src="<?php echo esc_url($plugin_data_array['icon_image_url']); ?>" alt="" />
            <br /><br />
<?php

            $chat_button1 = plugin_dir_url(dirname(__FILE__)) . 'images/chat-button1.png';
            $chat_button2 = plugin_dir_url(dirname(__FILE__)) . 'images/chat-button2.png';
            $chat_button3 = plugin_dir_url(dirname(__FILE__)) . 'images/chat-button3.png';

?>
            <label for="chat_button_type">Whatsapp Button type: </label>
            <select name="chat_button_type" class="chat_button_type">
                <option value="<?php echo $chat_button1; ?>" <?php if($plugin_data_array['chat_button_type'] === $chat_button1) {echo "selected";} ?> >Whatsapp Button 1</option>
                <option value="<?php echo $chat_button2; ?>" <?php if($plugin_data_array['chat_button_type'] === $chat_button2) {echo "selected";} ?> >Whatsapp Button 2</option>
                <option value="<?php echo $chat_button3; ?>" <?php if($plugin_data_array['chat_button_type'] === $chat_button3) {echo "selected";} ?> >Whatsapp Button 3</option>
                <option value="custom" <?php if($plugin_data_array['chat_button_type'] === 'custom') {echo "selected";} ?> >Custom Image</option>
            </select>
            <br /><br />
            <input type="text" id="icon_image_url" class="input-very-long cndev_image_input" name="icon_image_url" value="<?php echo esc_url($plugin_data_array['icon_image_url']); ?>" />
            <input type="button" name="cndev_upload_image" class="cndev_upload_image button-secondary" value="Choose Custom Icon..." />

            <div class="clear"></div>
        </div><!--cndev_chat_btn_line-->


        <br />
        <h2> Display Settings: </h2>

        <div class="cndev_chat_btn_line">
            <input type="checkbox" id="hide_button_on_desktop" class="checkbox" name="hide_button_on_desktop" value="1" <?php if($plugin_data_array['hide_button_on_desktop'] == 1) {echo "checked";} ?> />
            <label for="hide_button_on_desktop">Hide the button on desktop (will display button only on mobile)</label>
        </div><!--cndev_chat_btn_line-->

        <div class="cndev_chat_btn_line">
            <input type="checkbox" id="hide_button_on_mobile" class="checkbox" name="hide_button_on_mobile" value="1" <?php if($plugin_data_array['hide_button_on_mobile'] == 1) {echo "checked";} ?> />
            <label for="hide_button_on_mobile">Hide the button on mobile (will display button only on desktop)</label>
        </div><!--cndev_chat_btn_line-->

        <div class="cndev_chat_btn_line">
            <label for="mobile_width">Define mobile screen resolution (affect the 2 checkboxes above): </label>
            <input type="text" id="mobile_width" class="input-very-short" name="mobile_width" value="<?php echo cndev_chat_btn_html_output($plugin_data_array['mobile_width']); ?>" /> PX
        </div><!--cndev_chat_btn_line-->


        <br/>

        <?php
            // creating nonce to make sure the form was submitted correctly from the right page
            wp_nonce_field( 'cndev_chat_button_action', 'cndev_chat_button_nonce' );
        ?>

        <input type="submit" class="edit-form-data cndev-tags-submit" name="insert_top_btn" value="Submit" />

</form>
