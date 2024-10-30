function openModal1() {
	closeNav();
	closeModal();
	//jQuery('.myvideo').trigger('pause');
        jwplayer().pause();
	document.getElementById('myModal').style.display = "block";
}

function closeModal1() {
	document.getElementById('myModal').style.display = "none";
        //jQuery('.myvideo').trigger('pause');
        jwplayer().pause()
}

var slideIndex = 1;
showSlides_img(slideIndex);

function plusSlides_img(n) {
	showSlides_img(slideIndex += n);
}

function currentSlide_img(n) {
	showSlides_img(slideIndex = n);
}

function showSlides_img(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  //captionText.innerHTML = dots[slideIndex-1].alt;
}

// img-gallary-script -->
// video-gallary-script -->
function openModal() {
	closeNav();
	closeModal1();
  document.getElementById('myvideoModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myvideoModal').style.display = "none";
  // jQuery('.myvideo').trigger('pause');
   jwplayer().pause();
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var videoslides = document.getElementsByClassName("myvideoSlides");
  var dots = document.getElementsByClassName("videodemo");
  var captionText = document.getElementById("video-caption");
  if (n > videoslides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = videoslides.length}
  for (i = 0; i < videoslides.length; i++) {
      videoslides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  videoslides[slideIndex-1].style.display = "block";
  
  if(n!=1){dots[slideIndex-1].className += " active";
  }
  //captionText.innerHTML = dots[slideIndex-1].alt;
}

jQuery('.myvideo').hover(function toggleControls() {
    if (this.hasAttribute("controls")) {
        this.removeAttribute("controls")
    } else {
        this.setAttribute("controls", "controls")
    }
})

jQuery('.vita_li').click(function () {
   //jQuery('.myvideo').trigger('pause');
   jwplayer().pause();
})
jQuery('.menus ul li').click(function () {
   jQuery(".pause_slider").click();
})
jQuery('.closebtn').click(function () {
   jQuery(".play_slider").click();
})
jQuery('.close').click(function () {
   jQuery(".play_slider").click();
})

//  jQuery(function() {
//    jQuery(".rslides").responsiveSlides({
//        auto: true,
//        timeout: 8000,  
//        pager: true,
//        nav: true,
//        speed: 500,
//        namespace: "transparent-btns"
//  });
//    });

function openNav() {
	closeModal1();
	closeModal();
	//jQuery('.myvideo').trigger('pause');
        jwplayer().pause()
    document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
    document.getElementById("myNav").style.width = "0%";
   // jQuery('.myvideo').trigger('pause');
    jwplayer().pause();
}

function openNav() {
	closeModal1();
	closeModal();
    document.getElementById("user-biodata").style.width = "40%";
}

function closeNav() {
	//jQuery('.myvideo').trigger('pause');
        jwplayer().pause();
    document.getElementById("user-biodata").style.width = "0%";
}

jQuery(document).ready(function(){
    
    var url      = window.location.href;
if(url.indexOf('#Video') != -1){
   openModal();currentSlide(1)
}
if(url.indexOf('#Photo') != -1){
  openModal1();currentSlide_img(1)
}
if(url.indexOf('#Vita') != -1){
    if (jQuery(window).width() > 767) {
 openNav()}
}
	var ele;
	function slider_height(){
		var wind_hei = jQuery(window).height();
		jQuery(".rslides li").css("height",wind_hei);
	}
	slider_height();

	 jQuery(window).resize(function() {
	 	slider_height();
	 });
	 
	 jQuery('.accordion').click(function(){
		if(jQuery(this).parent().find('.panel').css('display') == 'block'){
			jQuery(this).removeClass('active');
			//jQuery(this).parent().find('.panel').css('display', 'none');
			jQuery(this).parent().find('.panel').slideUp("slow");
		}
		else{
			jQuery(this).addClass('active');
			//jQuery(this).parent().find('.panel').css('display', 'block');
			jQuery(this).parent().find('.panel').slideDown("slow");
                        
		}
	 });
	 
	jQuery('body').on('click', '.vdo-thumb', function (e) {
		var video_url = jQuery(this).data("url");
                
		//jQuery(".myvideo").attr("src",video_url);
		jQuery(".video_detail #caption").html(jQuery(this).attr("title_temp"));
		jQuery(".video_detail a").attr("href",video_url);
		jQuery(".video_detail a").attr("download",jQuery(this).attr("title_temp"));
               jQuery('.vdo-thumb').removeClass('playing');
    jwplayer('jwplayer_myvideo').load([{'file':video_url}]);
    jwplayer('jwplayer_myvideo').play();
		//jQuery('.myvideo').trigger('play');
		jQuery(this).addClass('playing');
	});
       
	jwplayer("jwplayer_myvideo").on('complete', function(){
		if(jQuery('.playing').hasClass('last')){
			ele = jQuery('.first');
		}else
			ele = jQuery('.playing').next('.vdo-thumb');
		video_url = ele.data("url");
		jwplayer('jwplayer_myvideo').load([{'file':video_url}]);
                jwplayer('jwplayer_myvideo').play();
		jQuery('.vdo-thumb').removeClass('playing');
		ele.addClass('playing');
});
	jQuery('.video-modal').find('.next').click(function(){
//		if(jQuery('.playing').hasClass('last')){
//			ele = jQuery('.first');
//		}else
//			ele = jQuery('.playing').next('.vdo-thumb');
//		video_url = ele.data("url");
//		jQuery(".myvideo").attr("src",video_url);
//		jQuery('.myvideo').trigger('play');
//		jQuery('.vdo-thumb').removeClass('playing');
//		ele.addClass('playing');
	});
	
	jQuery('.video-modal').find('.prev').click(function(){
//		if(jQuery('.playing').hasClass('first')){
//			ele = jQuery('.last');
//		}else
//			ele = jQuery('.playing').prev('.vdo-thumb');
//		video_url = ele.data("url");
//		jQuery(".myvideo").attr("src",video_url);
//		jQuery('.myvideo').trigger('play');
//		jQuery('.vdo-thumb').removeClass('playing');
//		ele.addClass('playing');
	});
	 jQuery(".mobile_menu_button").click(function(){
                jQuery(".header_inner_left").toggleClass("open-menu-close");
                jQuery(".header_inner_left .qode_icon_font_awesome").toggleClass("fa fa-close");
                jQuery(".header_inner_left .qode_icon_font_awesome").toggleClass("fa fa-bars");
        });
        
        var current_height=jQuery(window).height()-100;
        jQuery(".overlay-content").css("height",current_height);
        
});


		jQuery(function(){
			var $window = jQuery(window),
		        $html = jQuery('#user-biodata');

		    $window.resize(function resize() {
		    	jQuery(".open-btn").on("click", function () {
		        if ($window.width() < 767) {		        	
		            jQuery('#user-biodata').addClass('w100');
		           	console.log('hi');		           	
		            
		            // $('#user-biodata').addClass('w100');
		        } else {
		        	jQuery('#user-biodata').removeClass('w100');
		        	console.log('here');
		        }
		    });

		    	jQuery(".closebtn").on("click", function () {
		        if ($window.width() < 767) {		        	
		        
		        	jQuery('#user-biodata').removeClass('w100');
		        	console.log('here');
		        }
		        
		    });

		    }).trigger('resize');
		});

var acc = document.getElementsByClassName("accordion");
var i;
/*
for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
*/
