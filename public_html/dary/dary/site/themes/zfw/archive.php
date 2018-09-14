<?php get_header(); ?>
  <aside>
        	<div class="container">
 <div id="content" class="content search_page container" role="main">
<?php echo the_breadcrumb(); ?>
        <div class="col-lg-12 page-content no-bg">
        <?php
		if ( have_posts() )the_post(); rewind_posts();
 get_template_part( 'loop', 'archive' );?>
			</div><!-- #content -->
    <?php //get_sidebar(); ?>
</div>
</div>
</aside>
<?php  get_footer(); ?>
