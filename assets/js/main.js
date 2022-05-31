( function ( $ ) {
	"use strict";


jQuery(document).ready(function($) {

  /************ Mobile menu, script HC Off-canvas Nav ************/
 var  position = skywp_header_position_mobile_menu.skywp_header_position_mobile_menu,
      levelOpen = skywp_header_opening_mobile_menu.skywp_header_opening_mobile_menu,
      header_layout = skywp_header_layout.skywp_header_layout;
  if ( header_layout === 'banner' ) {
    $('#site-navigation-wrap').hcOffcanvasNav({
      maxWidth: 768,
      position: position,
      levelOpen: levelOpen,
    });
  } else {
    $('#site-navigation-wrap').hcOffcanvasNav({
      maxWidth: 1025,
      position: position,
      levelOpen: levelOpen,
    });
  }
  // Function for the correct operation of the mobile menu from the keyboard using the TAB key
  // Works in conjunction with skip-link-focus-fix.js
  $(".button-nav-next").keyup( function( event ) {
    if( event.keyCode == 13 ){
      $( this ).click();
    }
  });



  /************ Show the menu in the header ************/
  $( '#icom-search .menu_toggle_class' ).on( 'click', function() {
    $( '#searchform-dropdown' ).toggleClass( 'show' );
  });
  // Close search
  $( '#topbar-wrap, .skywp-breadcrumb, #content' ).on( 'click', function() {
    $( '#searchform-dropdown' ).removeClass( 'show' );
  });



  /************ Gradually scroll to top ************/
  $("#scroll-top").mPageScroll2id({
    forceSingleHighlight: true,
    offset: 30,
  });



  /************ Alignment of records in style masonry ************/
  var enable_masonry = skywp_post_page_style.skywp_post_page_style;
  if ( 'masonry' == enable_masonry ) {
    $('.style-masonry').masonry({
      itemSelector: '.item'
    });
  }



  /************ Scroll up button ************/
  var nav = $('#scroll-top');
  $(window).scroll(function () {
    if ($(this).scrollTop() > 500) {
      nav.addClass("block");
    } else {
      nav.removeClass("block");
    }
  });



  /************ Header fixed menu navigation ************/
  var inner = $( '#site-header' );
  if ( true == skywp_header_sticky_value.skywp_header_sticky ) {
    $( window ).scroll( function () {
      if ( $( this ).scrollTop() > 500 ) {
        inner.addClass( "fixed" );
      } else {
        inner.removeClass( "fixed" );
      }
    });
  }



  /**
   * Helps with accessibility for keyboard only users.
   *
   * Learn more: https://github.com/Automattic/_s/pull/136
   */
  var isIe = /(trident|msie)/i.test( navigator.userAgent );

  if ( isIe && document.getElementById && window.addEventListener ) {
    window.addEventListener( 'hashchange', function() {
      var id = location.hash.substring( 1 ),
        element;

      if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
        return;
      }

      element = document.getElementById( id );

      if ( element ) {
        if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
          element.tabIndex = -1;
        }

        element.focus();
      }
    }, false );
  }



});


$( window ).load(function() {
 
});


  




})(jQuery);