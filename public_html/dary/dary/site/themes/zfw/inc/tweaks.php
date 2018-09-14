<?php
/*-------- Remove Default custom fields -----------*/
add_action('admin_init','customize_meta_boxes');

function customize_meta_boxes() {
remove_meta_box('postcustom','serv','normal');
}


/*----------------- Dashboard ------------------*/
// Function that outputs the contents of the dashboard widget
function dashboard_widget_function( $post, $callback_args ) {
	?>
   <img src="<? echo get_template_directory_uri(); ?>/screenshot.png" style="width:100%">
    <?php
}
// Function used in the action hook
function add_dashboard_widgets() {
	wp_add_dashboard_widget('dashboard_widget', 'Al-Zwaid FrameWork', 'dashboard_widget_function');
}
add_action('wp_dashboard_setup', 'add_dashboard_widgets' );

/*---------------------------------*/
function dashboard_widget_function_support( $post, $callback_args ) {
	?>
   <a href="http://my.de.net.sa/web/clientarea.php" target="new">
 <br /> <br /><br /><br /><br /><img src="http://www.de.net.sa/ar/wp-content/uploads/2015/08/logo1.jpg" style="width:100%"><br />
<center><span>انتقل إلى موقع دعم شركة المطورين</span></center><br /><br /><br /><br /><br /></a>
    <?php
}
// Function used in the action hook
function add_dashboard_widgets_support() {
	wp_add_dashboard_widget('dashboard_widget2', 'دعم شركة المطورين', 'dashboard_widget_function_support');
}
add_action('wp_dashboard_setup', 'add_dashboard_widgets_support' );
/*function my_error_notice() {

	// if ( $pagenow == 'index.php'  ) {
    ?>
   <img src="<? echo get_template_directory_uri(); ?>/screenshot.png" class="logo">
    <?php
//}
}
add_action( 'admin_notices', 'my_error_notice' );*/

/* IF HASA THUMB --*/
function thumb_it( $width, $height, $crop ) {
	if ( has_post_thumbnail() ) {
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
	} else {
		$large_image_url[0] = get_stylesheet_directory_uri()."/fw/images/no-image.jpg";
		}
		$params =
			array( 'width' => $width, 'height' => $height, 'crop' => $crop ); //crop_only is very very very IMP
		$image = bfi_thumb( $large_image_url[ 0 ], $params );
		echo $image;
	//}
}
/* -------------- LIMIT menu items for none admin users  --------------*/
/* SOURCE :: http://www.wpmayor.com/how-to-remove-menu-items-in-admin-depending-on-user-role/*/
global $current_user;
get_currentuserinfo();
$user_login = $current_user->user_login;

/*-------- Hide screen option from none admin --------------*/
if ( current_user_can( 'limited_editor' ) ) {
	function remove_screen_options_tab() {
		return current_user_can( 'manage_options' );
	}
	add_filter( 'screen_options_show_screen', 'remove_screen_options_tab' );
}
/*------------- Set defaults screen option for limited editors -----------*/
if ( current_user_can( 'limited_editor' ) ) {
	// add_action('user_register', 'set_user_metaboxes');
	add_action( 'admin_init', 'set_user_metaboxes' );

	function set_user_metaboxes( $user_id = NULL ) {
		// These are the metakeys we will need to update
		$meta_key[ 'order' ] = 'meta-box-order_post';
		$meta_key[ 'hidden' ] = 'metaboxhidden_post';
		// So this can be used without hooking into user_register
		if ( !$user_id )
			$user_id = get_current_user_id();
		// Set the default order if it has not been set yet
		if ( !get_user_meta( $user_id, $meta_key[ 'order' ], true ) ) {
			//if ( current_user_can( 'limited_editor' ) ) {
			$meta_value = array(
				'side' => 'submitdiv,formatdiv,postimagediv',
				'normal' => 'postexcerpt,tagsdiv-post_tag,postcustom,commentstatusdiv,commentsdiv,trackbacksdiv,slugdiv,authordiv,revisionsdiv',
				'advanced' => '',
			);
			update_user_meta( $user_id, $meta_key[ 'order' ], $meta_value );
		}
		// Set the default hiddens if it has not been set yet
		if ( !get_user_meta( $user_id, $meta_key[ 'hidden' ], true ) ) {
			$meta_value = array( 'categorydiv', 'postcustom', 'trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'slugdiv', 'authordiv', 'revisionsdiv' );
			update_user_meta( $user_id, $meta_key[ 'hidden' ], $meta_value );
		}
	}
}
/*
 * Adding Author ID column
 */
function rd_user_id_column( $columns ) {
	$columns[ 'user_id' ] = 'ID';
	return $columns;
}
add_filter( 'manage_users_columns', 'rd_user_id_column' );

/*
 * Column content
 */
function rd_user_id_column_content( $value, $column_name, $user_id ) {
	if ( 'user_id' == $column_name )
		return $user_id;
	return $value;
}
add_action( 'manage_users_custom_column', 'rd_user_id_column_content', 10, 3 );
/*
 * Column style (you can skip this if you want)
 */
function rd_user_id_column_style() {
	echo '<style>.column-user_id{width: 5%}</style>';
}
add_action( 'admin_head-users.php', 'rd_user_id_column_style' );


add_filter( 'got_rewrite', '__return_true', 999 );
/* youtube - media */
function youtube_view( $id, $video_id, $ifram_id, $width, $height ) {
	$id = get_the_id();
	$youtube = $video_id;
	if ( $youtube ):
		/*$youtube_frame = str_replace('watch?v=',"embed/",$youtube);*/
		$youtube_frame = "http://www.youtube.com/embed/" . $video_id;
	$video_is = "
<center><iframe id=" . $ifram_id . " width=" . $width . " height=" . $height . " src=" . $youtube_frame . " frameborder=\"0\" allowfullscreen></iframe></center>";
	return $video_is;
	endif;
}

///// add video after content ////////
/*function add_post_content($content,$id) {*/
function add_video_content( $id ) {
	if ( is_single() ) {
		$video_id = get_post_meta( get_the_id(), 'meta_box_video_embed', true );
		/* if ( $is_mobile && !$is_tablet ) {
$content .= youtube_view(get_the_id(),$video_id,'media_show_page',280,220);
			 } else {*/
		$content .= youtube_view( get_the_id(), $video_id, 'media_show_page', 580, 360 );
		/* } */
	}
	return $content;
}


// REMOVING extra br when past HTML in Editor
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );
// Preserve <p> tag and do not insert <br> when transforming HTML for display
function wpautop2( $pee ) {
	return wpautop( $pee, false );
}
add_filter( 'the_content', 'wpautop2' );
add_filter( 'the_excerpt', 'wpautop2' );
/*---------------------------------------------*/
$new_general_setting = new new_general_setting();

class new_general_setting {
	function new_general_setting() {
		add_filter( 'admin_init', array( & $this, 'register_fields' ) );
		add_filter( 'admin_init', array( & $this, 'register_fields2' ) );
		add_filter( 'admin_init', array( & $this, 'register_fields3' ) );
	}

	function register_fields() {
		register_setting( 'general', 'footer_disc', 'esc_attr' );
		add_settings_field( 'footer_disc', '<label for="footer_disc">' . __( 'نص الفووتر', 'footer_disc' ) . '</label>', array( & $this, 'fields_html' ), 'general' );
	}

	function fields_html() {
		$value = get_option( 'footer_disc', '' );
		echo '<textarea id="footer_disc" name="footer_disc" cols="100" rows="5"  >' . $value . '</textarea>';
	}

	function register_fields2() {
		register_setting( 'general', 'google_analytics', 'esc_attr' );
		add_settings_field( 'google_analytics', '<label for="google_analytics">' . __( 'جوول أنالاتيكس', 'google_analytics' ) . '</label>', array( & $this, 'fields_html2' ), 'general' );
	}

	function fields_html2() {
		$value = get_option( 'google_analytics', '' );
		echo '<textarea id="google_analytics" name="google_analytics" cols="100" rows="5"  >' . $value . '</textarea>';
	}


	function register_fields3() {
		register_setting( 'general', 'we_are_working', 'esc_attr' );
		add_settings_field( 'we_are_working', '<label for="google_analytics">' . __( 'وضع الصيانة', 'we_are_working' ) . '</label>', array( & $this, 'fields_html3' ), 'general' );
	}

	function fields_html3() {
		$value = get_option( 'we_are_working', '' );
		if ( $value == 'on' ) {
			$value = 'checked';
		}
		echo '<input type="checkbox" id="we_are_working" name="we_are_working" ' . $value . '  >';
	}
}

function the_breadcrumb() {
	?>
	<ul id="breadcrumb" class="col-lg-12 no-padding">
		<?
	if (!is_home()) {
		echo '<li><a href="';
		echo get_option('home');
		echo '"><i class="fa fa-home"></i> ';
		echo 'رئيسية الموقع';
		echo " <i class='fas fa-angle-left'></i></a></li>";
				 if (is_category() || is_single()) {
			$categories = get_the_category( get_the_ID() );
if( $categories ){
    $output = "";
    foreach ($categories as $category) {
        if( !$category->parent ){
            $output .= '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" >' . $category->name.' /</a></li>';
        }
    }
    foreach ($categories as $category) {
        if( $category->parent ){
            $output .= '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" >' . $category->name.' /</a></li>';
        }
    }
    echo trim( $output, "," );
}
			 echo "<li><p>";
				 the_title();
				echo '</p></li>';
		} elseif (is_page()) {
			echo '<li>';
			echo "<p>".get_the_title()."</p>";
			echo '</li>';
		} elseif (is_archive()) {
			echo '<li>';
			echo "<p>".post_type_archive_title()."</p>";
			echo '</li>';
		}elseif(is_search()) {
			echo '<li>';
			echo "<p>نتائج البحث عن : (  ".$_GET[s]." )</p>";
			echo '</li>';
		} ?>
	</ul>
	<?
} elseif ( is_tag() ) {
	single_tag_title();
}
elseif ( is_day() ) {
	echo "<li>Archive for ";
	the_time( 'F jS, Y' );
	echo '</li>';
}
elseif ( is_month() ) {
	echo "<li>Archive for ";
	the_time( 'F, Y' );
	echo '</li>';
}
elseif ( is_year() ) {
	echo "<li>Archive for ";
	the_time( 'Y' );
	echo '</li>';
}
elseif ( is_author() ) {
	echo "<li>Author Archive";
	echo '</li>';
}
elseif ( isset( $_GET[ 'paged' ] ) && !empty( $_GET[ 'paged' ] ) ) {
	echo "<li>Blog Archives";
	echo '</li>';
}
elseif ( is_search() ) {
	echo "<li>Search Results";
	echo '</li>';
}
}


/* mailing */
function mail_header() {
	$logo = get_template_directory_uri() . "/fw/images/logo.png";
	$header = "<div style='direction:rtl; height:auto;'><div style='padding:10px 0px; height:auto; border-bottom:2px solid #ccc; display:block; width:100%; overflow:hidden; margin-bottom:10px'> <a href='" . get_site_url() . "' ><img src='" . $logo . "' width='150' height='100'  title='' alt='' style='margin-right:10%' ></a></div><div  style='padding:5px; direction:rtl;  display:block; width:75%; height:auto;'>";
	return $header;
}

function mail_footer() {
	$footer = "</div><div style='direction:ltr; height:auto; color:#fff; padding:10px 0px; font-size:11px; background:blue; display:block; width:100%; text-align:center; overflow:hidden; margin-top:15px'>©  COPYRIGHTS 2018.</div></div>";
	return $footer;
}
/* encrypt methods */
/* SOURCE : http://stackoverflow.com/questions/15194663/encrypt-and-decrypt-md5*/
function encryptIt( $q ) {
	$code = str_replace( "@", "!!!", $q );
	$code = str_replace( ".", "=", $code );
	$code = str_rot13( $code );
	return ( $code );
}

function decryptIt( $q ) {
	$code = str_replace( "!!!", "@", $q );
	$code = str_replace( "=", ".", $code );
	$code = str_rot13( $code );
	return ( $code );
}
///////////// Special thumb sizes ////////////////////
/*---- Vertical ---------*/
add_image_size( "virtical", 290, 440, true );
add_image_size( "horizintal", 290, 180, true );
// REMOVING SITE URL FROM COMMENT
add_filter( 'comment_form_default_fields', 'url_filtered' );

function url_filtered( $fields ) {
	if ( isset( $fields[ 'url' ] ) )
		unset( $fields[ 'url' ] );
	return $fields;
}
////////// allow CPT in ARCHIVE page
function namespace_add_custom_types( $query ) {
	// if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
	if ( is_category() || is_tag() ) {
		$query->set( 'post_type', array( 'post', 'forums', 'author' ) );
		return $query;
	}
}
//add_filter( 'pre_get_posts', 'namespace_add_custom_types' );
/*----------------- limit search only posts ------------*/
function searchfilter( $query ) {
	// if ($query->is_search) {
	if ( $query->is_search || $query->is_category() ) {
		//$query->set('post_type',array('post','page'));
		$query->set( 'post_type', array( 'post', 'forums' ) );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'searchfilter' );
/*------------- Arrang serach result ---------------*/
/*Display posts with 'Product' type ordered by 'Price' custom field:
$query = new WP_Query( array ( 'post_type' => 'product', 'orderby' => 'meta_value', 'meta_key' => 'price' ) );*/
add_filter( 'posts_orderby', 'my_sort_custom', 10, 2 );

function my_sort_custom( $orderby, $query ) {
	global $wpdb;
	if ( !is_admin() && is_search() )
		$orderby = $wpdb->prefix . "posts.post_date DESC";
	return $orderby;
}
///////////////////////////////////////
////////// Images to facebook share ///
///////////////////////////////////////
function insert_image_src_rel_in_head() {
	global $post;
	if ( !is_singular() ) //if it is not a post or a page
		return;
	if ( !has_post_thumbnail( $post->ID ) ) { //the post does not have featured image, use a default image
		//$default_image="http://example.com/image.jpg"; //replace this with a default image on your server or an image in your media library
		$id = $post->ID;
		$youtube = get_post_meta( $id, 'v_link', true );
		if ( $youtube ) {
			$youtube_id1 = str_replace( 'https', "", $youtube );
			$youtube_id2 = str_replace( 'http', "", $youtube_id1 );
			$youtube_id = str_replace( '://www.youtube.com/watch?v=', "", $youtube_id2 );
			$default_image = "http://img.youtube.com/vi/" . $youtube_id . "/0.jpg";
			echo '<meta property="og:image" content="' . $default_image . '"/>';
		}
	} else {
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		$desc_is = get_the_content( $post->ID );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[ 0 ] ) . '"/>';
	}
	echo "";
}
add_action( 'wp_head', 'insert_image_src_rel_in_head', 2 );
/////////////////////////////////////// pagination
function kriesi_pagination( $pages = '', $range = 2 ) {
	$showitems = ( $range * 2 ) + 1;
	global $paged;
	if ( empty( $paged ) )$paged = 1;
	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( !$pages ) {
			$pages = 1;
		}
	}
	if ( 1 != $pages ) {


		echo "<div class='pagination'>";
		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages )echo "<a href='" . get_pagenum_link( 1 ) . "'>&laquo;</a>";
		if ( $paged > 1 && $showitems < $pages )echo "<a href='" . get_pagenum_link( $paged - 1 ) . "'>&lsaquo;</a>";
		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo( $paged == $i ) ? "<span class='current'>" . $i . "</span>": "<a href='" . get_pagenum_link( $i ) . "' class='inactive' >" . $i . "</a>";
			}
		}
		if ( $paged < $pages && $showitems < $pages )echo "<a href='" . get_pagenum_link( $paged + 1 ) . "'>&rsaquo;</a>";
		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages )echo "<a href='" . get_pagenum_link( $pages ) . "'>&raquo;</a>";
		echo "</div>\n";
	}
}
// THUMBNAILS TO ADMIN POST VIEW
// functions
function posts_columns( $defaults ) {
	$defaults[ 'add_post_thumbs' ] = __( 'الصورة البارزة' );
	return $defaults;
}

function posts_custom_columns( $column_name, $id ) {
	if ( $column_name === 'add_post_thumbs' ) {
		echo the_post_thumbnail( 'thumbnail' );
	}
}
///// filtrers
add_filter( 'manage_posts_columns', 'posts_columns', 5 );
add_action( 'manage_posts_custom_column', 'posts_custom_columns', 5, 2 );
// ID TO ADMIN POST VIEW
// functions
function posts_columns_ID( $defaults ) {
	$defaults[ 'add_post_ID' ] = __( 'رقم المقال' );
	return $defaults;
}

function posts_custom_columns_ID( $column_name, $id ) {
	if ( $column_name === 'add_post_ID' ) {
		echo "<p style='font-size:20px; font-weight:bold; text-align:center'>" . get_the_id() . "</p>";
	}
}
///// filtrers
add_filter( 'manage_posts_columns', 'posts_columns_ID', 5 );
add_action( 'manage_posts_custom_column', 'posts_custom_columns_ID', 5, 2 );
//////////////// Change sendere name EMAIL //////////////
// SOURCE :: http://wpmu.org/wordpress-email-settings/
/* enter the full name you want displayed alongside the email address */
function wp_mail_from_name( $from_name ) {
	$site_name = get_bloginfo( 'name' );
	return $site_name;
}
add_filter( "wp_mail_from_name", "wp_mail_from_name" );
/* auto-detect the server so you only have to enter the front/from half of the email address, including the @ sign */
function wp_mail_from( $email ) {
	/* start of code lifted from wordpress core, at http://svn.automattic.com/wordpress/tags/3.4/wp-includes/pluggable.php */
	$sitename = strtolower( $_SERVER[ 'SERVER_NAME' ] );
	if ( substr( $sitename, 0, 4 ) == 'www.' ) {
		$sitename = substr( $sitename, 4 );
	}
	/* end of code lifted from wordpress core */
	$myfront = "info@";
	$myback = $sitename;
	$myfrom = $myfront . $myback;
	return $myfrom;
}
//add_filter( "wp_mail_from", "wp_mail_from" );
// APLLY HTML //////////////////////////////////////
add_filter( 'wp_mail_content_type', 'set_html_content_type' );
/*****wp_mail( $multiple_to_recipients, $subject,  $message );**********/
// Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

function set_html_content_type() {
	return 'text/html';
}
/* POST TRASHED EMAIL NOTIFICATION */
function authorNotification2( $post_id ) {
	global $wpdb;
	$post = get_post( $post_id );
	$author = get_userdata( $post->post_author );
	$message = "";
	wp_mail( $author->user_email, "", $message );
}
add_action( 'trash_post', 'authorNotification2' );
///////////////////////////////// ADD ONS ////////////////////////////////////
function resize( $jpg ) {
	$im = @imagecreatefromjpeg( $jpg );
	$filename = $jpg;
	$percent = 0.5;
	list( $width, $height ) = getimagesize( $filename );
	if ( $uploader_name == "c_master_imgs" ):
		$new_width = $width;
	$new_height = $height;
	else :
		if ( $width > 699 ): $new_width = 699;
	$percent = 699 / $width;
	$new_height = $height * $percent;
	else :
		$new_width = $width;
	$new_height = $height;
	endif;
	endif; // end if measter images do not resize
	//if ( $new_height>600){ $new_height = 600; }
	$im = imagecreatetruecolor( $new_width, $new_height );
	$image = imagecreatefromjpeg( $filename );
	imagecopyresampled( $im, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
	@imagejpeg( $im, $jpg, 80 );
	@imagedestroy( $im );
}
// SOURCE :: http://botcrawl.com/how-to-login-to-wordpress-with-an-email-address/
function login_by_email( $username ) {
	$user = get_user_by_email( $username );
	if ( $user->user_login ):
		$username = $user->user_login;
	return $username;
	endif;
}
add_action( 'wp_authenticate', 'login_by_email' );


	/*---------TWEAKS 2 -------------*/
	function include_post_types_in_search( $query ) {
		if ( $query->is_search() || $query->is_category() ) {
			$post_types = get_post_types( array( 'public' => true, 'exclude_from_search' => false ), 'objects' );
			$searchable_types = array();
			if ( $post_types ) {
				foreach ( $post_types as $type ) {
					$type = $type->name;
					if ( ( $type == "testomenials" ) || ( $type == "our_team" ) || ( $type == "success" ) ||
						( $type == "qouta" ) || ( $type == "social" ) || ( $type == "media" ) || ( $type == "contacts" ) || ( $type == "ads" ) ) {} else {
						//echo  $type."<br>";
						$searchable_types[] = $type;
					}
				}
			}
			$query->set( 'post_type', $searchable_types );
		}
		return $query;

	}
	add_action( 'pre_get_posts', 'include_post_types_in_search' );
	/*------------- Hide And Protect ME ---------*/
	// remove junk from head
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
	class My_Walker_Nav_Menu extends Walker_Nav_Menu {
		function start_lvl( & $output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
		}
	}


/*-------------------------------------------------------------*/
/*-------------------------------------------------------------*/

function zfw_page_menu_args( $args ) {
	$args[ 'show_home' ] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'zfw_page_menu_args' );

function zfw_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'zfw_excerpt_length' );

function zfw_continue_reading_link() {
	return ' <a href="' . get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'zfw' ) . '</a>';
}

function zfw_auto_excerpt_more( $more ) {
	return ' &hellip;' . zfw_continue_reading_link();
}

add_filter( 'excerpt_more', 'zfw_auto_excerpt_more' );

function zfw_custom_excerpt_more( $output ) {
	if ( has_excerpt() && !is_attachment() ) {}
	return $output;
}

add_filter( 'get_the_excerpt', 'zfw_custom_excerpt_more' );

add_filter( 'use_default_gallery_style', '__return_false' );


// disable admin bar
// SOURCE : http://botcrawl.com/how-to-disable-the-wordpress-admin-bar/
add_filter( 'show_admin_bar', '__return_false' );

/// make the excerpt ... more
function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">قراءة المزيد</a>';
}

add_filter( 'excerpt_more', 'new_excerpt_more' );

/*------------------ nav without ul -------------------*/
function wp_nav_menu_no_ul()
{
    $options = array(
        'echo' => false,
        'container' => false,
        'theme_location' => 'primary',
        'fallback_cb'=> 'default_page_menu'
    );

    $menu = wp_nav_menu($options);
    echo preg_replace(array(
        '#^<ul[^>]*>#',
        '#</ul>$#'
    ), '', $menu);

}

class Walker_topmenu_Menu extends Walker {

    // Tell Walker where to inherit it's parent and id values
    var $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id'
    );


    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$class_names = $value = '';
					$classes = empty( $item->classes ) ? array() : (array) $item->classes;
					$classes[] = 'menu-item-' . $item->ID;
					$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
					//$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
					$class_names =  $class_names ;

        $output .= sprintf( "\n<div class='col-lg-4 text-center hvr-float-shadow' id='div_6b1f_21'>
				<a href='%s'%s><div id='div_6b1f_22'><span class='$class_names' id='span_6b1f_13'></span><p id='p_6b1f_4'>%s</p>
				</div></a></div>\n",
            $item->url,
            ( $item->object_id === get_the_ID() ) ? ' class="current"' : '',
            $item->title
        );
    }

}

function wp_nav_menu_no_ul_top_menu()
{
    $options = array(
			'menu'=>'top_menu',
        'echo' => false,
        'container' => false,
        'theme_location' => 'primary',
        'fallback_cb'=> 'default_page_menu',
				'walker'  => new Walker_topmenu_Menu() //use our custom walker

    );

    $menu = wp_nav_menu($options);
    echo preg_replace(array(
        '#^<ul[^>]*>#',
        '#</ul>$#'
    ), '', $menu);

}








function default_page_menu() {
   wp_list_pages('title_li=');
}





class Walker_topmenu_Menu_HOLDING extends Walker {

    // Tell Walker where to inherit it's parent and id values
    var $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id'
    );


    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$class_names = $value = '';
					$classes = empty( $item->classes ) ? array() : (array) $item->classes;
					$classes[] = 'menu-item-' . $item->ID;
					$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
					//$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
					$class_names =  $class_names ;

        $output .= sprintf( "\n<div class='col-xs-3' id='div_aa50_22'><a href='%s'%s><div id='div_aa50_23' class='text-center'>%s</div></a></div>\n",
            $item->url,
            ( $item->object_id === get_the_ID() ) ? ' class="current"' : '',
            $item->title
        );
    }

}

function wp_nav_menu_no_ul_top_menu_HOLDING()
{
    $options = array(
			'menu'=>'main',
        'echo' => false,
        'container' => false,
        'theme_location' => 'primary',
        'fallback_cb'=> 'default_page_menu',
				'walker'  => new Walker_topmenu_Menu_HOLDING() //use our custom walker

    );
		$menu = wp_nav_menu($options);
		echo preg_replace(array(
				'#^<ul[^>]*>#',
				'#</ul>$#'
		), '', $menu);

}


		class Walker_topmenu_Menu_GROUP extends Walker {

		    // Tell Walker where to inherit it's parent and id values
		    var $db_fields = array(
		        'parent' => 'menu_item_parent',
		        'id'     => 'db_id'
		    );


		    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

					$class_names = $value = '';
							$classes = empty( $item->classes ) ? array() : (array) $item->classes;
							$classes[] = 'menu-item-' . $item->ID;
							$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
							//$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
							$class_names =  $class_names ;

		        $output .= sprintf( "\n<li id='li_9ff7_5'><a href='%s'%s><div class='col-xs-3 text-center' id='div_9ff7_18'><div id='div_9ff7_19'><i class='$class_names' id='i_9ff7_6'></i></div></div><div class='col-xs-9' id='div_9ff7_20'><h4>%s</h4></div></a></li>\n",
		            $item->url,
		            ( $item->object_id === get_the_ID() ) ? ' class="current"' : '',
		            $item->title
		        );
		    }

		}

		function wp_nav_menu_no_ul_GROUP()
		{
		    $options = array(
					'menu'=>'main',
		        'echo' => false,
		        'container' => false,
		        'theme_location' => 'primary',
		        'fallback_cb'=> 'default_page_menu',
						'walker'  => new Walker_topmenu_Menu_GROUP() //use our custom walker

		    );

    $menu = wp_nav_menu($options);
    echo preg_replace(array(
        '#^<ul[^>]*>#',
        '#</ul>$#'
    ), '', $menu);

}

/*----------------------------------------------*/


/*------------------- add Meta ( video ) box to posts ------------------*/
/* SOURCE : http://stackoverflow.com/questions/6890617/how-to-add-a-meta-box-to-wordpress-pages */
add_action( 'add_meta_boxes', 'meta_box_video' );

function meta_box_video() { // --- Parameters: ---
	add_meta_box( 'video-meta-box-id', // ID attribute of metabox
		'فيديو', // Title of metabox visible to user
		'meta_box_callback', // Function that prints box in wp-admin
		'news', // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order

}

function meta_box_callback( $post ) {
	$values = get_post_custom( $post->ID );
	$selected = isset( $values[ 'meta_box_video_embed' ] ) ? $values[ 'meta_box_video_embed' ][ 0 ] : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>
	<p>
		<label for="meta_box_video_embed">
			<p>رابط الفيديو ( يوتيوب )</p>
		</label>
		<input type="text" name="meta_box_video_embed" id="meta_box_video_embed" rows="1" cols="40" style="width:98%" value="<?php echo $selected; ?>">
	</p>
	<!--<p>Leave it Empty ( if you want to use an image thumbnail ) .</p>-->
	<?php
}
add_action( 'save_post', 'meta_box_video_save' );

function meta_box_video_save( $post_id ) {
	// Bail if we're doing an auto save
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	// if our nonce isn't there, or we can't verify it, bail
	if ( !isset( $_POST[ 'meta_box_nonce' ] ) || !wp_verify_nonce( $_POST[ 'meta_box_nonce' ], 'my_meta_box_nonce' ) ) return;
	// if our current user can't edit this post, bail
	if ( !current_user_can( 'edit_post' ) ) return;
	// now we can actually save the data
	$allowed = array(
		'a' => array( // on allow a tags
			'href' => array() // and those anchords can only have href attribute
		)
	);
	if ( isset( $_POST[ 'meta_box_video_embed' ] ) )
		update_post_meta( $post_id, 'meta_box_video_embed', $_POST[ 'meta_box_video_embed' ] );
}

/*------------------------ Contact address ---------------------*/
add_action( 'add_meta_boxes', 'register_field_address' );
function register_field_address(){// --- Parameters: ---
	add_meta_box( "contact_address", // ID attribute of metabox
		"العنوان", // Title of metabox visible to user
		'meta_box_callback_address', // Function that prints box in wp-admin
		"contact", // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order
}
function meta_box_callback_address() {
	$values = get_post_custom( $post->ID );
	$selected = isset( $values[ "_address" ] ) ? $values[ "_address"  ][ 0 ] : '';
	wp_nonce_field( 'address_nonce', 'my_address' );
	?>
	<p>
	<label for="_address">
			<p>العنوان</p>
		</label>
		<input type="text" name="_address" id="_address" rows="1" cols="40" style="width:98%" value="<?php echo $selected; ?>">
	</p>
	<?php }
add_action( 'save_post', 'register_field_address_save' );
function register_field_address_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !isset( $_POST[ 'my_address' ] ) || !wp_verify_nonce( $_POST[ 'my_address' ], 'address_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ '_address' ] ) )update_post_meta( $post_id, '_address', $_POST[ '_address' ] );}
/*------------------------ Contact phone ---------------------*/
add_action( 'add_meta_boxes', 'register_field_phone' );
function register_field_phone(){// --- Parameters: ---
	add_meta_box( "contact_phone", // ID attribute of metabox
		"الهاتف", // Title of metabox visible to user
		'meta_box_callback_phone', // Function that prints box in wp-admin
		"contact", // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order
}
function meta_box_callback_phone() {
	$values = get_post_custom( $post->ID );
	$selected = isset( $values[ "_phone" ] ) ? $values[ "_phone"  ][ 0 ] : '';
	wp_nonce_field( 'phone_nonce', 'my_phone' );
	?>
	<p>
	<label for="_phone">
			<p>الهاتف</p>
		</label>
		<input type="text" name="_phone" id="_phone" rows="1" cols="40" style="width:98%" value="<?php echo $selected; ?>">
	</p>
	<?php }
add_action( 'save_post', 'register_field_phone_save' );
function register_field_phone_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !isset( $_POST[ 'my_phone' ] ) || !wp_verify_nonce( $_POST[ 'my_phone' ], 'phone_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ '_phone' ] ) )update_post_meta( $post_id, '_phone', $_POST[ '_phone' ] );}
/*------------------------ Contact mobile ---------------------*/
add_action( 'add_meta_boxes', 'register_field_mobile' );
function register_field_mobile(){// --- Parameters: ---
	add_meta_box( "contact_mobile", // ID attribute of metabox
		"الجوال", // Title of metabox visible to user
		'meta_box_callback_mobile', // Function that prints box in wp-admin
		"contact", // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order
}
function meta_box_callback_mobile() {
	$values = get_post_custom( $post->ID );
	$selected = isset( $values[ "_mobile" ] ) ? $values[ "_mobile"  ][ 0 ] : '';
	wp_nonce_field( 'mobile_nonce', 'my_mobile' );
	?>
	<p>
	<label for="_mobile">
			<p>الجوال</p>
		</label>
		<input type="text" name="_mobile" id="_mobile" rows="1" cols="40" style="width:98%" value="<?php echo $selected; ?>">
	</p>
	<?php }
add_action( 'save_post', 'register_field_mobile_save' );
function register_field_mobile_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !isset( $_POST[ 'my_mobile' ] ) || !wp_verify_nonce( $_POST[ 'my_mobile' ], 'mobile_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ '_mobile' ] ) )update_post_meta( $post_id, '_mobile', $_POST[ '_mobile' ] );}
/*------------------------ Contact Email ---------------------*/
add_action( 'add_meta_boxes', 'register_field_Email' );
function register_field_Email(){// --- Parameters: ---
	add_meta_box( "contact_Email", // ID attribute of metabox
		"البريد الإلكتروني", // Title of metabox visible to user
		'meta_box_callback_Email', // Function that prints box in wp-admin
		"contact", // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order
}
function meta_box_callback_Email() {
	$values = get_post_custom( $post->ID );
	$selected = isset( $values[ "_Email" ] ) ? $values[ "_Email"  ][ 0 ] : '';
	wp_nonce_field( 'Email_nonce', 'my_Email' );
	?>
	<p>
	<label for="_Email">
			<p>البريد الإلكتروني</p>
		</label>
		<input type="text" name="_Email" id="_Email" rows="1" cols="40" style="width:98%" value="<?php echo $selected; ?>">
	</p>
	<?php }
add_action( 'save_post', 'register_field_Email_save' );
function register_field_Email_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !isset( $_POST[ 'my_Email' ] ) || !wp_verify_nonce( $_POST[ 'my_Email' ], 'Email_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ '_Email' ] ) )update_post_meta( $post_id, '_Email', $_POST[ '_Email' ] );}
/*------------------------ Contact Google_map ---------------------*/
add_action( 'add_meta_boxes', 'register_field_Google_map' );
function register_field_Google_map(){// --- Parameters: ---
	add_meta_box( "contact_Google_map", // ID attribute of metabox
		"الموقع على خرائط جووجل", // Title of metabox visible to user
		'meta_box_callback_Google_map', // Function that prints box in wp-admin
		"contact", // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order
}
function meta_box_callback_Google_map() {
	$values = get_post_custom( $post->ID );
	$selected = isset( $values[ "_Google_map" ] ) ? $values[ "_Google_map"  ][ 0 ] : '';
	wp_nonce_field( 'Google_map_nonce', 'my_Google_map' );
	?>
	<p>
	<label for="_Google_map">
			<p>الموقع على خرائط جووجل</p>
		</label>
		<input type="text" name="_Google_map" id="_Google_map" rows="1" cols="40" style="width:98%" value="<?php echo $selected; ?>">
	</p>
	<?php }
add_action( 'save_post', 'register_field_Google_map_save' );
function register_field_Google_map_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !isset( $_POST[ 'my_Google_map' ] ) || !wp_verify_nonce( $_POST[ 'my_Google_map' ], 'Google_map_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ '_Google_map' ] ) )update_post_meta( $post_id, '_Google_map', $_POST[ '_Google_map' ] );}
/*------------------------ Contact facebook ---------------------*/
add_action( 'add_meta_boxes', 'register_field_facebook' );
function register_field_facebook(){// --- Parameters: ---
	add_meta_box( "social_facebook", // ID attribute of metabox
		"مواقع التواصل", // Title of metabox visible to user
		'meta_box_callback_facebook', // Function that prints box in wp-admin
		"social", // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order

}
function meta_box_callback_facebook() {
	$values = get_post_custom( $post->ID );
	$selected = isset( $values[ "_facebook" ] ) ? $values[ "_facebook"  ][ 0 ] : '';
	wp_nonce_field( 'facebook_nonce', 'my_facebook' );
	?>
	<p>
	<label for="_facebook">
			<p>فيسبوك</p>
		</label>
		<input type="text" name="_facebook" id="_facebook" rows="1" cols="40" style="width:98%" value="<?php echo $selected; ?>">
	</p>
	<?php
	$values2 = get_post_custom( $post->ID );
	$selected2 = isset( $values2[ "_twitter" ] ) ? $values2[ "_twitter"  ][ 0 ] : '';
	wp_nonce_field( 'twitter_nonce', 'my_twitter' );
	?>
	<p>
	<label for="_twitter">
			<p>تويتر</p>
		</label>
		<input type="text" name="_twitter" id="_twitter" rows="1" cols="40" style="width:98%" value="<?php echo $selected2; ?>">
	</p>
	<?php
	$values3 = get_post_custom( $post->ID );
	$selected3 = isset( $values3[ "_youtube" ] ) ? $values3[ "_youtube"  ][ 0 ] : '';
	wp_nonce_field( 'youtube_nonce', 'my_youtube' );
	?>
	<p>
	<label for="_youtube">
			<p>يوتويب</p>
		</label>
		<input type="text" name="_youtube" id="_youtube" rows="1" cols="40" style="width:98%" value="<?php echo $selected3; ?>">
	</p>
	<?php
	$values4 = get_post_custom( $post->ID );
	$selected4 = isset( $values4[ "_linkedin" ] ) ? $values4[ "_linkedin"  ][ 0 ] : '';
	wp_nonce_field( 'linkedin_nonce', 'my_linkedin' );
	?>
	<p>
	<label for="_linkedin">
			<p>لينكد ان LinkedIn</p>
		</label>
		<input type="text" name="_linkedin" id="_linkedin" rows="1" cols="40" style="width:98%" value="<?php echo $selected4; ?>">
	</p>
	<?php

	$values5 = get_post_custom( $post->ID );
	$selected5 = isset( $values4[ "_email" ] ) ? $values4[ "_email"  ][ 0 ] : '';
	wp_nonce_field( 'email_nonce', 'my_email' );
	?>
	<p>
	<label for="_email">
			<p>البريد الإلكتروني</p>
		</label>
		<input type="text" name="_email" id="_email" rows="1" cols="40" style="width:98%" value="<?php echo $selected5; ?>">
	</p>
	<?php





}
add_action( 'save_post', 'register_field_facebook_save' );
function register_field_facebook_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !isset( $_POST[ 'my_facebook' ] ) || !wp_verify_nonce( $_POST[ 'my_facebook' ], 'facebook_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ '_facebook' ] ) )update_post_meta( $post_id, '_facebook', $_POST[ '_facebook' ] );

	if ( !isset( $_POST[ 'my_twitter' ] ) || !wp_verify_nonce( $_POST[ 'my_twitter' ], 'twitter_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ '_twitter' ] ) )update_post_meta( $post_id, '_twitter', $_POST[ '_twitter' ] );

	if ( !isset( $_POST[ 'my_youtube' ] ) || !wp_verify_nonce( $_POST[ 'my_youtube' ], 'youtube_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ '_youtube' ] ) )update_post_meta( $post_id, '_youtube', $_POST[ '_youtube' ] );

	if ( !isset( $_POST[ 'my_linkedin' ] ) || !wp_verify_nonce( $_POST[ 'my_linkedin' ], 'linkedin_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ '_linkedin' ] ) )update_post_meta( $post_id, '_linkedin', $_POST[ '_linkedin' ] );


	if ( !isset( $_POST[ 'my_email' ] ) || !wp_verify_nonce( $_POST[ 'my_email' ], 'email_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ '_email' ] ) )update_post_meta( $post_id, '_email', $_POST[ '_email' ] );

}

/*-------------------------------- Home Ads fields ----------------------------*/

add_action( 'add_meta_boxes', 'register_field_home_ads' );
function register_field_home_ads(){// --- Parameters: ---
	add_meta_box( "social_facebook", // ID attribute of metabox
		"مكان الإعلان", // Title of metabox visible to user
		'meta_box_callback_home_ads', // Function that prints box in wp-admin
		"home_ads", // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order

}
function meta_box_callback_home_ads() {
	$values = get_post_custom( $post->ID );
	$selected = isset( $values[ "ad_place" ] ) ? $values[ "ad_place"  ][ 0 ] : '';
	wp_nonce_field( 'ad_nonce', 'my_ad' );
	?>
	<p>
	<label for="ad_place">
			<p>مكان الإعلان</p>
		</label>
		<select name="ad_place" style="width:98%">
			<option value="<?php echo $selected; ?>"><?php echo $selected; ?></option>
			<option value="top_place">أعلى الصفحة</option>
			<option value="middle_place">وسط الصفحة</option>
			<option value="sidebar">جانب الصفحة</option>
			<option value="bottom_place">أسفل الصفحة</option>
			<option value="footer_place"> الفووتر</option>
		</select>
	</p>

	<?php

}
add_action( 'save_post', 'register_field_home_ads_save' );
function register_field_home_ads_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !isset( $_POST[ 'my_ad' ] ) || !wp_verify_nonce( $_POST[ 'my_ad' ], 'ad_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ 'ad_place' ] ) )update_post_meta( $post_id, 'ad_place', $_POST[ 'ad_place' ] );

}


/*-------------------------------- Media Types fields ----------------------------*/

add_action( 'add_meta_boxes', 'register_field_media_types' );
function register_field_media_types(){// --- Parameters: ---
	add_meta_box( "media_types", // ID attribute of metabox
		"نوع المرئيات", // Title of metabox visible to user
		'meta_box_callback_media_types', // Function that prints box in wp-admin
		"media", // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order

}
function meta_box_callback_media_types() {
	$values = get_post_custom( $post->ID );
	$selected = isset( $values[ "media_type" ] ) ? $values[ "media_type"  ][ 0 ] : '';
	$selected2 = isset( $values[ "video_link" ] ) ? $values[ "video_link"  ][ 0 ] : '';
	wp_nonce_field( 'media_nonce', 'my_media' );
	?>
	<p>
	<label for="media_type">
			<p>اختر النوع</p>
		</label>
		<select name="media_type" style="width:98%">
			<option value="<?php echo $selected; ?>"><?php echo $selected; ?></option>
			<option value="photo">صور</option>
			<option value="video">فيديو</option>
		</select>
	</p>

    	<p>
	<label for="video_link">
			<p>رابط الفيديو</p>
		</label>
		<input type="text" name="video_link" value="<?php echo $selected2; ?>" placeholder="" style="width:98%" />

		</select>
	</p>

	<?php

}
add_action( 'save_post', 'register_field_media_types_save' );
function register_field_media_types_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !isset( $_POST[ 'my_media' ] ) || !wp_verify_nonce( $_POST[ 'my_media' ], 'media_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ 'media_type' ] ) )update_post_meta( $post_id, 'media_type', $_POST[ 'media_type' ] );
	if ( isset( $_POST[ 'video_link' ] ) )update_post_meta( $post_id, 'video_link', $_POST[ 'video_link' ] );

}

/*-------------------------------- About / Target fields ----------------------------*/

add_action( 'add_meta_boxes', 'register_field_about_target' );
function register_field_about_target(){// --- Parameters: ---
	add_meta_box( "about_target", // ID attribute of metabox
		"النوع ( رؤية / رسالة / هدف )", // Title of metabox visible to user
		'meta_box_callback_about_target', // Function that prints box in wp-admin
		"about", // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order

}
function meta_box_callback_about_target() {
	$values = get_post_custom( $post->ID );
	$selected = isset( $values[ "about_target" ] ) ? $values[ "about_target"  ][ 0 ] : '';
	wp_nonce_field( 'about_target_nonce', 'my_about_target' );
	?>
	<p>
	<label for="about_target">
			<p>النوع</p>
		</label>
		<select name="about_target" style="width:98%">
			<option value="<?php echo $selected; ?>"><?php echo $selected; ?></option>
			<option value="vision">رؤية</option>
			<option value="mission">رسالة</option>
			<option value="target">هدف</option>
		</select>
	</p>

	<?php

}
add_action( 'save_post', 'register_field_about_target_save' );
function register_field_about_target_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !isset( $_POST[ 'my_about_target' ] ) || !wp_verify_nonce( $_POST[ 'my_about_target' ], 'about_target_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ 'about_target' ] ) )update_post_meta( $post_id, 'about_target', $_POST[ 'about_target' ] );

}


/*--------------------------------  home Content fields ----------------------------*/

add_action( 'add_meta_boxes', 'register_field_home_content' );
function register_field_home_content(){// --- Parameters: ---
	add_meta_box( "home_content", // ID attribute of metabox
		"القائمة", // Title of metabox visible to user
		'meta_box_callback_home_content', // Function that prints box in wp-admin
		"home_content", // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order

}
function meta_box_callback_home_content() {
	$values = get_post_custom( $post->ID );
	$selected = isset( $values[ "home_content" ] ) ? $values[ "home_content"  ][ 0 ] : '';
	wp_nonce_field( 'home_content_nonce', 'my_home_content' );
	?>
	<p>
	<label for="home_content">
			<p>القائمة</p>
		</label>

			<textarea name="home_content" style="width:98%"><?php echo $selected; ?></textarea>

	</p>

	<?php

}
add_action( 'save_post', 'register_field_home_content_save' );
function register_field_home_content_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !isset( $_POST[ 'my_home_content' ] ) || !wp_verify_nonce( $_POST[ 'my_home_content' ], 'home_content_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ 'home_content' ] ) )update_post_meta( $post_id, 'home_content', $_POST[ 'home_content' ] );

}

/*--------------------------------  Gym sub fields ----------------------------*/

add_action( 'add_meta_boxes', 'register_field_gym_sub' );
function register_field_gym_sub(){// --- Parameters: ---
	add_meta_box( "gym_sub", // ID attribute of metabox
		"العناصر الاضافية", // Title of metabox visible to user
		'meta_box_callback_gym_sub', // Function that prints box in wp-admin
		"gym_sub", // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order

}
function meta_box_callback_gym_sub() {
	$values = get_post_custom( $post->ID );
	$inbody = isset( $values[ "inbody" ] ) ? $values[ "inbody"  ][ 0 ] : '';
	$descount = isset( $values[ "descount" ] ) ? $values[ "descount"  ][ 0 ] : '';
	$copon = isset( $values[ "copon" ] ) ? $values[ "copon"  ][ 0 ] : '';
	$food = isset( $values[ "food" ] ) ? $values[ "food"  ][ 0 ] : '';
	wp_nonce_field( 'gym_sub_nonce', 'my_gym_sub' );
	//print_r($values);
	?>
	<p>
	<label for="inbody">
			<p>إن بودي</p>
		</label>

			<textarea name="inbody" style="width:98%"><?php echo $inbody; ?></textarea>

            <label for="descount">
			<p>الخصم / التخفيض</p>
		</label>

			<textarea name="descount" style="width:98%"><?php echo $descount; ?></textarea>

            <label for="copon">
			<p>الكوبون</p>
		</label>

			<textarea name="copon" style="width:98%"><?php echo $copon; ?></textarea>

            <label for="food">
			<p>التغذية</p>
		</label>

			<textarea name="food" style="width:98%"><?php echo $food; ?></textarea>

	</p>

	<?php

}
add_action( 'save_post', 'register_field_gym_sub_save' );
function register_field_gym_sub_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !isset( $_POST[ 'my_gym_sub' ] ) || !wp_verify_nonce( $_POST[ 'my_gym_sub' ], 'gym_sub_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ 'inbody' ] ) )update_post_meta( $post_id, 'inbody', $_POST[ 'inbody' ] );
	if ( isset( $_POST[ 'descount' ] ) )update_post_meta( $post_id, 'descount', $_POST[ 'descount' ] );
	if ( isset( $_POST[ 'copon' ] ) )update_post_meta( $post_id, 'copon', $_POST[ 'copon' ] );
	if ( isset( $_POST[ 'food' ] ) )update_post_meta( $post_id, 'food', $_POST[ 'food' ] );

}

/*--------------------------------  partner fields ----------------------------*/

add_action( 'add_meta_boxes', 'register_field_partner' );
function register_field_partner(){// --- Parameters: ---
	add_meta_box( "partner", // ID attribute of metabox
		"الرابط", // Title of metabox visible to user
		'meta_box_callback_partner', // Function that prints box in wp-admin
		"partner", // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order

}
function meta_box_callback_partner() {
	$values = get_post_custom( $post->ID );
	$selected = isset( $values[ "partner" ] ) ? $values[ "partner"  ][ 0 ] : '';
	wp_nonce_field( 'partner_nonce', 'my_partner' );
	?>
	<p>
	<label for="partner">
			<p>رابط الشريك</p>
		</label>

			<input type="text" name="partner" value="<?php echo $selected; ?>" style="width:98%">

	</p>

	<?php

}
add_action( 'save_post', 'register_field_partner_save' );
function register_field_partner_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !isset( $_POST[ 'my_partner' ] ) || !wp_verify_nonce( $_POST[ 'my_partner' ], 'partner_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ 'partner' ] ) )update_post_meta( $post_id, 'partner', $_POST[ 'partner' ] );

}

/*------------------- news letter users fields ----------------------*/

add_action( 'add_meta_boxes', 'register_field_nletter_users' );
function register_field_nletter_users(){// --- Parameters: ---
	add_meta_box( "nletter_users", // ID attribute of metabox
		"الرابط", // Title of metabox visible to user
		'meta_box_callback_nletter_users', // Function that prints box in wp-admin
		"nletter_users", // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order

}
function meta_box_callback_nletter_users() {
	$values = get_post_custom( $post->ID );
	$selected = isset( $values[ "nletter_users" ] ) ? $values[ "nletter_users"  ][ 0 ] : '';
	wp_nonce_field( 'nletter_users_nonce', 'my_nletter_users' );
	?>
	<p>
	<label for="nletter_users">
			<p>الإيميلات</p>
		</label>
			<textarea name="nletter_users" style="width:98%" rows="5" dir="ltr"><?php


// NOTE :: wordpress saves arrays as serialized , you havr to unserialize

//echo $selected;

$selected =  unserialize($selected);
			foreach($selected as $x => $x_value) {
				if(($x  !== '') && ($x_value == "yes")){
    echo  $x . ",";
	}
}
			 ?></textarea>

	</p>

	<?php

}
add_action( 'save_post', 'register_field_nletter_users_save' );
function register_field_nletter_users_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !isset( $_POST[ 'my_nletter_users' ] ) || !wp_verify_nonce( $_POST[ 'my_nletter_users' ], 'nletter_users_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ 'nletter_users' ] ) )update_post_meta( $post_id, 'nletter_users', $_POST[ 'nletter_users' ] );

}


/*--------------------------------  Contact Forms fields ----------------------------*/

function forms_checker(){

if($_POST['cfz_g_submit'] ){

	if($_FILES['your_resume']){

		// SOURCE :: https://www.w3schools.com/php/php_file_upload.asp

		 $target_dir = wp_upload_dir();
	 $target_dir  =  $target_dir['basedir'];

	 $file_name_changer =  rand(1,1000000000000);
	 $target_file = $target_dir . "/" . $file_name_changer . basename($_FILES["your_resume"]["name"]);
	 $target_file_real_url  =   $target_dir['baseurl']  . "/" . basename($_FILES["your_resume"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
	/*	if ($_FILES["your_resume"]["size"] > 5000000) {
		    echo "<div class='alert alert-danger'>عفواً ، حجم الملف المرفق أكبر من 5 ميجا ، الحجم المطلوب المفترض لا يزيد عن 5 ميجا بايت ، نأمل المحاولة مرة أخرى .</div>";
		    $uploadOk = 0;
		}*/

		// Check if image file is a actual image or fake image

		  /*  $check = getimagesize($_FILES["your_resume"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }*/

				if (move_uploaded_file($_FILES["your_resume"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["your_resume"]["name"]). " has been uploaded.";

			 $target_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

	}


	$fieldset_value = '';
foreach ($_POST as $key => $value) {
	//echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
	if((htmlspecialchars($key) !== 'cfz_g_submit') && (htmlspecialchars($key) !== "captcha") && ( htmlspecialchars($key) !== "rand_sum") && ( htmlspecialchars($key) !== "receiver_email") ){

	$fieldset_value .=  htmlspecialchars($key)." : ".htmlspecialchars($value)."<br>";

	/*if(htmlspecialchars($key) == 'your_resume') {

		$attachment_name = htmlspecialchars($key);

	}

	echo htmlspecialchars($key);*/

}
}

//echo $fieldset_value;

$to = $_POST['sender_email'];
$to_receiver = $_POST['receiver_email'];
$subject = 'Message received successfully';
$body = $fieldset_value;
$headers = array('Content-Type: text/html; charset=UTF-8');
$headers[] = 'From: <'.$to_receiver.'>';


$headers2 = array('Content-Type: text/html; charset=UTF-8');
$headers2[] = 'From: <'.$to.'>';


//$admin_email= get_bloginfo( 'admin_email' );



			if($_POST['captcha']) {

					if($_POST['captcha'] == $_POST['rand_sum']) {


					//	$attachments = array(WP_CONTENT_DIR . '/'."uploads".'/'.$file_name);

							$attachments =  $target_file;

						$email_status = wp_mail( $to, $subject, $body, $headers , $attachments);

						$email_status2 = wp_mail( $to_receiver, "نموذج " . get_the_title() . " لـ" .get_bloginfo('name'), $body, $headers2 , $attachments );
						//$email_status2 = wp_mail( $to_receiver, "نموذج تواصل معنا ل ".get_bloginfo('name'), $body, $headers2 , $attachments );

						if(($email_status == 1) && ($email_status2 == 1)) {

						echo"<p class='alert alert-success'>تم ارسال رسالتك بنجاح</p>";

					} else {

echo"<p class='alert alert-warning'>حدث خطأ ما ، نأمل المحاولة مرة أخرة </p>";
						}

					} else {
								echo"<p class='alert alert-danger'>رمز التحقق غير صحيح.</p>";
						}

				} else {

					$email_status = wp_mail( $to, $subject, $body, $headers );

					$email_status2 = wp_mail( $to_receiver, "نموذج تواصل معنا ل ".get_bloginfo('name'), $body, $headers2 );

					if(($email_status == 1) && ($email_status2 == 1)) {

					echo"<p class='alert alert-success'>تم ارسال رسالتك بنجاح</p>";

				} else {

echo"<p class='alert alert-warning'>حدث خطأ ما ، نأمل المحاولة مرة أخرة </p>";
					}

			 }

}

}

//echo $_POST['الاسم_هو'];

               /*------------ Short code -----------------*/

// Sample usage ::  [contact_form id="12345"]
							 function contact_form( $atts ) {
	//return "id = {$atts['id']}";
	//return  $atts['id'] .  $atts['name'];

	forms_checker();


	  $contact_id = $atts['id'] ;
		$form =  get_field( $contact_id,'cfz');
		$form =  str_replace('---','<fieldset>',$form);
		$form =  str_replace('***','</fieldset>',$form);
		$form =  str_replace('/textarea','</textarea>',$form);


if($atts['captcha'] == "yes") {

	$first_random = rand(1,10);
	$second_random = rand(10,1);


$rand_sum  = $first_random + 	$second_random;

	$captcha_field = '<fieldset><label class="col-lg-3">التحقق</label><div class="col-lg-9 ">مجموع <span class="sum_is">' . $first_random .' + '. $second_random . '</span><input class="form-control" type="text" name="captcha"  placeholder="اكتب مجموع الرقمين السابقين" value="" required /></div></fieldset>';

$hidden_captcha_input = "<fieldset><input type='hidden' name='rand_sum' value='".$rand_sum ."' /></fieldset>";
 	$form .=  	$captcha_field . $hidden_captcha_input ;

}


		$hidden_email = get_field($contact_id,'receiver_email');
		$hidden_email_input = "<input type='hidden' name='receiver_email' value='".$hidden_email ."' />";


$link_is = get_permalink();
$head_is = "<form method='post' enctype='multipart/form-data'>";
$footer_is =  "<br /><center><input type='submit' name='cfz_g_submit' value='إرسال'  class='btn btn-success' /></center></from>";

return $head_is . $form . $hidden_email_input . $footer_is;
 }


/*------------------- captcha ---------------------*/
/*
function generateRandomString($length = 10) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
					$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
			return $randomString;
	}
	function generateCaptchaImage($text = 'good'){
			// Set the content-type
			header('Content-Type: image/png');
			$width  = 200;
			$height = 30;
			// Create the image
			$im = imagecreatetruecolor($width, $height);

			// Create some colors
			$white  = imagecolorallocate($im, 255, 255, 255);
			$grey   = imagecolorallocate($im, 128, 128, 128);
			$black  = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im, 0, 0, 399, 29, $white);

			//ADD NOISE - DRAW background squares
			$square_count = 6;
			for($i = 0; $i < $square_count; $i++){
					$cx = rand(0,$width);
					$cy = (int)rand(0, $width/2);
					$h  = $cy + (int)rand(0, $height/5);
					$w  = $cx + (int)rand($width/3, $width);
					imagefilledrectangle($im, $cx, $cy, $w, $h, $white);
			}

			//ADD NOISE - DRAW ELLIPSES
			$ellipse_count = 5;
			for ($i = 0; $i < $ellipse_count; $i++) {
				$cx = (int)rand(-1*($width/2), $width + ($width/2));
				$cy = (int)rand(-1*($height/2), $height + ($height/2));
				$h  = (int)rand($height/2, 2*$height);
				$w  = (int)rand($width/2, 2*$width);
				imageellipse($im, $cx, $cy, $w, $h, $grey);
			}

			// Replace path by your own font path
			$font = 'ThisisKeSha.ttf';

			// Add some shadow to the text
			imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);

			// Add the text
			imagettftext($im, 20, 0, 10, 20, $black, $font, $text);

			// Using imagepng() results in clearer text compared with imagejpeg()
			imagepng($im);
			imagedestroy($im);
	}*/

 /*----------------- fileds ---------------------*/
add_shortcode( 'contact_form', 'contact_form' );

add_action( 'add_meta_boxes', 'register_field_cfz' );
function register_field_cfz(){// --- Parameters: ---
	add_meta_box( "cfz", // ID attribute of metabox
		"النموذج", // Title of metabox visible to user
		'meta_box_callback_cfz', // Function that prints box in wp-admin
		"cfz", // Show box for posts, pages, custom, etc.
		'normal', // Where on the page to show the box
		'high' ); // Priority of box in display order

}
function meta_box_callback_cfz() {
	$values = get_post_custom( $post->ID );
	$selected = isset( $values[ "cfz" ] ) ? $values[ "cfz"  ][ 0 ] : '';
	$receiver_email = isset( $values[ "receiver_email" ] ) ? $values[ "receiver_email"  ][ 0 ] : '';
	wp_nonce_field( 'cfz_nonce', 'my_cfz' );
	?>
<!-- Start of CFZ generator -->
	<div class="cfz_generator">

		<div class="test_view">كود النموذج : [contact_form id="<?= get_the_id(); ?>" captcha="yes"]</div>
		<br />
		<hr />
		<br />
<div class="zfg_f" style="direction:rtl;">
		<fieldset>
			<label for="field_name" class="fixed_data">اسم الحقل</label>
			<input type="text" class="dynamic_data field_name" name="field_name" placeholder="field name"  value="" />
			<label for="filed_place_holder" class="fixed_data">القيمة الافتراضية للحقل</label>
			<input type="text" class="dynamic_data filed_place_holder" name="filed_place_holder" placeholder="filed name"  value="" />
<label for="filed_type" class="fixed_data">نوع الحقل</label>
<select name="filed_type" class="filed_type dynamic_data">
	<option value="0">- not selected -</option>
	<option value="text">text</option>
	<option value="email">email</option>
	<option value="textarea">textarea</option>
	<option value="phone">phone / mobile</option>
	<option value="number">Number</option>
	<option value="country">Country</option>
	<!--<option value="captacha">captacha</option>-->
	<option value="file">file</option>
	<!--<option value="captcha">captcha</option>-->
</select>
<input type="hidden" name="filed_type_output" value="" />
</fieldset>
<br />
	</div>

		<span class="add_more_cfz_filed">add field</span>


		<style>
		.add_more_cfz_filed { background: gray; color: black; padding: 6px 10px; border-radius: 4px; cursor: pointer;}
		.add_more_cfz_filed:hover { background: lightblue; color: black; padding: 6px 10px; border-radius: 4px; cursor: pointer;}
		.add_more_cfz_filed::before{     content: "\f132";
    top: 4px;}

		</style>

		<script>

// NOTICE : In admin pages you have to use JQuery instead of $


	jQuery('.filed_type').on('change',function(){
	//alert('changed'+jQuery(this).val());
var filed_type_output = jQuery(this).val();
	});

				jQuery('.add_more_cfz_filed').on('click',function(){

		//alert('Clicked');


		var filed_place_holder = jQuery('.zfg_f fieldset:last-child .filed_place_holder').val();

		var field_name = jQuery(".zfg_f").find(".field_name:last").val();
		var filed_place_holder = jQuery(".zfg_f").find(".filed_place_holder:last").val();
	//alert(field_name);

				//jQuery('.zfg_f').append(filed_name+filed_place_holder+"<br />");

//var filedset_data = 	jQuery('.zfg_f').html();

var fieldtype = jQuery(".zfg_f").find("fieldset .filed_type:last").val();
if(fieldtype == "text" ){

	//alert(fieldtype);

var filedtype_html = '<label class="col-lg-3">'+field_name+'</label><div class="col-lg-9"><input class="form-control" pattern="[أ-يa-zA-Z-.\s]{1,30}" type="'+fieldtype+'" name="'+field_name+'"  placeholder="'+filed_place_holder+'" value="" title="الحقل ييجب أن حتوي على الحروف والمسافات والنقاط  " required /></div>';

}


if(fieldtype == "phone"){

	//alert(fieldtype);

var ff = '\d';
var filedtype_html = '<label class="col-lg-3">'+field_name+'</label><div class="col-lg-9"><input class="form-control" type="tel" pattern="'+ff+'{1,15}" maxlength="15" name="'+field_name+'"  placeholder="'+filed_place_holder+'" value="" title="الحقل يجب أن يحتوي على أرقام فقط" required /></div>';
}


if(fieldtype == "number"){

	//alert(fieldtype);


var filedtype_html = '<label class="col-lg-3">'+field_name+'</label><div class="col-lg-9"><input class="form-control" type="number" name="'+field_name+'"  placeholder="'+filed_place_holder+'" value="" min="1" max="50"  title="الحقل يجب أن يحتوي على أرقام فقط" required /></div>';
}


if(fieldtype == "country"){

var filedtype_html =  '<label class="col-lg-3">'+field_name+'</label><div class="col-lg-9"><select class="form-control" name="الجنسية"><option value="افغاتي">افغاتي</option><option value="الباني">الباني</option><option value="جزائري">جزائري</option><option value="امريكي">امريكي</option><option value="اندوري">اندوري</option><option value="انغولي">انغولي</option><option value="أنتيغوا">أنتيغوا</option><option value="ارجنتيني">ارجنتيني</option><option value="ارميني">ارميني</option><option value="استرالي">استرالي</option><option value="نمساوي">نمساوي</option><option value="أذربيجاني">أذربيجاني</option><option value="جزر البهام">جزر البهاما</option><option value="بحريني">بحريني</option><option value="بنجلاديش">بنجلاديش</option><option value="باربادوسي">باربادوسي</option><option value="بربودا">بربودا</option><option value="بستوني">بستوني</option><option value="بيلاروسي">بيلاروسي</option><option value="بلجيكي">بلجيكي</option><option value="بليز">بليز</option><option value="بنين">بنين</option><option value="بوتان">بوتان</option><option value="23">بوليفي</option><option value="24">بوسني</option><option value="برازيلي">برازيلي</option><option value="بريطاني">بريطاني</option><option value="بروناى">بروناى</option><option value="بلغاري">بلغاري</option><option value="بوركينا فاس">بوركينا فاسو</option><option value="بورمي">بورمي</option><option value="بوروندي">بوروندي</option><option value="كمبودي">كمبودي</option><option value="كاميروني">كاميروني</option><option value="كندي">كندي</option><option value="35">الرأس الأخضر</option><option value="أفريقيا الوسطى">أفريقيا الوسطى</option><option value="تشادي">تشادي</option><option value="تشيلي">تشيلي</option><option value="صيني">صيني</option><option value="كولومبي">كولومبي</option><option value="جزر القمر">جزر القمر</option><option value="كونغولي">كونغولي</option><option value="كوستاريكا">كوستاريكا</option><option value="كرواتي">كرواتي</option><option value="كوبي">كوبي</option><option value="قبرصي">قبرصي</option><option value="تشيكي">تشيكي</option><option value="دنماركي">دنماركي</option><option value="جيبوتي">جيبوتي</option><option value="دومينيكان">دومينيكان</option><option value="هولندي">هولندي</option><option value="تيمور الشرقية">تيمور الشرقية</option><option value="اكوادوري">اكوادوري</option><option value="مصري">مصري</option><option value="اماراتي">اماراتي</option><option value="غينيا الاستوائية">غينيا الاستوائية</option><option value="إرتيري">إرتيري</option><option value="إستوني">إستوني</option><option value="اثيوبي">اثيوبي</option><option value="فيجي">فيجي</option><option value="فلبيني">فلبيني</option><option value="فنلدي">فنلدي</option><option value="فرنسي">فرنسي</option><option value="جابوني">جابوني</option><option value="غامبي">غامبي</option><option value="جوريجي">جوريجي</option><option value="الماني">الماني</option><option value="غاني">غاني</option><option value="يوناني">يوناني</option><option value="جرينادا">جرينادا</option><option value="غواتيمالا">غواتيمالا</option><option value="غ">غينيا - بيسوان</option><option value="غينيا">غينيا</option><option value="جويانا">جويانا</option><option value="هايتي">هايتي</option><option value="الهرسك">الهرسك</option><option value="هندوراسي">هندوراسي</option><option value="مجري">مجري</option><option value="كيريباسي">كيريباسي</option><option value="ايسلندي">ايسلندي</option><option value="هندي">هندي</option><option value="إندونيسي">إندونيسي</option><option value="ايراني">ايراني</option><option value="عراقي">عراقي</option><option value="إيلندي">إيلندي</option><option value="الاحتلال الصهيوني">الاحتلال الصهيوني</option><option value="إيطالي">إيطالي</option><option value="ساحل العاج">ساحل العاج</option><option value="جامايكي">جامايكي</option><option value="ياباني">ياباني</option><option value="اردني">اردني</option><option value="كازاخستاني">كازاخستاني</option><option value="كيني">كيني</option><option value="كيتي">كيتي</option><option value="كوياي">كوياي</option><option value="قيرغيزستاني">قيرغيزستاني</option><option value="لاوسي">لاوسي</option><option value="لاتفيي">لاتفيي</option><option value="لبناني">لبناني</option><option value="ليبيري">ليبيري</option><option value="ليبي">ليبي</option><option value="ليشتنستينر">ليشتنستينر</option><option value="ليتواني">ليتواني</option><option value="لكسمبرغ">لكسمبرغ</option><option value="مقدوني">مقدوني</option><option value="مدغشقر">مدغشقر</option><option value="مالاوى">مالاوى</option><option value="ماليزي">ماليزي</option><option value="مالديفي">مالديفي</option><option value="مالي">مالي</option><option value="مالطي">مالطي</option><option value="جزر مارشال">جزر مارشال</option><option value="موريتاني">موريتاني</option><option value="موريشيوس">موريشيوس</option><option value="مكسيكي">مكسيكي</option><option value="ميكرونيزيا">ميكرونيزيا</option><option value="مولدوفا">مولدوفا</option><option value="موناكو">موناكو</option><option value="منغولية">منغولية</option><option value="مغربي">مغربي</option><option value="موسوتو">موسوتو</option><option value="موتسوانا">موتسوانا</option><option value="موزمبيقي">موزمبيقي</option><option value="ناميبيا">ناميبيا</option><option value="ناورو">ناورو</option><option value="نيبالي">نيبالي</option><option value="نيوزلندي">نيوزلندي</option><option value="نيكاراغوا">نيكاراغوا</option><option value="نيجيري">نيجيري</option><option value="النيجر">النيجر</option><option value="كوريا الشمالية">كوريا الشمالية</option><option value="ايرلندا الشمالية">ايرلندا الشمالية</option><option value="نرويجي">نرويجي</option><option value="عماني">عماني</option><option value="باكستاني">باكستاني</option><option value="بالواني">بالواني</option><option value="بنما">بنما</option><option value="بابوا غينيا الجديدة">بابوا غينيا الجديدة</option><option value="باراغواي">باراغواي</option><option value="بيرو">بيرو</option><option value="بولندي">بولندي</option><option value="برتغالي">برتغالي</option><option value="قطري">قطري</option><option value="روماني">روماني</option><option value="روسي">روسي</option><option value="رواندا">رواندا</option><option value="سانت لوسيا">سانت لوسيا</option><option value="سلفادوري">سلفادوري</option><option value="ساموا">ساموا</option><option value="سان مارينيز">سان مارينيز</option><option value="ساو تومي">ساو تومي</option><option selected="" value="سعودي">سعودي</option><option value="اسكتلندي">اسكتلندي</option><option value="سنغالي">سنغالي</option><option value="صربي">صربي</option><option value="سيشل">سيشل</option><option value="سيراليون">سيراليون</option><option value="سنغافوري">سنغافوري</option><option value="سولوفاكي">سولوفاكي</option><option value="سلوفيني">سلوفيني</option><option value="جزر سليمان">جزر سليمان</option><option value="صومالي">صومالي</option><option value="جنوب أفريقيا">جنوب أفريقيا</option><option value="كوريا الجنوبية">كوريا الجنوبية</option><option value="اسباني">اسباني</option><option value="سيريلانكي">سيريلانكي</option><option value="سوداني">سوداني</option><option value="سورينامي">سورينامي</option><option value="سوازي">سوازي</option><option value="سويدي">سويدي</option><option value="سويسري">سويسري</option><option value="سوري">سوري</option><option value="تايواني">تايواني</option><option value="طاجيكي">طاجيكي</option><option value="تنزاني">تنزاني</option><option value="تايلاندي">تايلاندي</option><option value="توغو">توغو</option><option value="توجاني">توجاني</option><option value="ترينيداد / توباجونيا">ترينيداد / توباجونيان</option><option value="تونسي">تونسي</option><option value="ركي">ركي</option><option value="توفالي">توفالي</option><option value="اوغندي">اوغندي</option><option value="اوكراني">اوكراني</option><option value="أوروجواي">أوروجواي</option><option value="أوزبكستان">أوزبكستان</option><option value="فنزويلي">فنزويلي</option><option value="فيتنامي">فيتنامي</option><option value="ويلز">ويلز</option><option value="يمني">يمني</option><option value="زامبيا">زامبيا</option><option value="زيمبابوي">زيمبابوي</option></select></div>';
}

if(fieldtype == "email" ){

	//alert(fieldtype);

var filedtype_html = '<label class="col-lg-3">'+field_name+'</label><div class="col-lg-9"><input class="form-control" type="'+fieldtype+'" name="sender_email"  placeholder="'+filed_place_holder+'" value="" title="الحقل يجب أن يحتوي على صيغة البريد الإلكتروني فقط" required /></div>';

}



if((fieldtype == "textarea") ){

	//alert(fieldtype);

var filedtype_html = '<label class="col-lg-3">'+field_name+'</label><div class="col-lg-9"><textarea name="'+field_name+'" class="form-control" placeholder="'+filed_place_holder+'" required>/textarea</div>';

}


if((fieldtype == "file") ){

	//alert(fieldtype);

	var filedtype_html = '<label class="col-lg-3">'+field_name+'</label><div class="col-lg-9"><input type="'+fieldtype+'" class="form-control-file" name="'+field_name+'"  placeholder="'+filed_place_holder+'" value="" accept=".pdf,.docs,.docx,.jpg,.jpeg" required /><i>الملفات المقبولة : .pdf,.docs,.docx,.jpg,.jpeg</i></div>';

}


/*if((fieldtype == "captcha") ){

	//alert(fieldtype);

	var filedtype_html = '<input type="'+fieldtype+'" name="'+field_name+'"  placeholder="'+filed_place_holder+'" value="" required />';

}*/



//jQuery('.cfz_gf').append('<filedset><label>'+field_name+'</label></fieldset>'field_name+filed_place_holder+jQuery(".zfg_f").find(".filed_type:last").val()+"<br />");
//alert(filedtype_html);
//jQuery('.cfz_gf').append("-- Start field -- ");
 var currentVal = jQuery('.cfz_gf').val();
 jQuery('.cfz_gf').val(currentVal + "<br />"+'---'+filedtype_html+'***');
 //jQuery('.test_view').html(currentVal + "<br />"+'<fieldset>'+filedtype_html+'</fieldset>');

var fieldset_content = jQuery('.zfg_f fieldset:first-child').html();
jQuery('.zfg_f').append("<fieldset>"+fieldset_content+"</fieldset>"+"<br />");

		jQuery(".zfg_f fieldset").css({"background":"none"});
		jQuery(".zfg_f").find("fieldset:last").css({"background":"lightblue"});


				});
		</script>
	</div>
	<!-- End of CFZ generator -->
	<p>
	<label for="cfz">
			<p>النموذج</p>
		</label>
			<textarea name="cfz" class="cfz_gf" style="width:98%; " rows="10"> <?php echo $selected; ?></textarea>
	</p>

	<br />
	<hr />
	<br />

	<p>
	<label for="receiver_email">
			بريد المستلم
		</label>
			<input type="text" name="receiver_email" value="<?php echo $receiver_email; ?>" style="width: 50%">

	</p>

	<?php

}
add_action( 'save_post', 'register_field_cfz_save' );
function register_field_cfz_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !isset( $_POST[ 'my_cfz' ] ) || !wp_verify_nonce( $_POST[ 'my_cfz' ], 'cfz_nonce' ) ) return;
	if ( !current_user_can( 'edit_post' ) ) return;
	$allowed = array('a' => array( 'href' => array() ));
	if ( isset( $_POST[ 'cfz' ] ) )update_post_meta( $post_id, 'cfz', $_POST[ 'cfz' ] );
	if ( isset( $_POST[ 'receiver_email' ] ) )update_post_meta( $post_id, 'receiver_email', $_POST[ 'receiver_email' ] );

}

?>
