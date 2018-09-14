<?php
get_header(); ?>
  <aside>
        	<div class="container">
 <div id="content" class="content search_page container" role="main">
<?php echo the_breadcrumb(); ?>
  <div class="col-lg-12 page-content no-bg">
                    <div class="title"><h2> <?php
					printf( __( 'قسم : %s', 'zfw' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h2></div>

<!--<h1 class="entry-title"><?php
					printf( __( 'قسم : %s', 'zfw' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h1>-->
<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) ){
						echo '<div class="archive-meta">' . $category_description . '</div>';
				get_template_part( 'loop', 'category' );
}?>
			 </div>
</div><!-- #content -->
           
            <?php //get_sidebar();?>
           
</div>
</div>
</aside>
<?php get_footer(); ?>
