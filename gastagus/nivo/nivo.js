jQuery(function($){
  $(window).load(function() { 
  $('#slider').nivoSlider({
    effect:'fade', //Specify sets like: 'fold,fade,sliceDown'
		slices:1,
		pauseTime:4000,
	  manualAdvance:true,
	        pauseOnHover:true //Stop animation while hovering
		}
   );
  });
});
