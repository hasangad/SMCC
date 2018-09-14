<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>
<section class="about-block">
	<div class="container">
		<div class="row">
        
       <?php $wp_query = new WP_Query("order=DESC&post_type=about&post_status=publish&posts_per_page=1");
	/*echo $paged;*/ $i = 0; ?>
            <?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
            
            <div class="col-md-3">
				<div class="about-img">
					<a href="<?= get_permalink(); ?>"><img src="<?php thumb_it(); ?>" alt=""/> </a>
				</div><!--about-img-->
			</div><!--col-->
			<div class="col-md-9">
				<div class="about-text">
<h3> <?= get_the_title(); ?></h3>
<article><?= wp_trim_words(get_the_content(),' 44 ', ' ... ' ); ?></article>
			<a href="<?= get_permalink(); ?>">التفاصيل</a>
				</div><!--about-text-->
			</div><!--col-->
            
           
            </a>
            <?php  $i++; endwhile; 
        wp_reset_query();
         wp_reset_postdata(); ?>
        
			
		</div><!--row-->
	</div><!--container-->
</section><!--about-block-->
<section class="courses">
	<div class="container-fluid no-padding">
		<div class="row no-margin">
			<div class="col-md-6 no-padding">
				<div class="white">
					<div class="title-courses">
						<h2>الكورسات المجانية</h2>
					</div><!--title-courses-->
					<p class="title-p"><span>245 </span>كورس مجاني</p>
					<div class="image grid">
						<figure class="effect-layla">
							<img src="img/image.png" alt=""/>
							<figcaption>
								
								<a href="#">View more</a>
							</figcaption>			
						</figure>
					</div><!--image-->
					<div class="text">
						<article>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل "ألدوس بايج مايكر" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.
                        </article>
                        <a href="#" class="subscription">إشترك الآن</a>
					</div><!--text-->
				</div><!--white-->
			</div><!--col-->
			<div class="col-md-6 no-padding">
				<div class="gray">
					<div class="title-courses">
						<h2>الكورسات المتقدمة</h2>
					</div><!--title-courses-->
					<p class="title-p"><span>3205  </span>كورس متقدم</p>
					<div class="image grid">
						<figure class="effect-layla">
							<img src="img/image.png" alt=""/>
							<figcaption>
								
								<a href="#">View more</a>
							</figcaption>			
						</figure>
					</div><!--image-->
					<div class="text">
						<article>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل "ألدوس بايج مايكر" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.
                        </article>
                        <a href="#" class="subscription-black">إشترك الآن</a>
					</div><!--text-->
				</div><!--gray-->
			</div><!--col-->
		</div><!--row-->
	</div><!--container-->
</section><!--courses-->
<section class="team">
  <div class="container">
    <div class="row">
      <div class="title">
        <h1>تعرف على مدربينا</h1>
      </div>
      <!--title--> 
    </div>
    <!--row-->
    <div class="row ">
    	<div class="col-md-10 center-div">
          <div class="col-md-3">
        <div class="member-container">
          <div class="member-image"> <a href="#"><img src="img/member.png" alt=""/></a> </div>
          <!--member-image-->
          <div class="member-name"> <a href="#">أحمد سمير</a> </div>
          <!--member-name--> 
        </div>
        <!--member-container--> 
      </div> <!--col--> 
          <div class="col-md-3">
        <div class="member-container">
          <div class="member-image"> <a href="#"><img src="img/member.png" alt=""/></a> </div>
          <!--member-image-->
          <div class="member-name"> <a href="#">أحمد سمير</a> </div>
          <!--member-name--> 
        </div>
        <!--member-container--> 
      </div> <!--col--> 
          <div class="col-md-3">
        <div class="member-container">
          <div class="member-image"> <a href="#"><img src="img/member.png" alt=""/></a> </div>
          <!--member-image-->
          <div class="member-name"> <a href="#">أحمد سمير</a> </div>
          <!--member-name--> 
        </div>
        <!--member-container--> 
      </div> <!--col--> 
          <div class="col-md-3">
        <div class="member-container">
          <div class="member-image"> <a href="#"><img src="img/member.png" alt=""/></a> </div>
          <!--member-image-->
          <div class="member-name"> <a href="#">أحمد سمير</a> </div>
          <!--member-name--> 
        </div>
        <!--member-container--> 
      </div> <!--col--> 
          <div class="col-md-3">
        <div class="member-container">
          <div class="member-image"> <a href="#"><img src="img/member.png" alt=""/></a> </div>
          <!--member-image-->
          <div class="member-name"> <a href="#">أحمد سمير</a> </div>
          <!--member-name--> 
        </div>
        <!--member-container--> 
      </div> <!--col--> 
          <div class="col-md-3">
        <div class="member-container">
          <div class="member-image"> <a href="#"><img src="img/member.png" alt=""/></a> </div>
          <!--member-image-->
          <div class="member-name"> <a href="#">أحمد سمير</a> </div>
          <!--member-name--> 
        </div>
        <!--member-container--> 
      </div> <!--col--> 
          <div class="col-md-3">
        <div class="member-container">
          <div class="member-image"> <a href="#"><img src="img/member.png" alt=""/></a> </div>
          <!--member-image-->
          <div class="member-name"> <a href="#">أحمد سمير</a> </div>
          <!--member-name--> 
        </div>
        <!--member-container--> 
      </div> <!--col--> 
          <div class="col-md-3">
        <div class="member-container">
          <div class="member-image"> <a href="#"><img src="img/member.png" alt=""/></a> </div>
          <!--member-image-->
          <div class="member-name"> <a href="#">أحمد سمير</a> </div>
          <!--member-name--> 
        </div>
        <!--member-container--> 
      </div> <!--col--> 
        </div><!--col-->
    </div>
    <!--row--> 
  </div>
  <!--container--> 
</section>
<!--team-->
<section class="testmonial">
  <div class="title-area">
    <div class="container">
      <h1>قالوا</h1>
    </div>
    <!--container--> 
  </div>
  <!--title-area-->
  <div class="container">
    <div class="row">
    	<div class="col-md-8 center-div">
       <div id="owl-testmonial" class="owl-carousel">
           <div class="item">
           	  <div class="testmonial-container">
                 <article>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن إيبسوم.</article>
                 <h5>Yousif Kadir</h5>
              </div><!--testmonial-container-->
           </div><!--item-->
           <div class="item">
           	  <div class="testmonial-container">
                 <article>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن إيبسوم.</article>
                 <h5>Yousif Kadir</h5>
              </div><!--testmonial-container-->
           </div><!--item-->
           
           <div class="item">
           	  <div class="testmonial-container">
                 <article>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن إيبسوم.</article>
                 <h5>Yousif Kadir</h5>
              </div><!--testmonial-container-->
           </div><!--item-->
       </div><!--owl-testmonial-->    
       </div><!--col-->
    </div><!--row--> 
  </div>
  <!--container--> 
</section>
<!--testmonial-->
<?php get_footer(); ?>
