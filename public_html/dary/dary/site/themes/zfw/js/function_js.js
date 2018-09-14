$(document).ready(function(){ 
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
  
	$('.content a').each(function () {
    if ($(this).has('img')) {
        $(this).addClass("fancybox");
		$(this).attr('rel', 'fancybox')
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
