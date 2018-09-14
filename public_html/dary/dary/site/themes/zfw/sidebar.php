<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sidebar" <?php if(is_home()){?> style="margin-top:25px;"<?php }  ?>>
<div id="primary" class="widget-area" role="complementary">
  <ul class="xoxo">  </ul>
  <?php
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
  <li id="search" class="widget-container widget_search"> </li>
  <li id="archives" class="widget-container"> </li>
  <li id="meta" class="widget-container"> </li>
  <?php endif; // end primary widget area ?>
  </ul>
</div>
<!-- #primary .widget-area -->
<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>
<div id="secondary" class="widget-area" role="complementary">
  <ul class="xoxo">
    <?php dynamic_sidebar( 'secondary-widget-area' ); ?>
  </ul>
</div>
<?php endif; ?>     
              
                </div><!--col-->