<?php 
// SOURCE :: http://codex.wordpress.org/Function_Reference/register_widget
/*class MyNewWidget extends WP_Widget {
	function MyNewWidget() {
		// Instantiate the parent object
		parent::__construct( false, 'My New Widget Title' );
	}
	function widget( $args, $instance ) {
		// Widget output
	}
	function update( $new_instance, $old_instance ) {
		// Save widget options
	}
	function form( $instance ) {
		// Output admin widget options form
	}
}
function myplugin_register_widgets() {
	register_widget( 'MyNewWidget' );
}
add_action( 'widgets_init', 'myplugin_register_widgets' );*/
/*-------------------------------------------------------------*/
//SOURCE :: http://codex.wordpress.org/Function_Reference/wp_register_sidebar_widget
/*---------- SUCCESS PARTNER ---------*/
function hg_success_partner($args) {
   //echo $args['before_widget'];
   //echo $args['before_title'] . 'My Unique Widget' .  $args['after_title'];
   //echo $args['after_widget'];
   // print some HTML for the widget to display here
  // echo "Your Widget Test"; 
  ?>
  <div class="footer_widget">
<h3 >Success Partners</h3>
<div class="footer_block">
 <?php
		/*$by_slug = get_category_by_slug('مقالات_مختارة'); 
  $cat_id = $by_slug->term_id;*/
		$wp_query = new WP_Query("order=DESC&post_status=publish&post_type=dist&posts_per_page=4");
		// NOTICE :: Double qoutation are a magic word in wp_query ~HG  ?>
                <?php while ($wp_query->have_posts()) : $wp_query->the_post();
        if ( has_post_thumbnail() ) {  ?>
            <a href="<?php echo get_permalink(); ?>" original-title="<?php echo get_the_title(); ?>"><img src="<?php thumb_it(45,45,false); ?>" width="" height="" alt="" ></a>
        <? } endwhile;
        wp_reset_query();
             wp_reset_postdata(); ?>
 </div>
</div>
<?php }
wp_register_sidebar_widget(
    'HG_SP',        // your unique widget id
    'Success Partners',          // widget name
    'hg_success_partner',  // callback function
    array(                  // options
        'description' => 'display Success Partners'
    )
);
/*-------------- About - simple -----------------*/
function new_comments($args) {?>
<div id="last_comments" class="widget-container">
        <h3 class="widget-title">Latest comments</h3>
        <ul>
        <?php
		$args = array(
			'status' => 'approve',
			'number' => '4',
			//'post_id' => 1, // use post_id, not post_ID
		);
		$comments = get_comments($args);
		foreach($comments as $comment) {
		$post = get_post("$comment->comment_post_ID");
		$user =  get_user_by( 'email', $comment->comment_author_email );
		echo "<li>";
		echo get_avatar("$comment->comment_author_email",45); 
			echo("<span><h4><strong>".$comment->comment_author . " <em>على</em> </strong>" ."<a href=".get_permalink($post)."#comment-".$comment->comment_ID.">".  $post->post_title. '</a></h4></span>');
			echo "</li>";
		}
		?></ul>
        </div><?php }
wp_register_sidebar_widget(
    'new_comments',        // your unique widget id
    'Latest Comments for MED FORD',          // widget name
    'new_comments',  // callback function
    array(                  // options
        'description' => 'Display Latest Comments'
    )
);
/*-------------- About - simple -----------------*/
function facebook_page($args) {?>
<div class="facebook_box widget-container" style="margin-bottom:20px">
                    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=559652530746621";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
        <h3 class="widget-title">Follow Us On Facebook</h3>
                    <div class="fb-page" data-href="https://www.facebook.com/hasangadonline" data-width="345" data-height="305" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/hasangadonline"><a href="https://www.facebook.com/facebook">MedFord</a></blockquote></div></div>
                    </div><!--facebook_box-->
<?php }
wp_register_sidebar_widget(
    'facebook_page',        // your unique widget id
    'Facebook Page',          // widget name
    'facebook_page',  // callback function
    array(                  // options
        'description' => ''
    )
);
/*-------------- About - simple -----------------*/
function FXprofe_categories($args) {?>
   <div id="last_comments">
        <h3 class="widget-title">Site Categories</h3>
        <ul>
        <?php
$args = array(
  'orderby' => 'name',
  'order' => 'ASC'
  );
$categories = get_categories($args);
  foreach($categories as $category) { 
    echo '<li class="cat_ico"><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> ( '. $category->count . ' ) </li>';  } 
?>
</ul>
</div>
<?php }
wp_register_sidebar_widget(
    'FXprofe_categories',        // your unique widget id
    'Categories',          // widget name
    'FXprofe_categories',  // callback function
    array(                  // options
        'FXprofe_categories' => ''
    )
);
/*-------------- About - simple -----------------*/
function hg_about($args) {?>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                	<div class="about_site">
                    	<h2 class="footer_title">About <?php echo get_option( 'blogname' ); ?></h2>
                        <div class="about">
                        	<span>
                           <? echo get_option( 'footer_disc', $default ); ?>
                            </span>
                        </div><!--about-->
                    </div><!--about_site-->
                </div><!--col-->
<?php }
wp_register_sidebar_widget(
    'HG_ABOUT',        // your unique widget id
    'About',          // widget name
    'hg_about',  // callback function
    array(                  // options
        'description' => ''
    )
);
/*-------------- New Posts -----------------*/
function new_posts_HG($args) {?>
<div class="footer-new-posts footer_widget col-lg-3 col-md-3 col-sm-12 col-xs-12">
<h2 class="footer_title">New Posts</h2>
  <?php
	$pr_query = new WP_Query("order=DESC&post_type=post&post_status=publish&posts_per_page=3");
	/*echo $paged; $i = 1; */?>
      <?php while ($pr_query->have_posts()) : $pr_query->the_post(); ?>
     <li>
     <img src="<?php echo thumb_it(35,40,true); ?>">
     <div class="data">
     <a href="<?php echo get_permalink(); ?>">
	 <?php echo wp_trim_words(get_the_title(),5,'...'); ?></a>
     <p><?php echo wp_trim_words(get_the_content(),'5','...'); ?></p>
     </div>
     </li>
<?php /*$i++;*/ endwhile; 
        wp_reset_query();
         wp_reset_postdata(); ?>
                </div><!--col-->
<?php }
wp_register_sidebar_widget(
    'new-posts-FXprofe',        // your unique widget id
    'New Posts',          // widget name
    'new_posts_HG',  // callback function
    array(                  // options
        'description' => 'Display Latest 3 posts'
    )
);
/*-------------- contact - footer -----------------*/
function hg_contact($args) {?>
	<div class="footer_widget col-lg-3 col-md-3 col-sm-12 col-xs-12">
<div class="footer_widget contact_footer" >
<h3 class="footer_title">Contact INFO</h3>
<ul class="contact">
<?php $wp_query = new WP_Query("order=DESC&post_type=contact&posts_per_page=1"); // NOTICE :: Double qoutation are a magic word in wp_query ~HG  ?>
  <?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
<?php if(get_post_meta(get_the_id(),'_address',true)){?>
<li class="fa fa-map-marker"> <span><?php echo get_post_meta(get_the_id(),'_address',true); ?></span></li><?php } ?>
 <?php if(get_post_meta(get_the_id(),'_phone',true)){?>
 <li class="fa fa-phone-square"> <span><?php echo get_post_meta(get_the_id(),'_phone',true); ?></span></li><?php } ?>
 <?php if(get_post_meta(get_the_id(),'_mobile',true)){?>
<li class="fa fa-mobile"> <span><?php echo get_post_meta(get_the_id(),'_mobile',true); ?></span></li><?php } ?>
<?php if(get_post_meta(get_the_id(),'_mobile2',true)){?>
 <li class="fa fa-mobile"> <span><?php echo get_post_meta(get_the_id(),'_mobile2',true); ?></span></li><?php } ?>
<?php if(get_post_meta(get_the_id(),'_email',true)){?>
 <li class="fa fa-envelope"><span> <a href="mailto:<?php echo get_post_meta(get_the_id(),'_email',true); ?>"><?php echo get_post_meta(get_the_id(),'_email',true); ?></a></span></li><?php } ?>
 <?php endwhile;
       wp_reset_query();
        wp_reset_postdata(); ?>
        </ul>
 </div>
                </div><!--col-->
<?php }
wp_register_sidebar_widget(
    'HG_CONTACT',        // your unique widget id
    'Contact INFO for footer',          // widget name
    'hg_contact',  // callback function
    array(                  // options
        'description' => ''
    )
);
/*-------------- Testomenials -----------------*/
function hg_testo($args) {
   //echo $args['before_widget'];
   //echo $args['before_title'] . 'My Unique Widget' .  $args['after_title'];
   //echo $args['after_widget'];
   // print some HTML for the widget to display here
  // echo "Your Widget Test"; 
  ?>
         <div id="top_articals" class="widget-area fooet_block" >
<h2>من آراء العملاء</h2>
    <div class="top_articals_holder"><ul class="top_articals">
        <?php
		/*$by_slug = get_category_by_slug('مقالات_مختارة'); 
  $cat_id = $by_slug->term_id;*/
		$wp_query = new WP_Query("order=DESC&post_status=publish&post_type=testomenial&posts_per_page=12");
		// NOTICE :: Double qoutation are a magic word in wp_query ~HG  ?>
                <?php while ($wp_query->have_posts()) : $wp_query->the_post();
        if ( has_post_thumbnail() ) {  ?>
            <li>
            <?php echo get_the_post_thumbnail(get_the_id(),array(65,65)); ?>
      	<div class="data_client" >
      <p><?php echo wp_trim_words(get_the_content(),32,' ... '); ?> </p>
      <span><strong><?php echo get_the_title(); ?></strong> - <?php echo get_post_meta(get_the_id(),'company',true); ?></span>
      </div>
 
      </li>  
        <? } endwhile;
        wp_reset_query();
             wp_reset_postdata(); ?>
 </ul></div>
 
 </div><!-- End of testomenials -->              
<?php }
wp_register_sidebar_widget(
    'HG_TESTO',        // your unique widget id
    'Testomenials',          // widget name
    'hg_testo',  // callback function
    array(                  // options
        'description' => ''
    )
);
?>