<?php
/*
Template Name: Projects
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
      
       <?php $wp_query = new WP_Query("order=ASC&post_type=projects&post_status=publish&posts_per_page=6");
	 $i = 0; ?>
            <?php while ($wp_query->have_posts()) : $wp_query->the_post();
			
			search_result_is();
			
			endwhile; 
        wp_reset_query();
         wp_reset_postdata(); ?>
         
      </Div>
      
      </div>
      </div>
     </div>
 </aside>
<?php get_footer(); ?>