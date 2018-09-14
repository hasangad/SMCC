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
				<?php

if ( have_posts() )
 while ( have_posts() ) : the_post();  ?>
				<div class="col-lg-12">
					<?php

					$video_link= get_field($post->ID,'meta_box_video_embed');
					if($video_link){
					 $embed_video = str_replace("https://www.youtube.com/watch?v=","https://www.youtube.com/embed/",$video_link);
					 $video_id = str_replace("https://www.youtube.com/watch?v=","",$video_link);
						 ?>
					<div class="col-lg-6 pull-left">
                    <a data-fancybox data-type='iframe' data-src='<?= $embed_video; ?>?autoplay=1' style='z-index:3; overflow:hidden;'><i class='fa fa-play-circle play_video'></i><img src='https://i.ytimg.com/vi/<?= $video_id; ?>/hqdefault.jpg' class='img-responsive2 youtube_img'></a></div>
				<?php } ?>
		<?php $id = get_the_id(); echo get_the_content($id);

		 endwhile; // end of the loop. ?>



				</div>
				<!-- #content -->

			</div>
</aside>
<?php get_footer(); ?>
