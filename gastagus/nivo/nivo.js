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
jQuery(function($){
  /*  var wrap = $("html, body");

      wrap.on("scroll", function(e) {
      alert(this.scrollTop);
      if (this.scrollTop > 111) {
      wrap.addClass("fix-menu");
      } else {
      wrap.removeClass("fix-menu");
      }

      });
      */
});
