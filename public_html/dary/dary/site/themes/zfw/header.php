<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?
/* disable WP jquery */
wp_deregister_script('jquery');
?>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<? echo get_template_directory_uri(); ?>/fw/images/logo.png" />
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<?php   if ( is_singular() && get_option( 'thread_comments' ) )
wp_enqueue_script( 'comment-reply' );
wp_head();
?>
<title>
<?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'zfw' ), max( $paged, $page ) );
	?>
</title>
<link rel="shortcut icon" type="image/png" href="<? echo get_stylesheet_directory_uri(); ?>/fw/images/favicon.png"/>
<!-- Responsive scripts -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
<meta name="robots" content="INDEX,FOLLOW">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<!--[if lt IE 9]>
<script src="<? echo get_stylesheet_directory_uri(); ?>/js/html5shiv.js"></script>
<![endif]-->
</head>
<body id="page-top" <?php //body_class(); ?>>

	<nav class="navbar navbar-default animated slideInDown">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">القائمة</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= get_site_url(); ?>">
				<!--<img src="<? echo get_template_directory_uri(); ?>/fw/images/logo.png" class="logo">-->
				<img src="http://demo.de.net.sa/2018/zwaid/Dary/wp/site//uploads/2018/05/logo-3.png" class="logo">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


		<ul class="nav navbar-nav navbar-left bgwhitexs">
		<!--<li><a href="<?= get_site_url(); ?>">الرئيسية</a></li>-->
			<?php  //wp_nav_menu( array('menu' => 'main','menu_class'  =>'nav navbar-nav navbar-left bgwhitexs', 'container' => '', 'container_class' => ''));
		 wp_nav_menu_no_ul(); ?>

		 <li>
          <div class="search">
            <div class="hexagon text-center">
             <form method="get" action="<?= get_site_url(); ?>"><button type="submit" class="fa fa-search"></span></button>
            </div>
            <div class="col-xs-12 search-form" style=" display: none;">
              <div>

                <input type="" name="s" class="form-control" placeholder="بحث ...">
				  </form>
              </div>
            </div>
          </div>
        </li>
</ul>



    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>

	<?php if(!is_home()){ ?>
	<div class="col-xs-12 slider_1_holder" style=" height: 190px; overflow: hidden;">
				<?php $wp_query = new WP_Query("order=DESC&post_type=slider&post_status=publish&posts_per_page=1"); ?>
			<?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
				<img src="<?php thumb_it($width,$height,$crop); ?>" alt="...">
			<?php
	endwhile;
        wp_reset_query();
        wp_reset_postdata(); ?>

</div>
	<?php } ?>
