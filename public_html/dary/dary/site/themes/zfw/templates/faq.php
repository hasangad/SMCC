<?php
/*
Template Name: FAQ
*/
?>
<?php get_header(); ?>
    <aside>
        	<div class="container">
         <div id="content" class="content col-lg-12" role="main">
<?php echo the_breadcrumb(); ?>
        <div class="col-lg-12 page-content">
        
      <h3 class=" title">
        <span><?php the_title(); ?></span>
      </h3>
      
<!--<form method="post" name="member_search_form" action="<?php echo get_permalink(); ?>" class="site_form authors_search_form">
<fieldset class="col-lg-12 no-padding">
<label class="label col-lg-3 no-padding">بحث في أشهر الأسئلة </label><input name="search_key" type="text" value="" placeholder="كلمة البحث هنا !" class="col-lg-6 form-control" />
<input type="submit" value="بحث" name="search_faq" class="btn btn-warning col-lg-3">
</fieldset>
</form>-->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php if(isset($_POST['search_faq'])){
	
	$s =  $_POST['search_key']; ?>
	
<?php
$args = array(
	'order'=>'DESC',
	'post_type'=>'faq',
	'post_status'=>'publish',
	's'=> $s,	
    'posts_per_page'=>99,
	);
	} else {
	$args = array(
	'order'=>'DESC',
	'post_type'=>'faq',
	'post_status'=>'publish',
    'posts_per_page'=>99,
	);	
	}	
	//$wp_query = new WP_Query("order=DESC&post_type=faq&post_status=publish&posts_per_page=99");
	$wp_query = new WP_Query($args);
	$count = $wp_query->post_count;
	if($count == 0) { echo '<div class="alert alert-danger">عفوا ، لا يوجد نتائج !</div>'; }
	 ?>
            <?php $i = 1; while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
			
            
			<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading<?= $i; ?>">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $i; ?>" aria-expanded="true" aria-controls="collapse<?= $i; ?>">
          <b><?= get_the_title(); ?></b>
        </a>
      </h4>
    </div>
    <div id="collapse<?= $i; ?>" class="panel-collapse collapse <?php if($i == 1){ echo "in"; }?>" role="tabpanel" aria-labelledby="heading<?= $i; ?>">
      <div class="panel-body">
        <?= get_the_content(); ?>
      </div>
    </div>
  </div>
            
			
			<?php $i++; endwhile; 
			  wp_reset_query();
         wp_reset_postdata(); ?>
</div>
      
   	</div><!-- #content -->
</div>
</aside>
<?php get_footer(); ?>