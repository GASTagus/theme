jQuery(function($){
  $('#slider').nivoSlider({
    effect:'fade', //Specify sets like: 'fold,fade,sliceDown'
    slices:1,
    pauseTime:4000,
    manualAdvance:false,
    pauseOnHover:true //Stop animation while hovering
  });

});
jQuery(function($){
  $('#main-menu').slicknav({
    label: '',
    prependTo:'#main-menu-wrapper .main-menu-inner',
    duration: 1000
  });

});

jQuery(function($){
  var $root = $('html, body');
  $('.to-top, .slicknav_menu a.no-active.active, #main-menu a.no-active.active').click( function() {
    var href = $.attr(this, 'href').replace(/^[^#]+/,"");
    $root.animate({
      scrollTop: $( href ).offset().top
    }, 500, function () {
      window.location.hash = href;
    });
    return false;
  });

});

// Returns a function, that, as long as it continues to be invoked, will not
// // be triggered. The function will be called after it stops being called for
// // N milliseconds. If `immediate` is passed, trigger the function on the
// // leading edge, instead of the trailing.
function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
};

jQuery(function($){
  var scrollFn = debounce(function() {
    var scroll = $(window).scrollTop();
    if (scroll>200) {
      $('#to-top').addClass("fix-to-top");
    }
    else {
      $('#to-top').removeClass("fix-to-top");
    }
    var wrap = $("#container");

    if (scroll > 55) {
      wrap.addClass("fix-menu");
    } else {
      wrap.removeClass("fix-menu");
    }
  });
  window.addEventListener('scroll',scrollFn);
  scrollFn();
});
