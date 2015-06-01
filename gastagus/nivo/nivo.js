jQuery(function($){
  $(window).load(function() { 
  $('#slider').nivoSlider({
    effect:'fade', //Specify sets like: 'fold,fade,sliceDown'
		slices:1,
		pauseTime:4000,
	  manualAdvance:false,
	        pauseOnHover:true //Stop animation while hovering
		});
  });

  $('#main-menu').slicknav({
    label: '',
    prependTo:'#main-menu-wrapper .main-menu-inner',
    duration: 1000
  });
  
  var $root = $('html, body');
  $('.slicknav_menu a.no-active.active, #main-menu a.no-active.active').click( function() {
    var href = $.attr(this, 'href');
    $root.animate({
      scrollTop: $( $.attr(this,'href').replace(/^[^#]+/,"") ).offset().top
    }, 500, function () {
      window.location.hash = href;
    });
    return false;
  });
});
