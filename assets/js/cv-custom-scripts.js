jQuery(document).ready(function($) {

    "use strict";
    var KEYCODE_TAB = 9;

    if($('body').hasClass("rtl")) {
        var rtlValue = true;
    } else {
        var rtlValue = false;
    }

    /**
     * Header Search script
     */
    $('.cv-menu-search .cv-search-icon').click(function() {
        $('.cv-menu-search .cv-form-wrap').toggleClass('search-activate');
        var element = document.querySelector( '.cv-menu-search .cv-form-wrap' );
        var focusable = element.querySelectorAll( 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        var firstFocusable = focusable[0];
        var lastFocusable = focusable[focusable.length - 1];
        wisdom_blog_focus_trap( firstFocusable, lastFocusable );
    });

    $('.cv-menu-search .cv-form-close').click(function() {
        $('.cv-menu-search .cv-form-wrap').removeClass('search-activate');
        var focusClass = $(".cv-menu-search .cv-form-wrap .cv-form-close").data( 'focus' );
        $( '.' + focusClass ).find( 'a' ).focus();
    });

    /**
     * Settings about WOW animation
     */
    new WOW().init();
    
    /**
     * responsive sub menu toggle
     */
    $('#masthead .menu-toggle').click(function(event) {
        $( '#site-navigation' ).slideToggle('slow').addClass('active-nav');
        var element = document.querySelector( '#site-navigation' );
        var focusable = element.querySelectorAll( 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        var firstFocusable = focusable[0];
        var lastFocusable = focusable[focusable.length - 1];
        wisdom_blog_focus_trap( firstFocusable, lastFocusable );
    });
    
    $('body .menu-toggle-off').on('click', function(){
        $( '#site-navigation' ).removeClass('active-nav').slideToggle('slow');
        var focusClass = $(this).data( 'focus' );
        $( focusClass ).find( 'a' ).focus();
    });

    /*$('#site-navigation .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');
    $('#site-navigation .page_item_has_children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');*/
    $('<span class="sub-toggle"><a href="javascript:void(0);"><i class="fa fa-angle-right"></i></a></span>').insertAfter('#site-navigation .menu-item-has-children>a, #site-navigation .page_item_has_children>a');
    

    $('#site-navigation .menu-item-has-children .sub-toggle').on( 'click', function() {
        $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
        $(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('1000');
        $(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
    });

    /**
     * Sticky sidebar
     */
    $('#primary, #secondary').theiaStickySidebar({
        additionalMarginTop: 40
    });

    /**
     * Scroll To Top
     */
    $(window).scroll(function() {
        if ($(this).scrollTop() > 1000) {
            $('#cv-scrollup').fadeIn('slow');
        } else {
            $('#cv-scrollup').fadeOut('slow');
        }
    });
    $('#cv-scrollup').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    /**
     * Focus trap in popup.
     */
    function wisdom_blog_focus_trap( firstFocusable, lastFocusable ) {
        $(document).on('keydown', function(e) {
            if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {
                if ( e.shiftKey ) /* shift + tab */ {
                    if (document.activeElement === firstFocusable) {
                        lastFocusable.focus();
                        e.preventDefault();
                    }
                } else /* tab */ {
                    if (document.activeElement === lastFocusable) {
                        firstFocusable.focus();
                        e.preventDefault();
                    }
                }
            }
        });
    }
});