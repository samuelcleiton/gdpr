<?php


/**
 * Plugin Name: GDPR Test plugin
 * Description: A test plugin for wordpress
 * Author: Samuel Cleiton da Silva
 * Version: 0.1
 */

function gdpr_default_values() {

    return array (
        "gdpr_enabled" => "",
        "gdpr_position" => "top",
        "gdpr_theme" => "ocean",
        "gdpr_button_label" => "aceito",
        "gdpr_message" => "We use cookies to provide our services and for analytics and marketing. To find out more about our use of cookies, please see our Privacy Policy. By continuing to browse our website, you agree to our use of cookies. "
    );
} 




function gdpr_admin() {
    $gdpr_default_values = gdpr_default_values();
    include('gdpr_admin.php');
}


add_action('admin_menu', 'gdpr_actions');


function gdpr_actions(){
   
    $page_title = 'Page Title - GDPR Plugin';
    $menu_title = 'GDPR Plugin';
    $capability = 'manage_options';
    $menu_slug  = 'gdpr-plugin';
    $function   = 'gdpr_admin';

    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function );
}


// add_action( 'admin_init', 'gdpr_compliance_init' );
// add_action('init', 'gdpr_compliance_init');
// add_action('wp_head', array($this, 'single_custom_css'));


if (get_option('gdpr_enabled') == "true" ) {
    add_action( 'wp_body_open', 'gdpr_compliance_init' );
}




function gdpr_compliance_init () {
    $gdpr_default_values = gdpr_default_values();
  
    $gdpr_enabled = get_option("gdpr_enabled") ?: $gdpr_default_values["gdpr_enabled"];
    $gdpr_position = empty(get_option("gdpr_position")) ? $gdpr_default_values["gdpr_position"] : get_option("gdpr_position");
    $gdpr_theme = empty(get_option("gdpr_theme")) ? $gdpr_default_values["gdpr_theme"] : get_option("gdpr_theme");
    $gdpr_button_label = empty(get_option("gdpr_button_label")) ? $gdpr_default_values["gdpr_button_label"] : get_option("gdpr_button_label");
    $gdpr_message = empty(get_option("gdpr_message")) ? $gdpr_default_values["gdpr_message"] : get_option("gdpr_message");


    if(!isset($_COOKIE['gdpr_accordance'])) {
        ?>
        <link rel="stylesheet" href="<?=plugin_dir_url( __FILE__ )?>style.css"  />
        <div class="<?= $gdpr_theme ?> <?= $gdpr_position ?> gdpr-message"  >
            <p><?= $gdpr_message ?></p>
            <button style="float:right" onclick="document.cookie='gdpr_accordance=ok';this.parentNode.style.display='none';">
            <?= $gdpr_button_label ?>
            </button>
            <!-- <input type="button" value="" style="float:right" /> -->
        </div>
        <?php
    }
}



