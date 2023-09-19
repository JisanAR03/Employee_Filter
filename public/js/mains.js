// jQuery(document).ready(function(){
//   jQuery(".regular").slick({
//     autoplay: true,
//     autoplaySpeed: 2000,
//     pauseOnHover: true,
//     cssEase: 'ease',
//     dots: false,
//     infinite: true,
//     slidesToShow: 3,
//     slidesToScroll: 1,
//     prevArrow: '.prev-slick-btn',
//     nextArrow: '.nxt-slick-btn',
//     responsive: [{
//       breakpoint: 500,
//       settings: {
//         slidesToShow: 1,
//         slidesToScroll: 1,
//       }
//     }]
//   });
//  jQuery('#menu_bar').hide()
//  jQuery('.toggle_btn').click(function(){
//    jQuery('#menu_bar').animate({width: 'toggle'});
//  })
//   jQuery('.accordion-item > button > svg.upAC').hide();
//        jQuery('.accordion > .accordion-item > .accordion-content').hide();
//          jQuery('.accordion-item').each(function(){
//              jQuery(this).on('click', function(){
//                jQuery(this).find('.accordion-title').toggleClass('font-semibold');
//                jQuery(this).find('svg.upAC').toggle();
//                jQuery(this).find('svg.downAC').toggle();
//                jQuery(this).find('.accordion-content').slideToggle();
//              })
//            }
//          )
//          jQuery('.forCandidate').click(function() {
//            jQuery('.candidateDropdown').toggleClass("show")
//          })
//          jQuery('.forEmployer').click(function() {
//            jQuery('.employerDropdown').toggleClass("show")
//          })
//          jQuery('.showSidebar').click(function() {
//            // jQuery('.sidebar').toggleClass("show")
//            jQuery('.sidebar').animate({width: 'toggle'}, 200);
//          })
//          jQuery('.closeSidebar').click(function() {
//            $('.sidebar').toggle();
//          })
//          $( window ).resize(function() {
//            if( $( window ).width()>767){
//              $('.sidebar').toggle(true);
//            }else{
//              $('.sidebar').toggle(false);
//            }
//            });    
//   })

jQuery(document).ready(function() {
	jQuery(".regular").slick({
		autoplay: true,
		autoplaySpeed: 2000,
		pauseOnHover: true,
		cssEase: 'ease',
		dots: false,
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		prevArrow: '.prev-slick-btn',
		nextArrow: '.nxt-slick-btn',
		responsive: [{
			breakpoint: 500,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
			}
		}]
	});
	jQuery('body').on('click', function(event) {
		if (jQuery(event.target).is(':not(.sCLSFDD)')) {
			if (jQuery('.sCLSFDD').parent().children('div').hasClass('show')) {
				jQuery('.sCLSFDD').parent().children('div').removeClass('show');
			}
		}
	})
	jQuery('body').on('click', function(event) {
		if (jQuery(event.target).is(':not(.sCLSFDP)')) {
			if (jQuery('.sCLSFDP').parent().children('div').hasClass('show')) {
				jQuery('.sCLSFDP').parent().children('div').removeClass('show');
			}
		}
	})
	jQuery('#menu_bar').hide()
	jQuery('.toggle_btn').click(function() {
		jQuery('#menu_bar').animate({
			width: 'toggle'
		});
	})
	jQuery('.accordion-item > button > svg.upAC').hide();
	jQuery('.accordion > .accordion-item > .accordion-content').hide();
	jQuery('.accordion-item').each(function() {
		jQuery(this).on('click', function() {
			jQuery(this).find('.accordion-title').toggleClass('font-semibold');
			jQuery(this).find('svg.upAC').toggle();
			jQuery(this).find('svg.downAC').toggle();
			jQuery(this).find('.accordion-content').slideToggle();
		})
	})
	jQuery('.forCandidate').click(function() {
		jQuery('.candidateDropdown').toggleClass("show")
	})
	jQuery('.forEmployer').click(function() {
		jQuery('.employerDropdown').toggleClass("show")
	})
	jQuery('.showSidebar').click(function() {
		jQuery('.sidebar').animate({
			width: 'toggle'
		}, 200);
	})
	jQuery('.closeSidebar').click(function() {
		jQuery('.sidebar').toggle();
	})
	jQuery('.showIcon').hide()
	jQuery('.iconDiv').each(function() {
		jQuery(this).on('click', function() {
			jQuery(this).find('.showIcon').toggle();
		})
	})
	jQuery('.message-box').hide();
	jQuery('.user').click(function() {
		jQuery('.all-user').toggle()
		jQuery('.message-box').toggle()
	})
	jQuery('.back-message').click(function() {
		jQuery('.all-user').show()
		jQuery('.message-box').hide()
	})
	jQuery(window).resize(function() {
		if (jQuery(window).width() > 768) {
			jQuery('.sidebar').toggle(true);
		} else {
			jQuery('.sidebar').toggle(false);
		}
	});
})