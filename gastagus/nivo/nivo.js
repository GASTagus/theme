jQuery(function($){
   $('#slider').nivoSlider({
        effect:'fade', //Specify sets like: 'fold,fade,sliceDown'
		slices:1,
		pauseTime:4000,
		manualAdvance:false,
	        pauseOnHover:true //Stop animation while hovering
		}
   );
});
