<?php if ( ! have_posts() ) : ?>
	<div class="alert alert-warning">
		<h1 class="title"><?php _e( 'Not Found', 'zfw' ); ?></h1>
		<div class="alert alert-danger">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'zfw' ); ?></p>
		</div>
	</div>
<?php endif;
 while ( have_posts() ) : the_post();
 if (  is_search()) :
	search_result_is();
	endif;
	if ( is_archive()) :
		search_result_is();
		endif;
 endwhile;
  if (  $wp_query->max_num_pages > 1 ) :
		if (  $wp_query->max_num_pages > 1 ) :
			kriesi_pagination($pages = '', $range ='1' );
endif;
endif;
 ?>
