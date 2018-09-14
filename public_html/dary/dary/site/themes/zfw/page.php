<?php
get_header();
?>
<?php
if ( has_post_thumbnail() ) {
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
	$thumb = $large_image_url[ 0 ];
	?>
	<!--<img src="<?=  $thumb; ?>" class="img-responsive" style="width:100%; height:210px" height="210" />-->
	<?php } ?>
	<aside>
		<div class="container">
			<div id="content" class="content col-lg-12 no-padding" role="main">
				<?php echo the_breadcrumb(); ?>
				<div class="col-lg-12 page-content">
					<?php if ( is_front_page() ) { ?>
					<div class="title">
						<h2>
							<?php the_title(); ?>
						</h2>
					</div>
					<?php } else { ?>
					<div class="title">
						<h2>
							<?php the_title(); ?>
						</h2>
					</div>

					<?php } ?>
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div class="col-lg-12">
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<div class="entry-content">

								<div id="pr_content">
									<?php the_content(); 
							
							//after_content_links();
						
						?>
									<center>
										<?php
										?>
									</center>
								</div>

							</div>
							<!-- .entry-content -->
						</div>
						<!-- #post-## -->
					</div>
					<?php endwhile; ?>
				</div>
			</div>
			<!-- #content -->
		</div>
	</aside>
	<?php get_footer(); ?>