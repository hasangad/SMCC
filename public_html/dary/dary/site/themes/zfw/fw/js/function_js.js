$(document).ready(function(){

/*-------------- Youtube Fancy box Iframe --------------------*/
  $('.youtube_input').each(function (i, obj) {

                   var str = $(this).val();
                   var embed = str.replace("watch\?v=", "embed/");
                   $v_id = str.replace("https://www.youtube.com/watch?v=", "");
                   //alert($v_id);
                   $(this).parent('div').parent('div').find(".youtube_thumb").on().show().html("<div><a data-fancybox data-type='iframe' data-src='https://www.youtube.com/embed/" + $v_id + "?autoplay=1' style='z-index:3; overflow:hidden;'><i class='fa fa-play-circle' style='Position: absolute; font-size:45px; left:34%; z-index:9; top:20%; opacity:0.6'></i><img src='https://i.ytimg.com/vi/" + $v_id + "/hqdefault.jpg' class='img-responsive'></a></div>");

               });
 //----------------go to top---------------------//
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });
 
        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
//-------------------------------------------------// 
$("#owl-demo").owlCarousel({
      navigation : false,
      slideSpeed : 300,
      paginationSpeed : 400,
	pagination:true,
      singleItem : true,
      autoPlay: true,
      // "singleItem:true" is a shortcut for:
      // items : 1,
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
      });

	  $(".owl-media").owlCarousel({
      navigation : false,
      slideSpeed : 300,
      paginationSpeed : 400,
	   autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 1,
	pagination:true,
      singleItem : true,
      autoPlay: true,
      // "singleItem:true" is a shortcut for:
      // items : 1,
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
      });
//------------------------//
		$("#owl-event").owlCarousel({

      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 4,
	  pagination:true,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]

  });

	$('.gallery a').each(function () {
    if ($(this).has('img')) {
        $(this).addClass("fancybox");
        $(this).attr('rel', 'fancybox');
        $(this).attr('data-fancybox', 'gallery');
    }

});

$('a[href$="pdf"]').addClass('ifram_pdf');
$('a[href$="pdf"]').attr('data-fancybox-type', 'iframe')


	$("a.fancybox").fancybox({
		'autoDimensions'	: true,
	'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600,
		'titlePosition' 		: 'inside',
		'onComplete'	:	function() {
		$("#fancybox-wrap").hover(function() {
			$("#fancybox-title").show();
		}, function() {
			$("#fancybox-title").hide();
		});
	},
		'speedOut'		:	200,
		'overlayShow'	:	false

	});


$(".ifram_pdf").fancybox({
    openEffect  : 'none',
    closeEffect : 'none',
    iframe : {
        preload: false
    }
});

 /*$(".ifram_pdf").click(function() {

		$.fancybox({
			/*'padding'		: 0,
			'autoScale'		: false,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'title'			: this.title,
		'width'		: 680,
			'height'		: 495,
			//'href':this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			'type': 'swf',
            'swf': {'wmode':'transparent','allowfullscreen':'true'}
		});

	return false;
	});*/



});
