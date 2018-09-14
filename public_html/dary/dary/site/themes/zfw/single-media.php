<?php
get_header(); ?>
    <aside>
        	<div class="container">
         <div id="content" class="content col-lg-12 no-padding" role="main">
<?php echo the_breadcrumb(); ?>
        <div class="col-lg-12 page-content no-padding">
<div class="title"><h2><?php the_title(); ?></h2></div>
<?php

if ( have_posts() )
 while ( have_posts() ) : the_post();  ?>
		    <div class="col-lg-12">
            <div class="time-date"><?php zfw_date_time(); ?></div>
 <?php

 $video_link= get_post_meta('video_link');
if($video_link){
  $embed_video = str_replace("https://www.youtube.com/watch?v=","https://www.youtube.com/embed/",$video_link);
  $video_id = str_replace("https://www.youtube.com/watch?v=","",$video_link);
		?>
<div class="col-lg-6 col-lg-offset-3"><a data-fancybox data-type='iframe' data-src=',<?= $embed_video; ?>?autoplay=1' style='z-index:3; overflow:hidden;'><i class='fa fa-play-circle'></i><img src='https://i.ytimg.com/vi/<?= $video_id; ?>/hqdefault.jpg' class='img-responsive'></a></div>
			<?php }
      the_content();?>


<?php  endwhile; // end of the loop. ?>


			</div><!-- #content -->

</div>
</aside>
<?php get_footer(); ?>
