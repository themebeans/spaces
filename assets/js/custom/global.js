// IF JS IS ENABLED, REMOVE 'no-js' AND ADD 'js' CLASS
jQuery('html').removeClass('no-js').addClass('js');

/**
 * Setup a globally accessible object that contains an array property with list of functions
 * to be called by Isotope Infinite Scrolling whenever new elements are pulled via AJAX
 */

var Bean_Isotope = Bean_Isotope || {};
Bean_Isotope.callAfterNewElements = [];

jQuery(document).ready(function($) {

	//FITVIDS
	$("body").fitVids();

	//RESPONSIVE MENU
	$('#mobile-nav').meanmenu();

	//FORM VALIDATION
	if (jQuery().validate) { jQuery("#commentform").validate(); }

	//DROPDOWNS - SUPERFISH
	$('nav ul').superfish({
    		delay: 100,
    		animation: { opacity:'show', height:'show' },
    		speed: 150,
    		cssArrows: false,
    		disableHI: true
	});

	//POST AUTHOR & COMMENTS REVEAL
	var  $authorToggle  = $('.author-btn'),
		$authorDiv = $('#author-wrapper'),
		$commentsToggle  = $('.comments-btn'),
		$commentsDiv = $('#comments'),
	 	$animationDur = 200;


	$authorToggle.on('click', function(e) {
		e.preventDefault();

		if( $authorToggle.hasClass('active') ) {
			$authorDiv.slideUp( $animationDur , function() {
				$authorToggle.removeClass('active');
				$authorDiv.removeClass('active');
				$authorDiv.fadeOut($animationDur);
			});
		} else {
			$authorDiv.slideDown( $animationDur , function() {
   				$authorToggle.addClass('active');
				$authorDiv.addClass('active');
				$authorDiv.fadeIn($animationDur);
 			});
		}
	});

	$commentsToggle.on('click', function(e) {
		e.preventDefault();

		if( $commentsToggle.hasClass('active') ) {
			$commentsDiv.slideUp( $animationDur , function() {
				$commentsToggle.removeClass('active');
				$commentsDiv.removeClass('active');
				$commentsDiv.fadeOut($animationDur);
			});
		} else {
			$commentsDiv.slideDown( $animationDur , function() {
   				$commentsToggle.addClass('active');
				$commentsDiv.addClass('active');
				$commentsDiv.fadeIn($animationDur);
 			});
		}
	});

	//POSTS FILTER
	if($('body').length){
		var posts = $('body');
		posts.find('#filter li a').on('click', function(){
			posts.find('#filter li a').removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			posts.find('.filtered').addClass('inactive');
			posts.find(selector).removeClass('inactive');
			return false;
		});
	}

	//HEADER SEARCH
	$('.primary #searchform .search').on('focus', function() {
		$(this).closest('#searchform').addClass('active');
		$('nav.primary ul').addClass('fadeout');
	});

	$('.primary #searchform .search').on('focusout', function() {
		$(this).closest('#searchform').removeClass('active');
		$('nav.primary ul').removeClass('fadeout');
	});

	//LIGHTBOX TRIGGER
	$(".lightbox").fancybox({
		fitToView: true,
	});

	//CONTACT TEMPLATE
	$('#BeanForm input#contactName').attr( 'placeholder', spacesScreenReaderText.name );
	$('#BeanForm input#email').attr( 'placeholder', spacesScreenReaderText.email );
	$('#BeanForm textarea#commentsText').attr( 'placeholder', spacesScreenReaderText.message );

	//IE SIDEBAR TOGGLE SPECIFIC
	var $browserMSIE = $.browser.msie;
	var $browserVersion = parseInt($.browser.version, 10);

	if ($browserMSIE && $browserVersion === 8 || $browserMSIE && $browserVersion === 9) {
	$(document).on("click", '.ie .sidebar-btn' , function(){
		if ($('#theme-wrapper').hasClass('ie-side-menu')) {
			$('#theme-wrapper').removeClass('ie-side-menu');
		 	$('.hidden-sidebar').css('display','none').css('z-index','-1');
		 	$('.menu-icon').removeClass('close');
		 } else {
		 	$('#theme-wrapper').addClass('ie-side-menu');
		 	$('.hidden-sidebar').css('display','block').css('z-index','99');
		 	$('.menu-icon').addClass('close');
		}
	 });
	} else {}

	//RIGHT SIDEBAR MAIN
	var ua = navigator.userAgent,
    	clickevent = (ua.match(/iPad/i) || ua.match(/iPhone/i) || ua.match(/Android/i)) ? "touchstart" : "click";

	//MENU BUTTON TRIGGER
	$(document).on(clickevent, 'a.sidebar-btn, .nav-overlay', function(event){
	event.preventDefault();
		if ($('#theme-wrapper').hasClass('side-menu')) {
		  closeMenu();
		} else {
		  openMenu();
		}
	});

	//OPEN
	function openMenu(){
	 	$('.hidden-sidebar').css('display','block');
	 	$('.menu-icon').addClass('close');
	 	$('#theme-wrapper').addClass('side-menu');
	 	$('#theme-wrapper').addClass('side-trans');
	 	$('.safari #theme-wrapper').addClass('no-flick');
	 	$('.safari #header-container').addClass('no-flick');
	 	setTimeout(function(){$('.hidden-sidebar').css('z-index','5');},400);
	}

	//CLOSE
	function closeMenu(){
		$('.hidden-sidebar').css('z-index','-1');
		$('.menu-icon').removeClass('close');
	     $('#theme-wrapper').removeClass('side-menu');
	     setTimeout(function(){$('#theme-wrapper').removeClass('side-trans');},400);
	     $('.safari #theme-wrapper').removeClass('no-flick');
	     $('.safari #header-container').removeClass('no-flick');
		setTimeout(function(){ $('.hidden-sidebar').css('z-index','-1'); },400);
	}

	//GRID INIT
	Bean_Likes.Bean_Likes_Init();
	Bean_Media.setupAudioPosts();

	Bean_Isotope.callAfterNewElements.push(Bean_Likes.Bean_Likes_Init);
	Bean_Isotope.callAfterNewElements.push(Bean_Media.setupAudioPosts);
});


//BEAN LIKES FUNCTIONS
var Bean_Likes = {
	Bean_Reload_Likes: function(who) {
	var text = jQuery("#" + who).html();
	var patt= /(\d)+/;

	var num = patt.exec(text);
	num[0]++;
	text = text.replace(patt,num[0]);
	jQuery("#" + who).html('<span class="count">' + text + '</span>');
	},

	Bean_Likes_Init: function() {
	jQuery(".bean-likes").click(function() {
		var classes = jQuery(this).attr("class");
		classes = classes.split(" ");

		if(classes[1] == "active") {
			return false;
		}
		var classes = jQuery(this).addClass("active");
		var id = jQuery(this).attr("id");
		id = id.split("like-");
		jQuery.ajax({
		  type: "POST",
		  url: "index.php",
		  data: "likepost=" + id[1],
		  success: Bean_Likes.Bean_Reload_Likes("like-" + id[1])
		});
		return false;
	});
	}
};


// FUNCTIONS FOR HANDLING POSTS OF TYPE 'AUDIO' AND 'VIDEO'
var Bean_Media = {
	setupAudioPosts: function() {

		if(jQuery().jPlayer) {
			jQuery(".jp-audio").each(function() {
				var mp3 = jQuery(this).data("file");
				var cssSelectorAncestor = '#' + jQuery(this).attr("id");

				jQuery(this).find(".jp-jplayer").jPlayer( {
					ready : function () {
							jQuery(this).jPlayer("setMedia", {
							mp3: mp3,
							end: ""
						});
					},
					size: {
					    width: "100%",
					},
					swfPath: WP_TEMPLATE_DIRECTORY_URI[0] + "/assets/js",
					cssSelectorAncestor: cssSelectorAncestor,
					supplied: (mp3 ? "mp3": "") + ", all"
				});
			});
		}
		jQuery(".jp-audio .jp-interface").css("display", "block");

	},
};