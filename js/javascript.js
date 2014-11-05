// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('.page-scroll a').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Highlight the top nav as scrolling occurs
$('body').scrollspy({
    target: '.navbar-fixed-top'
})

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});

// FlexSlider options
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: 		"slide",
    pauseOnHove: 	false,
    controlNav: 	false,
    smoothHeight: 	false,
    directionNav: 	false
  });
});

// Isotope options
var $container = $('.isotope');
$container.isotope({
  itemSelector : '.iso-item'
});


