<?php
get_header();
?>
<aside>
	<div class="container">
		<div id="content" class="content col-lg-12 no-padding" role="main">
			<?php echo the_breadcrumb(); ?>
			<div class="col-lg-12 page-content no-padding">
				<div class="title">
					<h2>
						<?php the_title(); ?>
					</h2>
				</div>

				<?php if ( have_posts() )
 while ( have_posts() ) : the_post();  ?>
				<div class="col-lg-12">
<?php 
				
the_content();

	 endwhile; // end of the loop. ?>


				</div>
				<!-- #content -->

			</div>
		</div>
	</div>
</aside>
<?php get_footer(); ?>