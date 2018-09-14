<?php
// Add New Page Class
		class Add_page{
		function page($page_name,$template,$guid){
		 $my_post = array(
			 'post_title'    => $page_name,
			 'post_name'    => $guid,
  'post_content'  => '',
  'post_type'  => 'page',
  'post_status'   => 'publish',
  'post_author'   => 1,
  'ping_status'           => get_option('default_ping_status'),
  'post_parent'           => 0,
  'menu_order'            => 0,
  'to_ping'               =>  '',
  'pinged'                => '',
  'post_password'         => '',
  'guid'                  => $guid,
  'post_content_filtered' => '',
  'post_excerpt'          => '',
  'import_id'             => 0
  //'post_category' => array(8,39)
);
if (!get_page_by_title($page_name, 'OBJECT', 'page') ){
  $post_id = wp_insert_post( $my_post, $wp_error );
  update_post_meta($post_id, '_wp_page_template' , $template);
	   	}
		}
	}

	$addPage = new Add_page;

	$addPage->page("النشرة البريدية",'templates/newsletter.php','NewsLetter');
/*----------------------------------------*/
function zfw_date_time() {
	echo '<span class="col-lg-6 no-padding"><i class="fa fa-calendar"></i> &nbsp;' . get_the_date() . '</span><span class="col-lg-6 no-padding pull-left"><i class="fa fa-clock"></i> &nbsp; ' . esc_attr( get_the_time() ) . "</span>";
}
/*------------------------------------*/
function get_field( $id, $field ) {

	$filed_value = get_post_meta( $id, $field, true );

	return $filed_value;
}

/*---------- Social links ----------*/

function social_links( $name,$email_on ) {
	?>
	<ul class="<?php echo $name; ?>">
		<?php  $wp_query = new WP_Query("order=DESC&post_type=social&posts_per_page=1");  ?>
		<?php while ($wp_query->have_posts()) : $wp_query->the_post(); $id = get_the_id();?>
		<? if(get_field($id,'_facebook')){ ?>
		<li><a href="<?= get_field($id,'_facebook'); ?>" target="new" title=""><i class="fab  fa-facebook-f"></i></a>
		</li>
		<? } ?>
		<? if(get_field($id,'_twitter')){ ?>
		<li><a href="<?= get_field($id,'_twitter'); ?>" target="new" title=""><i class="fab  fa-twitter"></i></a>
		</li>
		<? } ?>
		<? if(get_field($id,'_youtube')){ ?>
		<li><a href="<?= get_field($id,'_youtube'); ?>" target="new" title=""><i class="fab  fa-youtube"></i></a>
		</li>
		<? } ?>
		<? if(get_field($id,'_linkedin')){ ?>
		<li><a href="<?= get_field($id,'_linkedin'); ?>" target="new" title=""><i class="fab  fa-linkedin"></i></a>
		</li>
		<? }

if($email_on == "yes"){ ?>
	<li><a href="mailto:<?= get_field($id,'_email'); ?>" target="new" title=""><i class="fa fa-envelope"></i></a>
	</li>

<? }
		 ?>
		<?  endwhile;
        wp_reset_query();
         wp_reset_postdata(); ?>
	</ul>
	<?
} /* End of social links */
/*------------------------views --------------------------*/
/*----------------- Results ---------------------*/

// R = right -- i = img -- c = Content
function result_view_r_i_c() {
	?>

	<div class="result_is col-lg-6 col-md-6 col-sm-12 col-xs-12 radius-10">
		<a href="<?php the_permalink(); ?>" class="col-lg-4 col-md-4 col-sm-12 col-xs-12 no-padding">
 <img src="<?php thumb_it(200,160,true); ?>" class="img-responsive2 radius-10" width="" height=""title="" alt=""/>
 </a>

		<div id="post-<?php the_ID(); ?>" class="data col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<h4> <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo wp_trim_words(get_the_title(),'6','...'); ?></a></h4>
			<div class="date-time col-lg-12 no-padding">
				<?php zfw_date_time(); ?>
			</div>
			<p>
				<?php   echo wp_trim_words(get_the_content(),5, '... '); ?>
			</p>
		</div>
	</div>

	<?php
}

/*--------------- About Home Page --------------------*/

class AbouthomePage
{
    // property declaration
		//public $var = 'a default value';
		//public $p = get_page($p_id) ;
		//public $p_title =$p->post_title;
		//public $p_content =  wp_trim_words($p->post_content,$trim_count, ' ... ' );
    // method declaration
    public function p_title($p_id) {
        //echo $this->var;
				//echo $this->p_title = get_the_title($p_id);
				echo  get_the_title($p_id);
    }

		public function p_content($p_id,$trim_count) {
        //echo $this->var;
				$my_postid = $p_id;//This is page id or post id
$content_post = get_post($my_postid);
$content = $content_post->post_content;
				echo wp_trim_words($content,$trim_count, ' ... ' );
    }

		public function p_thumb($p_id,$thumb_size) {
        //echo $this->var;
				echo get_the_post_thumbnail_url( $p_id,$thumb_size );
    }

	public function p_link($p_id) {
        //echo $this->var;
				echo get_permalink( $p_id);
    }


};


/*----------------- Slider Types -------------------------*/

/*------ BootStrap One image ------------------*/

function slider_bs_one( $slider_id, $slider_class, $post_type, $slides, $view_style ) {
	?>
	<div class="col-xs-12 animated slideInUp no-padding" id="div_5e79_9">
		<div id="<?= $slider_id; ?>" class="<?= $slider_class; ?> carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators" id="ol_5e79_0">
				<?php
$wp_query_count = new WP_Query("order=DESC&post_type=$post_type&post_status=publish&posts_per_page=$slides");
 $slides_count = $wp_query_count->post_count;

				$slides_reset = 1 ;
for ($x = 0; $x < $slides_count; $x++) {
				  if($slides_reset = 0) {  ?>
				<li data-target="<?= $slider_id; ?>" data-slide-to="<?= $x; ?>" class="active" id="li_5e79_0"></li>
			<?php } else { ?>
				<li data-target="<?= $slider_id; ?>" data-slide-to="<?= $x; ?>" id="li_5e79_1"></li> <?php }
$slides_reset++;
}
				 ?>
			</ol>
			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<?php $wp_query = new WP_Query("order=DESC&post_type=$post_type&post_status=publish&posts_per_page=$slides");
        $i = 0;
		while ($wp_query->have_posts()) : $wp_query->the_post();
		$view_style($i);
	$i++;
	endwhile;
        wp_reset_query();
        wp_reset_postdata();?>
				<a class="left carousel-control" href="#<?= $slider_id; ?>" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>

				<a class="right carousel-control" href="#<?= $slider_id; ?>" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>


			</div>
		</div>
	</div>


	<?php
}


function slider_bs_3_thumbs( $slider_id, $slider_class, $post_type, $slides, $offset, $view_style ) {
	?>
	<div class="col-xs-12 animated slideInUp slide_thumb_area" id="div_d349_9">

		<div id="<?= $slider_id; ?>" class="carousel slide" data-ride="carousel" style="">

			<!-- Indicators -->


			<!-- Wrapper for slides -->

			<div class="carousel-inner" role="listbox" id="div_d349_10">
				<?php $wp_query = new WP_Query("order=DESC&post_type=$post_type&post_status=publish&posts_per_page=$slides&offset=$offset");
$p_count =  $wp_query->post_count;
$i = 100;
$r = 1;
				while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

				<?php if($i == 100){ $i = 0; echo '<div class="item  active">'; } ?>

										<a href="<?= get_permalink(); ?>">

											<div class="col-xs-12 col-sm-4 carousel-poiner">

												<div class="col-xs-5" id="div_d349_11">

													<img src="<?php thumb_it("","",""); ?>" id="img_d349_4">

												</div>

												<div class="col-xs-7" id="div_d349_12">

													<h4 id="h4_d349_6"><?=  get_the_title(); ?></h4>

												</div>

											</div>

										</a>


										<?php if((($i == 3) && ($r !== $p_count)) || (($i == 6) && ($r !== $p_count))){ echo '</div><div class="item">';}elseif($r == $p_count){echo '</div>';} ?>


				<?php $i++;  $r++;
				endwhile;
				wp_reset_query();
				wp_reset_postdata();?>



			</div>



			<!-- Controls -->

			<a class="left carousel-control" href="#<?= $slider_id; ?>" role="button" data-slide="prev" id="a_d349_13">

				<span id="span_d349_0">

					<span class="fas fa-arrow-right" aria-hidden="true" id="span_d349_1"></span>

				</span>

				<span class="sr-only">Previous</span>

			</a>

			<a class="right carousel-control" href="#<?= $slider_id; ?>" role="button" data-slide="next" id="a_d349_14">

				<span id="span_d349_2">

					<span class="fas fa-arrow-left" aria-hidden="true" id="span_d349_3"></span>

				</span>

				<span class="sr-only">Next</span>

			</a>

		</div>

	</div>
<?php }

/*------------------ Slider View ------------------------*/

function one_image_no_content( $i ) {
	?>
	<div class="item <?php if($i == 0){ echo " active ";} ?>">
		<img src="<?php thumb_it($width,$height,$crop); ?>" class="img-responsive slider_img" alt="..." id="">
	</div>

	<?php
}


function one_image_content( $i ) {
	?>
	<div class="item <?php if($i == 0){ echo " active ";} ?>">
		<img src="<?php thumb_it($width,$height,$crop); ?>" class="img-responsive slider_img" alt="..." id="">
		<div class="get-elements-top" id="div_7ecb_16">

			<h1 id="h1_7ecb_0" class="h2onxs ">
				<?= wp_trim_words(get_the_title(),10, ' ... ' ); ?>
			</h1>

			<h4 id="h4_7ecb_0">
				<?= wp_trim_words(get_the_content(),10,' ... '); ?>
			</h4>

			<div id="div_7ecb_17">

				<div id="div_7ecb_18" class="reamorenoew">

					<h4 id="h4_7ecb_1"><a href="<?= get_permalink(); ?>">إقرا المزيد</a></h4>

				</div>



			</div>

		</div>
	</div>

	<?php
}


function one_image_content_Qudorat( $i ) {
	?>
	<div class="item <?php if($i == 0){ echo " active ";} ?>">


						<div id="div_3caf_0"></div>
						<img src="<?php thumb_it($width,$height,$crop); ?>" alt="..." id="img_3caf_1">
						<div class="carousel-caption right0xs" id="div_3caf_1">

							<h1 id="h1_3caf_0"><?= get_the_title(); ?></h1>
							<h2 id="h2_3caf_0"><?= wp_trim_words(get_the_content(),10,' ... '); ?></h2>
							<div id="div_3caf_2" class="readmoreslider">
								<div class="col-xs-8">
									<h4 id="h4_3caf_0">
										<a href="<?= get_permalink(); ?>" id="a_3caf_12">اقرا المزيد</a>
									</h4>
								</div>
								<div id="div_3caf_3" class="col-xs-4 text-center">
									<i class="fas fa-angle-double-left readmore" id="i_3caf_4"></i>
								</div>
							</div>
						</div>


	</div>

	<?php
}


function one_image_content_TESTO( $i ) {
	?>
	<div class="item <?php if($i == 0){ echo " active ";} ?>">

    									<div class="col-xs-12" id="div_3caf_75">
										<div id="div_3caf_76">
											<div class="col-xs-5 col-sm-4 col-md-3  text-center" id="div_3caf_77">
												<div id="div_3caf_78" style="background-image:url(<?php thumb_it($width,$height,$crop); ?>);"></div>
											</div>
											<div class="col-xs-7 col-sm-7 col-md-9" id="div_3caf_79">
												<div id="div_3caf_80"><?= wp_trim_words(get_the_content(),10,' ... '); ?></div>
											</div>
											<div class="col-xs-12">
												<div id="div_3caf_81">
													<div class="col-xs-6">
														<h5 id="h5_3caf_0"><?= get_field('speaker'); ?></h5>
														<h5 id="h5_3caf_1"><?= get_field('speaker_job'); ?></h5>
													</div>
													<div class="col-xs-6" id="div_3caf_82">
														<!-- Controls -->
														<div id="div_3caf_83" class="text-center" href="#carousel-example-generic2" role="button" data-slide="next">
															<i class="fas fa-angle-left " id="i_3caf_8"></i>
														</div>
														<div id="div_3caf_84" class="text-center    " href="#carousel-example-generic2" role="button" data-slide="prev">
															<i class="fas fa-angle-right " id="i_3caf_9"></i>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>

                                    </div>


	<?php
}



function one_image_content_PERSONAL( $i ) {
	?>
    <div class="item <?php if($i == 0){ echo " active ";} ?>" style="background-image:url('<?php thumb_it($width,$height,$crop); ?>')">



						<div class="carousel-caption">

							<h3 id="h3_5bf3_0"><?= get_the_content(); ?></h3>

							<h4 id="h4_5bf3_6"><?= get_the_title(); ?></h4>



						</div>

					</div>

	<?php
}

function one_image_content_academy( $i ) { ?>
	<div class="item <?php if($i == 0){ echo " active ";} ?>">
		<img src="<?php thumb_it($width,$height,$crop); ?>" alt="..." id="img_f54f_1">
		<div class="carousel-caption right0xs" id="div_f54f_7">
			<h1 id="h1_f54f_1"><?= get_the_title(); ?></h1>
            <a id="h4_f54f_1" href="<?= get_permalink(); ?>">اقرا المزيد  &nbsp; <i class="fas fa-chevron-left" id="i_f54f_8"></i></a>
		</div>
	</div>
<?php }


function one_image_content_big_readmore( $i ) {
	?>
	<div class="item <?php if($i == 0){ echo " active ";} ?>">

			<img src="<?php thumb_it($width,$height,$crop); ?>" class="img-responsive2" alt="...">

			<div class="carousel-caption  right0xs row">

				<h1 id="h1_d349_0"><?= get_the_title(); ?></h1>

				<h4 id="h4_d349_0"><?= wp_trim_words(get_the_content,'12',' ... '); ?></h4>

				<div id="div_d349_1" class="readmoreslider borderradius0hover">

					<a href="<?= get_permalink(); ?>" id="a_d349_10" class="">

						<div class="col-xs-8">

							<h4 id="h4_d349_1">اقرا المزيد</h4>

						</div>

						<div id="div_d349_2" class="col-xs-4 text-center">

							<i class="fas fa-angle-double-left readmore" id="i_d349_0"></i>



						</div>

					</a>

				</div>

			</div>

			<div class="shodw_bottom"></div>


	</div>

	<?php
}


function one_image_content_zgroup( $i ) {
	?>
<div class="item <?php if( $i == 0) { echo "active"; } ?>">


	<img src="<?php thumb_it($width,$height,$crop); ?>" alt="..." id="img_9ff7_1" class="">


	<div id="div_9ff7_24">



		<h1 id="h1_9ff7_0" class="borderr0xs"><?= get_the_title(); ?></h1>



		<p id="p_9ff7_0" class="borderr0xs"><?= wp_trim_words(get_the_content(),'20',' ... '); ?></p>

	</div>

</div>

<?php }

/*---------------- OWL slider -------------------*/

function owl_slider_base($slider_id, $slider_class, $post_type, $slides, $view_style){ ?>
	<div class="col-xs-12 <?= $slider_class; ?>" id="div_6b1f_25">
		 <div id="owl-demo" class="owl-carousel">
			 <?php $wp_query = new WP_Query("order=DESC&post_type=$post_type&post_status=publish&posts_per_page=$slides");
		 	$i = 0;
			 while ($wp_query->have_posts()) : $wp_query->the_post();
			$view_style($i);
		 endwhile;
		 	wp_reset_query();
		 	wp_reset_postdata(); ?>
		 </div>
				<div class="slider_bottom_grad"></div>
			</div>
<?php }

/*---------------------------------------------------*/

function search_result_is() {
	result_view_r_i_c();
}


function search_result_is_col( $col ) {
	?>
	<div class="result_is col-lg-<?= $col; ?> col-md-<?= $col; ?> col-sm-12 col-xs-12">
		<a href="<?php the_permalink(); ?>" class="col-lg-4 col-md-4 col-sm-12 col-xs-12 no-padding">
 <img src="<?php thumb_it(200,160,true); ?>" class="img-responsive2 radius-10" width="" height=""title="" alt=""/>
 </a>

		<div id="post-<?php the_ID(); ?>" class="data col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<h4> <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo wp_trim_words(get_the_title(),'8','...'); ?></a></h4>
			<div class="date-time col-lg-12 no-padding">
				<?php zfw_date_time(); ?>
			</div>
			<p>
				<?php   echo wp_trim_words(get_the_content(),16, '... '); ?>
			</p>
		</div>
	</div>
	<?
}


function result_cards( $col ) {
	?>
	<div class="result_is result_cards col-lg-<?= $col; ?> col-md-<?= $col; ?> col-sm-6 col-xs-12">
		<a href="<?php the_permalink(); ?>" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
 <img src="<?php thumb_it(200,160,true); ?>" class="img-responsive2 radius-10" width="" height=""title="" alt=""/>
 </a>

		<div id="post-<?php the_ID(); ?>" class="data col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h4> <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo wp_trim_words(get_the_title(),'8','...'); ?></a></h4>
			<div class="date-time col-lg-12 no-padding">
				<?php zfw_date_time(); ?>
			</div>
			<p>
				<?php echo wp_trim_words(get_the_content(),16, '... '); ?>
			</p>
		</div>
	</div>
	<?
}


function get_a_contact($contact_name){
 $wp_query = new WP_Query("order=ASC&post_type=contact&posts_per_page=1&offset=0");
		while ($wp_query->have_posts()) : $wp_query->the_post();

		 if(get_post_meta(get_the_id(),"$contact_name",true)){

			 echo  get_post_meta(get_the_id(),"$contact_name",true);

			   }
	endwhile;
	   wp_reset_query();
	  wp_reset_postdata();
}


function header_contacts(){
 $wp_query = new WP_Query("order=ASC&post_type=contact&posts_per_page=1&offset=0"); // NOTICE :: Double qoutation are a magic word in wp_query ~HG  ?>

	        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>


						<?php if(get_post_meta(get_the_id(),'_phone',true)){?>

							<div class="col-lg-3 col-md-3 col-sm-12 col-sx-12">
									<a>
									<span class="fas fa-phone rotate360"></span>
									<span><?= get_post_meta(get_the_id(),'_phone',true); ?></span>
									</a></div><?php } ?>



						 <?php if(get_post_meta(get_the_id(),'_Email',true)){?>
							 <div class="col-lg-3">
							<a href="mailto:<?= get_post_meta(get_the_id(),'_Email',true); ?>">
										<span class="far fa-envelope rotate360"></span>
										<span><?= get_post_meta(get_the_id(),'_Email',true); ?></span>
									</a></div><?php } ?>

						<div class="col-lg-3">
								<a><span></span><span>@<?= get_the_content(); ?></span></a>
								</div>

	  <?php


	endwhile;


	   wp_reset_query();



	  wp_reset_postdata();
	   ?>



<?php }

function footer_contacts_charity(){ ?>

	<?php $wp_query = new WP_Query("order=ASC&post_type=contact&posts_per_page=1&offset=0"); // NOTICE :: Double qoutation are a magic word in wp_query ~HG  ?>

	        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

								<h1 id="h1_d349_10"><?= get_the_title(); ?></h1>

								<div class="col-xs-12">


									<div class="col-xs-12 col-sm-4 text-center" id="div_d349_54">

										<i class="fas fa-map-marker-alt" id="i_d349_3"></i>

										<h3 id="h3_d349_4">

											العنوان</h3>

										<h4 id="h4_d349_25"><?= get_post_meta(get_the_id(),'_address',true); ?></h4>

									</div>




									<div class="col-xs-12 col-sm-4 text-center" id="div_d349_55">

										<i class="fas fas fa-phone-volume" id="i_d349_4"></i>

										<h3 id="h3_d349_5">

											الهاتف</h3>

										<h4 id="h4_d349_26">

											<?= get_post_meta(get_the_id(),'_phone',true); ?></h4>

									</div>

									<div class="col-xs-12 col-sm-4 text-center" id="div_d349_56">

										<i class="far fa-envelope" id="i_d349_5"></i>

										<h3 id="h3_d349_6">

											البريد الالكتروني

										</h3>

										<h4 id="h4_d349_27"><?= get_post_meta(get_the_id(),'_email',true); ?></h4>

									</div>

								</div>


	  <?php


	endwhile;


	   wp_reset_query();



	  wp_reset_postdata();
	   ?>





<?php }

/*---------------- news letter --------------*/

function activate_email($email_is){
return $activate_email_link = '<a href="'.get_site_url()."/newsletter/?activate_email=".$email_is.'">إضغط هنا </a>';
}

function unsubscribe_email($email_is){
return $unsubscribe_email_link = '<a href="'.get_site_url()."/NewsLetter/?unsubscribe_email=".$email_is.'">إضغط هنا </a>';
}

function newsletter(){

	$sitename = strtolower( $_SERVER[ 'SERVER_NAME' ] );
	if ( substr( $sitename, 0, 4 ) == 'www.' ) {
		$sitename = substr( $sitename, 4 );
	}
	/* end of code lifted from wordpress core */
	$myfront = "no-reply@";
	$myback = $sitename;
	$no_reply = $myfront . $myback;
	//return $myfrom;

	//$no_reply = wp_mail_from('no-reply');
	$headers_no_reply = 'From:  no-reply <'.$no_reply.'>';

if($_GET['u_email']){

$subscrib_email = $_GET['u_email'];


$wp_query = new WP_Query("order=DESC&post_type=nletter_users&post_status=publish&posts_per_page=1");

while ($wp_query->have_posts()) : $wp_query->the_post();

$p_id = get_the_id();

 $nletter_users = get_post_meta($p_id,'nletter_users',true);
 //print_r($nletter_users );

if(empty($nletter_users)) {
//array_push($a,"blue","yellow");
$nletter_users = array($subscrib_email => "no");
$nletter_users[$subscrib_email] = "no";
 $update_nletter_users = update_post_meta($p_id ,"nletter_users",$nletter_users );
if($update_nletter_users) { echo '<div class="alert alert-success nletter-alerts">تم التسجيل بنجاح ، برجاء مراجعة بريدك الإلكتروني للتأكيد .<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>'; }
//print_r($nletter_users);


} else {
	/*$nletter_users = array_push(
		$nletter_users,
		$subscrib_email => "no"
	);*/

	if (array_key_exists($subscrib_email, $nletter_users)) {
		//echo $nletter_users[$subscrib_email];
		if($nletter_users[$subscrib_email] == "removed") {
	//	echo $p_id . $nletter_users[$subscrib_email];
			$nletter_users_updated = $nletter_users;
			$nletter_users_updated[$subscrib_email] = "no";
			 $update_nletter_users = update_post_meta($p_id ,"nletter_users",$nletter_users_updated,$nletter_users);
			if($update_nletter_users){
			echo '<div class="alert alert-success nletter-alerts">تم التسجيل بنجاح ، برجاء مراجعة بريدك الإلكتروني للتأكيد .<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button></div>';
				$headers_3 = array('Content-Type: text/html; charset=UTF-8');
				$headers_3[] = $headers_no_reply;

	 		 $subscrib_email_body = "شكراً لتسجيلك في نشرتنا البريدية ، من فضلك إضغط على الرابط التالي لتأكيد بريدك الإلكتروني : " . activate_email($subscrib_email) . "<br />" ."<em>يمكنكم إلغاء اشتراككم من خلال الرابط " .unsubscribe_email($subscrib_email)  . " </em>" ;
	 		 wp_mail($subscrib_email, "قم بتأكيد بريدك الإكتروني" , $subscrib_email_body , $headers_3 );
		 }
		} elseif($nletter_users[$subscrib_email] = "yes") {
	    echo '<div class="alert alert-warning nletter-alerts">البريد الإلكتروني مسجل من قبل.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>'; }
} else {

	$nletter_users[$subscrib_email] = "no";
	  $update_nletter_users = update_post_meta($p_id ,"nletter_users",$nletter_users );
	 /*$my_post = array(
      'ID'           => $p_id,
      'post_title'   => get_the_title(),
      'post_content' => $nletter_users,
  );
  wp_update_post( $my_post );*/
	 if($update_nletter_users) { echo '<div class="alert alert-success nletter-alerts">تم التسجيل بنجاح ، برجاء مراجعة بريدك الإلكتروني للتأكيد . <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';

		 $headers_3 = array('Content-Type: text/html; charset=UTF-8');
		 $headers_3[] = $headers_no_reply;

		 $subscrib_email_body = "شكراً لتسجيلك في نشرتنا البريدية ، من فضلك إضغط على الرابط التالي لتأكيد بريدك الإلكتروني : " . activate_email($subscrib_email) . "<br />" ."<em>يمكنكم إلغاء اشتراككم من خلال الرابط " .unsubscribe_email($subscrib_email)  . " </em>" ;
		 wp_mail($subscrib_email, "قم بتأكيد بريدك الإكتروني" , $subscrib_email_body , $headers_3 );
}
	  }

 }
endwhile;
wp_reset_query();
wp_reset_postdata();
}

/*----------- End of subscrib email ---------------*/


if($_GET['activate_email']){

$activate_email  = $_GET['activate_email'];

	$wp_query = new WP_Query("order=DESC&post_type=nletter_users&post_status=publish&posts_per_page=1");

	while ($wp_query->have_posts()) : $wp_query->the_post();

	$p_id = get_the_id();

	  $nletter_users = get_post_meta($p_id,'nletter_users',true);

		if (array_key_exists($activate_email, $nletter_users)) {

if(($nletter_users[$activate_email] == "no") || ($nletter_users[$activate_email] == "removed")) {
		$nletter_users[$activate_email] = "yes";
		 $update_nletter_users = update_post_meta($p_id ,"nletter_users",$nletter_users );
		 if($update_nletter_users) { echo '<div class="alert alert-success nletter-alerts">تم تفعيل بريدك الإلكتروني بنجاح <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
			 $headers_3 = array('Content-Type: text/html; charset=UTF-8');
			 $headers_3[] = $headers_no_reply;

			 $subscrib_email_body = '  شكراً لك ، تم تأكيدك بريدك الإلكتروني بنجاح .<br /><em>يمكنكم إلغاء اشتراككم من خلال الرابط ' . unsubscribe_email($activate_email)  . '</em>' ;
			 wp_mail($activate_email, " تم تأكيد بريدك بنجاح " , $subscrib_email_body , $headers_3 ); }
	 } else { echo '<div class="alert alert-success nletter-alerts nletter-alerts">البريد الإلكتروني مفعل من قبل . <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>'; }

		 }

	endwhile;
	wp_reset_query();
	wp_reset_postdata();

}



/*----------------- Unsubscribe email -------------*/


if($_GET['unsubscribe_email']){

$activate_email  = $_GET['unsubscribe_email'];

	$wp_query = new WP_Query("order=DESC&post_type=nletter_users&post_status=publish&posts_per_page=1");

	while ($wp_query->have_posts()) : $wp_query->the_post();

	$p_id = get_the_id();

	  $nletter_users = get_post_meta($p_id,'nletter_users',true);

//print_r($nletter_users );

		if (array_key_exists($activate_email, $nletter_users)) {

if($nletter_users[$activate_email] == "yes") {
		$nletter_users[$activate_email] = "removed";
		 $update_nletter_users = update_post_meta($p_id ,"nletter_users",$nletter_users );
		 if($update_nletter_users) { echo '<div class="alert alert-success nletter-alerts"> تم الغاء اشتراكك بنجاح <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
			 $headers_3 = array('Content-Type: text/html; charset=UTF-8');
			 $headers_3[] = $headers_no_reply;
			 $subscrib_email_body = " تم إلغاء اشتراكك بنجاح  ";
			 wp_mail($activate_email, " تم الغاء اشتراكك بنجاح " , $subscrib_email_body , $headers_3 ); }
	 } else { echo '<div class="alert alert-success nletter-alerts nletter-alerts">البريد الإلكتروني غير مفعل   . <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>'; }

		 }

	endwhile;
	wp_reset_query();
	wp_reset_postdata();

}

}
