<?php

add_action( 'after_setup_theme', 'zfw_setup' );



if ( !function_exists( 'zfw_setup' ) ):

	function zfw_setup() {

		add_editor_style();

		add_theme_support( 'post-formats', array( ) );

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'automatic-feed-links' );

		load_theme_textdomain( 'zfw', get_template_directory() . '/languages' );

		$locale = get_locale();

		$locale_file = get_template_directory() . "/languages/$locale.php";

		if ( is_readable( $locale_file ) )

			require_once( $locale_file );

		register_nav_menus( array(

			'primary' => __( 'Primary Navigation', 'zfw' ),

		) );

	}

endif;





function call( $php_file ) {
	

	//$shared_path = "../../../";

	//$shared_dir = "cache/";

	include( "inc/$php_file.php" );
	//include( get_stylesheet_directory() . $shared_path . $shared_dir . "inc/$php_file.php" );
	//echo get_stylesheet_directory() . $shared_path . $shared_dir . "inc/$php_file.php";


}

	//echo file_exists( "../../../cache/inc/cpt.php")."xxxxxxxxxxx";




@call( 'BFI_Thumb' );

// Change the upload subdirectory to wp-content/uploads/other_dir

@define( BFITHUMB_UPLOAD_DIR, 'imgs' );

@call( 'wp_bootstrap_navwalker' );

@call( 'func' );

@call( 'cpt' );

@call( 'tweaks' );



function theme_name_scripts() {

	/*------------------*/

	wp_enqueue_style( 'Cairo', 'http://fonts.googleapis.com/css?family=Cairo:200,300,400,600,700,900&amp;subset=arabic', 'all' );

	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.0.8/css/all.css', 'all' );

	wp_enqueue_style( 'bootstrap.min', get_template_directory_uri() . '/fw/css/bootstrap.min.css', 'all' );

	wp_enqueue_style( 'bootstrap.min-rtl', get_template_directory_uri() . '/fw/css/bootstrap-rtl.min.css?ver=1', 'all' );

	wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/fw/css/owl.carousel.css', 'all' );

	wp_enqueue_style( 'owl.theme', get_template_directory_uri() . '/fw/css/owl.theme.css', 'all' );

	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/fw/css/main.css', 'all' );



	wp_enqueue_style( 'Animate', get_template_directory_uri() . '/fw/css/animate.min.css', 'all' );

	wp_enqueue_style( 'fancy-css', get_template_directory_uri() . '/fw/css/jquery.fancybox.css', 'all' );

	wp_enqueue_style( 'style', get_stylesheet_uri(), 'all' );



	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/fw/js/jquery-2.1.3.min.js', array(), '1.0.0', true );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/fw/js/bootstrap.min.js', array(), '1.0.0', true );

	wp_enqueue_script( 'Fancybox_js', get_template_directory_uri() . '/fw/js/jquery.fancybox.js', array(), '1.0.0', true );

	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/fw/js/owl.carousel.js', array(), '1.0.0', true );

	wp_enqueue_script( 'navigation', get_template_directory_uri() . '/fw/js/navigation.js', array(), '1.0.0', true );

	wp_enqueue_script( 'Custom',  'http://www.smcc.sa/common/function_js.js', array(), '1.0.0', true );

	/*-----------------------------------------*/

}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );





function edtitor_scrtipt() {}

