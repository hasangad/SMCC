<?php
/*
Template Name: Media
*/
?>
<?php get_header(); ?>
    <aside>
        	<div class="container no-padding">
         <div id="content" class="content col-lg-12 no-padding" role="main">
<?php echo the_breadcrumb(); ?>
        <div class="col-lg-12 page-content">
          
                      <div class="title"><h2><i class="site_icon pull-right"></i> <?php the_title(); ?><i class="site_icon pull-left"></i></h2></div>

         
      <Div class="news container-fluid">
      
       <?php $wp_query = new WP_Query("order=ASC&post_type=media&post_status=publish&posts_per_page=9999");
	 $i = 0; ?>
            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
			
           <div class="item col-lg-4">
						 	<div class="services-container">
              <div class="serv-image"> <img src="<?php thumb_it($width,$height,$crop); ?>" alt=""  /> 
              <a href="<?= get_permalink(); ?>" class="more-image"></a> 
              </div>
              <!--serv-image-->
              <div class="serv-details">
             <h2><a href="<?= get_permalink(); ?>"><?= get_the_title(); ?></a></h2>
								<!--<article><?= wp_trim_words(get_the_content(),' 12 ', ' ... ' ); ?></article>-->
								<a href="<?= get_permalink(); ?>">المزيد <i class="fa fa-angle-left"></i></a>
                </div>
              <!--serv-details--> 
            </div>
						 </div><!--item-->
			
			 <?php endwhile; 
        wp_reset_query();
         wp_reset_postdata(); ?>
         
      </Div>
        
      </div>
      </div>
      </div>
 </aside>
<?php get_footer(); ?>