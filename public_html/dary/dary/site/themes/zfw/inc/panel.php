<?php
define("Main","اعدادات القالب");
define("Sub","الاعدادات العامة");
function Add_Panel() {
$icon = get_template_directory_uri().'/include/icon.png';
add_menu_page( Main, Main, 'manage_options', 'main', 'main_func', $icon ,3);
add_submenu_page( 'main', Sub, Sub, 'manage_options', 'main', 'main_func' );
//add_submenu_page( 'main', Sub1, Sub1, 'manage_options', 'himage', 'hotel_image' );
}
function mytheme_add_init_css() {  
$file_dir=get_bloginfo('template_directory');  
wp_enqueue_style("panel", $file_dir."/inc/panel.css", false, "1.0", "all");  
} 
/*function const_tech__print_scripts() {
    wp_enqueue_style( 'thickbox' ); // Stylesheet used by Thickbox
    wp_enqueue_script( 'thickbox' );
    wp_enqueue_script( 'media-upload' );
    wp_enqueue_script( 'const_tech_upload', 
	get_template_directory_uri() . '/include/const_tech_upload.js', array( 'thickbox', 'media-upload' ) );
}*/
$wpdb->show_errors();
require_once ("panel_main.php");
add_action('admin_menu', 'Add_Panel');
add_action('admin_init', 'mytheme_add_init_css');
/*add_action( 'admin_print_scripts', 'const_tech__print_scripts' );*/
?>