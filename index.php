<?php if ( ! defined( 'ABSPATH' ) ) exit;  ?>
<?php
/*
Plugin Name: Button Chat
Plugin URI:https://wordpress.org/plugins/button-chat-wp-new
Description: chat update button WhatsApp
Version:    1.0.0
Author:      kaan
Author URI: https://fududigital.com/
License: GNU
*/

include_once('include/settings.php');
require_once('include/functions.php');



function cndev_chat_btn_create_database() {

    require_once('include/install.php');

}

register_activation_hook(__FILE__, 'cndev_chat_btn_create_database');


function output_cndev_chat_btn() {

    include('include/style.php');
    include('include/scripts.php');
    include('include/admin-output.php');

}
function register_cndev_chat_btn_page() {
    add_options_page( 'Chat button', "Chat Button", 'manage_options', 'cndev-chat-btn', 'output_cndev_chat_btn');
}

add_action('admin_menu', 'register_cndev_chat_btn_page');




if( !is_admin() ) {
    include('include/front-end-output.php');
}


if( is_admin() ) {
	include_once('notices.php');
}
