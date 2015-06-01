jQuery(function($){
  $(window).load(function() { 
  $('#slider').nivoSlider({
    effect:'fade', //Specify sets like: 'fold,fade,sliceDown'
		slices:1,
		pauseTime:4000,
	  manualAdvance:false,
	        pauseOnHover:true //Stop animation while hovering
		}
   );
  });

  $(function(){
    $('#main-menu').slicknav({
        label: '',
        prependTo:'#main-menu-wrapper .main-menu-inner',
        duration: 1000/*,
        easingOpen: "easeOutBounce" //available with jQuery UI */
    });
  });
});
