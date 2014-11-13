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

// Fancybox and tooltip options
$(document).ready(function() {
    $('.fancybox').fancybox({
        padding:    2,
        arrows:     false,
        mouseWheel: false
    });

    $('.tooltip').tooltipster();
    
});


// Floating label headings for the contact form
$(function() {
    $("body").on("input propertychange", ".floating-label-form-group", function(e) {
        $(this).toggleClass("floating-label-form-group-with-value", !! $(e.target).val());
    }).on("focus", ".floating-label-form-group", function() {
        $(this).addClass("floating-label-form-group-with-focus");
    }).on("blur", ".floating-label-form-group", function() {
        $(this).removeClass("floating-label-form-group-with-focus");
    });
});

// Change color of Contact Us inputs
$(".floating-label-form-group").on("click", function() {
    $(".floating-label-form-group").css("background", "white");
    $(".floating-label-form-group").css("opacity", "1"); 
    $(".floating-label-form-group").css("border", "1px solid white"); 
});



