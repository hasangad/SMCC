<?php get_header(); ?>
<div id="full_container">
        <div id="content" role="main">
            <?php //the_breadcrumb(); ?>
        
			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e( 'Not Found', 'zfw' ); ?></h1>
                
                <div id="error4" >
                
                </div><!-- End of 404 -->
				<div class="entry-content">
					<p class="failed"><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'zfw' ); ?></p>
					<?php //get_search_form(); ?>
				</div><!-- .entry-content -->
			</div><!-- #post-0 -->
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>
    
</div><!-- #content -->
  <?php //get_sidebar(); ?>
 </div>
<?php get_footer(); ?>