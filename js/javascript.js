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
$( function() {
// init Isotope
    var $container = $('.isotope').isotope({
        itemSelector: '.iso-item',
        layoutMode: 'fitRows',
        getSortData: {
        category: '[data-category]'
    }
    });
// filter functions
var filterFns = {
// show if number is greater than 50
numberGreaterThan50: function() {
var number = $(this).find('.number').text();
return parseInt( number, 10 ) > 50;
},
// show if name ends with -ium
ium: function() {
var name = $(this).find('.name').text();
return name.match( /ium$/ );
}
};
// bind filter button click
$('#filters').on( 'click', 'button', function() {
var filterValue = $( this ).attr('data-filter');
// use filterFn if matches value
filterValue = filterFns[ filterValue ] || filterValue;
$container.isotope({ filter: filterValue });
});
// change is-checked class on buttons
$('.button-group').each( function( i, buttonGroup ) {
var $buttonGroup = $( buttonGroup );
$buttonGroup.on( 'click', 'button', function() {
$buttonGroup.find('.is-checked').removeClass('is-checked');
$( this ).addClass('is-checked');
});
});
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

// Animate nav 
var cbpAnimatedHeader = (function() {

    var docElem = document.documentElement,
        header = document.querySelector( '.navbar-fixed-top' ),
        didScroll = false,
        changeHeaderOn = 300;

    function init() {
        window.addEventListener( 'scroll', function( event ) {
            if( !didScroll ) {
                didScroll = true;
                setTimeout( scrollPage, 250 );
            }
        }, false );
    }

    function scrollPage() {
        var sy = scrollY();
        if ( sy >= changeHeaderOn ) {
            classie.add( header, 'navbar-shrink' );
        }
        else {
            classie.remove( header, 'navbar-shrink' );
        }
        didScroll = false;
    }

    function scrollY() {
        return window.pageYOffset || docElem.scrollTop;
    }

    init();

})();


