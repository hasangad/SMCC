<?php
/*
Template Name: Contact
*/
?>
<?php get_header(); ?>
    <aside>
        	<div class="container">
         <div id="content" class="content col-lg-12" role="main">
<?php echo the_breadcrumb(); ?>
        <div class="col-lg-12 page-content">
        
      <div class="title"><h2><?php the_title(); ?></h2></div>
      
      </div>
    
      
<?php $wp_query = new WP_Query("order=ASC&post_type=contact&posts_per_page=2&offset=0"); // NOTICE :: Double qoutation are a magic word in wp_query ~HG  ?>

        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

<div class="col-lg-6">
	
	
	<h4><?php the_title(); ?></h4>
<br />
	
<?php the_content(); ?>



<ul class="contact_us col-lg-12">

  <?php 

 
  if(get_post_meta(get_the_id(),'_address',true)){?>


        <li class="fa fa-map-marker col-md-12"> <span><?php echo get_post_meta(get_the_id(),'_address',true); ?></span></li><?php } ?>



        <?php if(get_post_meta(get_the_id(),'_phone',true)){?>



        <li class="fa fa-phone-square col-md-12"> <span><?php echo get_post_meta(get_the_id(),'_phone',true); ?></span></li><?php } ?>



         <?php if(get_post_meta(get_the_id(),'_mobile',true)){?>



        <li class="fa fa-mobile col-md-12"> <span><?php echo get_post_meta(get_the_id(),'_mobile',true); ?></span></li><?php } ?>


        <?php if(get_post_meta(get_the_id(),'_mobile2',true)){?>



        <li class="fa fa-mobile col-md-12"> <span><?php echo get_post_meta(get_the_id(),'_mobile2',true); ?></span></li><?php } ?>



         <?php if(get_post_meta(get_the_id(),'_email',true)){?>



        <li class="fa fa-envelope col-md-12"><span> <a href="mailto:<?php echo get_post_meta(get_the_id(),'_email',true); ?>"><?php echo get_post_meta(get_the_id(),'_email',true); ?></a></span></li><?php } ?>

        </ul>
	
<div class="col-lg-12">

<?php 
//$code_is = get_post_meta(get_the_id(),'cf7-contact-us',true);

$code_is =get_field('contqact_code');
//$code_is ='[contact-form-7 id="6" title="Contact form"]';
echo do_shortcode($code_is); ?>
</div>

<div class="col-lg-12">

<br />
<br />

 <?= get_post_meta(get_the_id(),'_map',true); ?>

	  </div>
			 

			 
</div>

  <?php 


endwhile;


   wp_reset_query();



  wp_reset_postdata();
   ?>




 </aside>
<?php get_footer(); ?>