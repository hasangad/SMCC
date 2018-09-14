<?php
/**
 * Template Name: One column, no sidebar
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
get_header(); ?>
		<aside>
        	<div class="container">
         <div id="content" class="content col-lg-12" role="main">
<?php echo the_breadcrumb(); ?>
        <div class="col-lg-12 page-content">
  
  <h1 class="title"><span><?= get_the_title(); ?></span></h1>
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="col-lg-12"> 
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<div class="entry-content">
						<div id="pr_content"><?php the_content(); ?>
                      <center><?php
	//youtube_view($id,get_post_meta( $id, 'meta_box_video_embed',true),'media_show_page',620,390);
?></center></div>
						
					</div><!-- .entry-content -->
				</div><!-- #post-## -->
</div>
<?php endwhile; ?>
			  
</div><!-- #content -->           
</div>
</aside>
  <?php get_footer(); ?>