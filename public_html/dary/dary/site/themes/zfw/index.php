<?php get_header();



//slider_bs_one( "carousel-example-generic1", $slider_class, "slider", "3", "one_image_no_content" );

?>



<div class="col-xs-12 slider_1_holder">

  <div id="carousel-example-generic" class="carousel slide animated slideInUp" data-ride="carousel">

    <!-- Indicators -->



    <!-- Wrapper for slides -->

    <div class="carousel-inner" role="listbox">

      <?php $wp_query = new WP_Query("order=DESC&post_type=slider&post_status=publish&posts_per_page=6");

        $iii = 0; ?>

      <?php while ($wp_query->have_posts()) : $wp_query->the_post();?>

      <div class="item <?php if($iii == 0 ){ echo " active ";} ?>"> <img src="<?php thumb_it($width,$height,$crop); ?>" alt="...">

        <div class="carousel-caption right0xs">

          <h1>

            <?= get_the_title(); ?>

          </h1>

          <div class="readmoreslider"> <a href="<?= get_permalink(); ?>">

              <h4>اقرا المزيد <i class="fas fa-angle-double-left"></i></h4>

            </a> </div>

        </div>

      </div>

      <?php

		$iii++;

	endwhile;

        wp_reset_query();

        wp_reset_postdata(); ?>

    </div>

  </div>

</div>

<div class="col-xs-12 about">

  <div class="container">

    <div class="animated slideInDown"> <i class="fas fa-arrow-right " class="slider_arrow" href="#carousel-example-generic" role="button" data-slide="next"></i> <i class="fas fa-arrow-left" class="slider_arrow" href="#carousel-example-generic" role="button" data-slide="prev"></i>

      <div class="col-xs-12 slide_content">

        <div class="slideInUp animated">

          <div class="col-xs-12 col-sm-4">

            <?php $p = get_page(92) ;  ?>

            <div>

              <h2>

                <?= get_the_title(92); ?>

              </h2>

              <h3>

                <?= wp_trim_words($p->post_content,' 60 ', ' ... ' ); ?>

              </h3>

            </div>

          </div>

          <div class="col-xs-12 col-sm-8 img_container">

            <div style="background: url('<?= get_the_post_thumbnail_url( 92,'full' );  ?>')"> </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<div class="container services">

  <div class="animated slideInUp">

    <div class="col-xs-6">

      <h2>خدماتنا</h2>

    </div>

    <div class="col-xs-6 controles"> <i class="fas fa-arrow-left" href="#carousel-example-generic1" role="button" data-slide="prev"></i> <i class="fas fa-arrow-right" href="#carousel-example-generic1" role="button" data-slide="next"></i> </div>

    <div class="col-xs-12">

      <hr>

    </div>

    <div class="col-xs-12" style="  background: white">

      <div id="carousel-example-generic1" class="carousel slide" data-ride="carousel">



        <!-- Wrapper for slides -->

        <div class="carousel-inner" role="listbox">

          <?php $wp_query = new WP_Query("order=DESC&post_type=serv&post_status=publish&posts_per_page=9");

							$count = $wp_query->post_count;

        $i = 0; ?>

          <?php while ($wp_query->have_posts()) : $wp_query->the_post();?>

          <?php if(!is_float($i/3) || ($i == 0 ) ){if($i == 0){echo "<div class='item'>";} else {  echo "</div><div class='item'>";} } ?>

          <div class="col-xs-12 col-sm-4">

            <div style=""> <img src="<?php thumb_it($width,$height,$crop); ?>">

              <div class="col-xs-12"> <a href="<?= get_permalink(); ?>">

                <h3>

                  <?= get_the_title(); ?>

                </h3>

                </a>

                <h5>

                  <?= wp_trim_words(get_the_content(),' 12 ', ' ... ' ); ?>

                </h5>

              </div>

            </div>

          </div>

          <?php if($count === $i) {   echo "</div>";} else { $i++; }

							endwhile;

        wp_reset_query();

        wp_reset_postdata(); ?>

        </div>

      </div>

    </div>

  </div>

</div>

</div>

<div class="col-xs-12 projects">

  <div class="row">

    <div class="col-xs-12">

      <?php $wp_query = new WP_Query("order=DESC&post_type=projects&post_status=publish&posts_per_page=1");

							$count = $wp_query->post_count;

        $i = 1; ?>

      <?php while ($wp_query->have_posts()) : $wp_query->the_post();?>

      <div class="container">

        <h2>

          <?= get_the_title(); ?>

        </h2>

        <p>

          <?= wp_trim_words(get_the_content(),' 120 ', ' ... ' ); ?>

        </p>

        <a href="<?= get_permalink(); ?>" class="more_me">االمزيد</a> </div>

      <?php

			endwhile;

			wp_reset_query();

			wp_reset_postdata();

			?>

    </div>

  </div>

</div>

<div class="col-xs-12 news_area">

  <div class="col-xs-12 col-sm-4">

    <div> <img src="<? echo get_template_directory_uri(); ?>/fw/images/7.jpg" class="news_img animated slideInRight"> </div>

  </div>

  <div class="col-xs-12 col-sm-4">

    <div style=" position: relative;  height: 400px" class="animated slideInUp"> <img src="<? echo get_template_directory_uri(); ?>/fw/images/sub-logo.png" class="sub_logo">

      <div class="news_content">

        <div class="col-xs-12">

          <h2>أخبار داري العالمية</h2>

          <div>

            <?php $wp_query = new WP_Query("order=DESC&post_type=news&post_status=publish&posts_per_page=3");

							$count = $wp_query->post_count;

        $i = 1; ?>

            <?php while ($wp_query->have_posts()) : $wp_query->the_post();?>

            <a href="<?= get_permalink(); ?>">

            <h4>

              <?= get_the_title(); ?>

            </h4>

            </a>

            <h5>

              <?= wp_trim_words(get_the_content(),' 18 ', ' ... ' ); ?>

            </h5>

            <div class="col-xs-12">

              <hr>

            </div>

            <?php

						endwhile;

						wp_reset_query();

						wp_reset_postdata();

						?>

            <a href="<?= get_site_url(); ?>/news" class="more_news">المزيد </a> </div>

        </div>

      </div>

    </div>

  </div>

  <div class="col-xs-12 col-sm-4">

    <div> <img src="<? echo get_template_directory_uri(); ?>/fw/images/8.jpg" class="news_img animated slideInLeft"> </div>

  </div>

</div>

<?php get_footer(); ?>

