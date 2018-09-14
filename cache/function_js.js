$(document)
	.ready(function() {
		/* ---- Form validating ----------*/
		$("input[name='سنوات الخبرة']")
			.on("keyup", function(e) {
				$FieldVal = $("input[name='سنوات الخبرة']")
					.val();
				$fieldLength = $FieldVal.length;
				if ($fieldLength > 2) {
					//alert($FieldVal);
					val = $FieldVal.slice(0, 2);
					//alert(val);
					$(this)
						.val(val);
				}
			});
		/*----------------------------------------------------*/
		function field_validation($field_type, $message) {
			$($field_type)
				.on('change invalid', function() {
					var textfield = $(this)
						.get(0);
					// 'setCustomValidity not only sets the message, but also marks
					// the field as invalid. In order to see whether the field really is
					// invalid, we have to remove the message first
					textfield.setCustomValidity('');
					if (!textfield.validity.valid) {
						textfield.setCustomValidity($message);
					}
				});
		}
		field_validation('input[type=text]', 'استخدم حروف ومسافات فقط مع هذا الحقل ');
		field_validation('input[name=captcha]', 'اكتب مجموع الرقمين السابقين');
		field_validation('textarea', 'هذا الحقل مطلوب');
		field_validation('input[type=dateCustom]', 'حدد التاريخ');
		field_validation('input[type=number]', 'هذا الحقل مطلوب');
		field_validation('input[type=file]', 'هذا الحقل مطلوب');
		field_validation('input[name="سنوات الخبرة"]', 'الحفل مطلوب ، الرقم لا يزيد عن 50');
		field_validation('select', 'هذا الحقل مطلوب ، من فضلك اختر عنصر من القائمة ');
		field_validation('input[type=email]', 'تأكد من صيغة البريد الإلكتروني');
		field_validation('input[type=tel]', 'هذا الحقل يدعم أرقام فقط و أن لا تزيد عن 16رقم ويفضل الصيغه 096605 ');
		//binds to onchange event of your input field
		$('input[type="file"]')
			.bind('change', function() {
				//alert('changed');
				var ext = $('input[type="file"]')
					.val()
					.split('.')
					.pop()
					.toLowerCase();
				if ($.inArray(ext, ['pdf', 'jpeg', 'jpg', 'docx', 'docs']) == -1) {
					alert('ملف غير مدعوم');
					$(this)
						.val('');
				}
				if (this.files[0].size > 5000000) {
					//alert("حجم الملف المرفق " + this.files[0].size + " أكبر من 5 MB");
					alert("حجم الملف المرفق  أكبر من 5 MB");
					$(this)
						.val('');
				}
			});
		$('input[name="captcha"]')
			.on('blur', function() {
				//alert('captcha');
				//alert($('input[name="rand_sum"]').val());
				if ($('input[name="captcha"]')
					.val() !== $('input[name="rand_sum"]')
					.val()) {
					alert("كود التحقق غر صحيح !");
					var rand_1 = Math.floor((Math.random() * 10) + 1);
					var rand_2 = Math.floor((Math.random() * 10) + 1);
					$('.sum_is')
						.html(rand_1 + " + " + rand_2);
					var sum_rands = rand_1 + rand_2;
					$('input[name="rand_sum"]')
						.val(sum_rands);
					$('input[name="captcha"]')
						.val('');
				}
			});
		/*function alphaOnly(event) {
			var key = event.keyCode;
			return ((key >= 65 && key <= 90) || key == 8);
		};*/
		function onlyAlphabets() {
			var regex = /^[a-zA-Z]*$/;
			if (regex.test(document.f.nm.value)) {
				//document.getElementById("notification").innerHTML = "Watching.. Everything is Alphabet now";
				return true;
			} else {
				document.getElementById("notification")
					.innerHTML = "Alphabets Only";
				return false;
			}
		}
		document.querySelectorAll('a[href^="#"]')
			.forEach(anchor => {
				anchor.addEventListener('click', function(e) {
					e.preventDefault();
					document.querySelector(this.getAttribute('href'))
						.scrollIntoView({
							behavior: 'smooth'
						});
				});
			});
		/*	jQuery('.add_more_cfz_filed').click(function(){

alert('Clicked');

});*/
		$(".carousel .item")
			.first()
			.addClass("active");
		/*----------------- Bootstrap AutoSlider --------------------*/
		$(function() {
			$('.carousel')
				.carousel({
					interval: 3500,
					pause: true
				});
			$('.carousel')
				.hover(function() {
					$(this)
						.carousel('pause')
				}, function() {
					$(this)
						.carousel('cycle')
				})
			//$('.carousel-control.left').trigger('click');
			setInterval(function() {
				$('.carousel-control.left')
					.trigger('click');
			}, 3000);
		});
		$i_menu = 0;
		$(".menu_burger")
			.click(function() {
				if ($i_menu == 0) {
					$(".top_menu")
						.animate({
							"right": "0vw"
						});
					$i_menu = 1;
				} else {
					$(".top_menu")
						.animate({
							"right": "-90vw"
						});
					$i_menu = 0;
				}
			});
		//$i_search = 0 ;
		$(".search_ico a")
			.click(function() {
				//alert('clicked');
				$(".search_form")
					.animate({
						"top": "0vw"
					});
				/*if($i_search == 0) {
				   $(".search_form").animate({"top":"0vw"}); $i_search = 1; } else { $(".search_form").animate({"top":"-30vw"});
				   $i_search = 0; }*/
			});
		$(".close_search")
			.click(function() {
				$(".search_form")
					.animate({
						"top": "-60vh"
					});
				/*if($i_search == 0) {
				   $(".search_form").animate({"top":"0vw"}); $i_search = 1; } else { $(".search_form").animate({"top":"-30vw"});
				   $i_search = 0; }*/
			});
		/*-------------- Youtube Fancy box Iframe --------------------*/
		$('.youtube_input')
			.each(function(i, obj) {
				var str = $(this)
					.val();
				var embed = str.replace("watch\?v=", "embed/");
				$v_id = str.replace("https://www.youtube.com/watch?v=", "");
				//alert($v_id);
				$(this)
					.parent('div')
					.parent('div')
					.find(".youtube_thumb")
					.on()
					.show()
					.html("<div><a data-fancybox data-type='iframe' data-src='https://www.youtube.com/embed/" + $v_id + "?autoplay=1' style='z-index:3; overflow:hidden;'><i class='fa fa-play-circle' style='Position: absolute; font-size:45px; left:34%; z-index:9; top:20%; opacity:0.6'></i><img src='https://i.ytimg.com/vi/" + $v_id + "/hqdefault.jpg' class='img-responsive'></a></div>");
			}); //----------------go to top---------------------//
		$(window)
			.scroll(function() {
				if ($(this)
					.scrollTop() > 100) {
					$('.scrollup')
						.fadeIn();
				} else {
					$('.scrollup')
						.fadeOut();
				}
			});
		$('.scrollup')
			.click(function() {
				$("html, body")
					.animate({
						scrollTop: 0
					}, 600);
				return false;
			});
		//-------------------------------------------------// 
		$("#owl-demo")
			.owlCarousel({
				navigation: false,
				slideSpeed: 300,
				paginationSpeed: 400,
				pagination: true,
				singleItem: true,
				autoPlay: true,
				// "singleItem:true" is a shortcut for:
				// items : 1,
				// itemsDesktop : false,
				// itemsDesktopSmall : false,
				// itemsTablet: false,
				// itemsMobile : false
			});
		$(".owl-media")
			.owlCarousel({
				navigation: false,
				slideSpeed: 300,
				paginationSpeed: 400,
				autoPlay: 3000, //Set AutoPlay to 3 seconds
				items: 1,
				pagination: true,
				singleItem: true,
				autoPlay: true,
				// "singleItem:true" is a shortcut for:
				// items : 1,
				// itemsDesktop : false,
				// itemsDesktopSmall : false,
				// itemsTablet: false,
				// itemsMobile : false
			});
		//------------------------//
		$("#owl-event")
			.owlCarousel({
				autoPlay: 3000, //Set AutoPlay to 3 seconds
				items: 4,
				pagination: true,
				itemsDesktop: [1199, 3],
				itemsDesktopSmall: [979, 3]
			});
		$('.gallery a')
			.each(function() {
				if ($(this)
					.has('img')) {
					$(this)
						.addClass("fancybox");
					$(this)
						.attr('rel', 'fancybox');
					$(this)
						.attr('data-fancybox', 'gallery');
				}
			});
		$('a[href$="pdf"]')
			.addClass('ifram_pdf');
		$('a[href$="pdf"]')
			.attr('data-fancybox-type', 'iframe')
		$("a.fancybox")
			.fancybox({
				'autoDimensions': true,
				'transitionIn': 'elastic',
				'transitionOut': 'elastic',
				'speedIn': 600,
				'titlePosition': 'inside',
				'onComplete': function() {
					$("#fancybox-wrap")
						.hover(function() {
							$("#fancybox-title")
								.show();
						}, function() {
							$("#fancybox-title")
								.hide();
						});
				},
				'speedOut': 200,
				'overlayShow': false
			});
		$(".ifram_pdf")
			.fancybox({
				openEffect: 'none',
				closeEffect: 'none',
				iframe: {
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