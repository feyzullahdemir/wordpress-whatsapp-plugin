<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php



function cndev_chat_btn_html_output($output_code) {

    $output_code = stripslashes_deep($output_code);
    $output_code = esc_html($output_code);
    return $output_code;
}
function cndev_chat_btn_show_error_message($error_message, $display_inline = "") {

    if($display_inline == 1) {
        $display_inline_echo = "display-inline";
    }

    if( isset($error_message) ) {
        ?>

        <div class="output-data-error-message <?php echo $display_inline_echo; ?>">
            <?php echo $error_message; ?>
        </div>

        <?php
    }

}

function cndev_chat_btn_checkbox_isset($post_value) {

    $checkbox_value = '';

    if( isset( $_POST[$post_value] ) ) {
        $checkbox_value = intval($_POST[$post_value]);
    }

    return $checkbox_value;

}

function cndev_chat_btn_echo_success_message_if_exists($success) {

    if(isset($success) && !empty($success) ) {
        echo "<div class='output-messsage'> " . htmlentities($success) . " </div>";
    }

}

function cndev_chat_btn_echo_error_message_if_exists($error) {

    if(isset($error) && !empty($error) ) {
        echo "<div class='error-messsage'><b>Error:</b> " .  $error . " </div>";
    }

}


function cndev_chat_btn_find_page_id() {

    global $wpdb;
    $post_id_num = 0;


    if( is_single() || is_page() ) {
    	$post_id_num = get_the_ID();
    }


    if( is_home() ) {
    	$blog_page_id = get_option( 'page_for_posts' );


    	if( !empty($blog_page_id) ) {
    		$post_id_num = $blog_page_id;
    	}

    }

    return intval($post_id_num);

}

function cndev_chat_btn_redirections_page($link) {
	header("Location: {$link}");
	exit;
}
