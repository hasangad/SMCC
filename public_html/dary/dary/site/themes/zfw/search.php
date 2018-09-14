<?php
get_header(); ?>


  <aside>
        	<div class="container">
 <div id="content" class="content search_page container no-padding" role="main">
<?php echo the_breadcrumb(); ?>
  <div class="col-lg-12 page-content no-bg">

            <?php if ( have_posts() ) : ?>

    <div class="title"><h2> <?php printf( __( 'Search Results for: %s', 'zfw' ), get_search_query() ); ?> </h2></div>
				<?php get_template_part( 'loop', 'search' );?>
<?php else : ?>
  <div class="alert">
    <h1 class="title"><?php _e( 'Not Found', 'zfw' ); ?></h1>
    <div class="alert alert-danger">
      <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'zfw' ); ?></p>
    </div>
  </div>
<?php endif; ?>
			</div>

            <?php //get_sidebar();?>

</div>
</div>
</aside>
<?php get_footer(); ?>
