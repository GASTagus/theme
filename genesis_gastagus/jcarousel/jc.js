
var carousel_itemList = [
    {url: "sites/default/files/jcarousel/1.jpg", title: "Flower1" , link: "http://www.google.com" , alt: "yada" },
    {url: "sites/default/files/jcarousel/2.jpg", title: "Flower2" , link: "http://www.google.com" , alt: "yada" },
    {url: "sites/default/files/jcarousel/3.jpg", title: "Flower3" , link: "http://www.google.com" , alt: "yada" },
    {url: "sites/default/files/jcarousel/4.jpg", title: "Flower4" , link: "http://www.google.com" , alt: "yada" },
    {url: "sites/default/files/jcarousel/5.jpg", title: "Flower5" , link: "http://www.google.com" , alt: "yada" },
    {url: "sites/default/files/jcarousel/6.jpg", title: "Flower6" , link: "http://www.google.com" , alt: "yada" },
    ];

/**
 * Item html creation helper.
 */
function carousel_getItemHTML(item) {
    //return '<img src="' + item.url + '" width="75" height="75" alt="' + item.url + '" />';

    return '<div style="margin-left:5px; background:none;" class="item">' +
    '<div class="item-image">' +
    '<a href="' + item.link + '">' +
    '<img border="0" alt="' + item.alt + '" src="' + item.url + '">' +
    '</a>' +
    '</div>' +
    '<div class="desc-wrap">' +
    '<div class="desc">' +
    '<h2><a href="' + item.link + '">' + item.title + '</h2>' +
    '</div>' +
    '</div>' +
    '</div>';

};

	
jQuery(function($){

  $("body").addClass("has_js");
  
  // Home page carousel
  var carousel_arr = [];
  
  // Temporary containers for form data in carousel
  var form_data = [];
  var new_item;
    
  var msie = $.browser.msie;
  
  // Initialization 
  function carouselInitCallback(carousel){
    
    $('.jcarousel-next,.jcarousel-prev').insertAfter('#carousel-wrap');
    
    $('#carousel, .jcarousel-next, .jcarousel-prev').mouseover(function(e){
      e.stopPropagation(); // stops the scrolling
      carousel.stopAuto();
      // Adds mouseover function for body, to resume auto carousel motion
      // Added 2009-03-25
      $('body').mouseover(function(){
        $('.jcarousel-next').trigger('click');
        carousel.startAuto(5);
        $(this).unbind('mouseover');
      });
      
    });
  }
  
  // Fired before carousel moved, appends new item to carousel to give illusion of infininate list
  function carouselInCallback(carousel, item, i, state, evt){
    var idx = carousel.index(i, carousel_arr.length);
    new_item = carousel.add(i,carousel_arr[idx - 1]);
    // Apply PNG Fix for IE6
    //$('#carousel .desc-wrap, #carousel .lbl').ifixpng();
  }
  
  // Fired after carousel move, removes item from end of carousel (same one which was appended beforehand)
  function carouselOutCallback(carousel, item, i, state, evt){
    carousel.remove(i);
  }
  
  function carouselitemLoadCallback(carousel, state) {
    for ( var i = carousel.first ; i <= carousel_itemList.length ; i++ ) {
        if (carousel.has(i)) {
          continue;
        } else if (i > carousel_itemList.length) {
          break;
        }
        var itm = carousel_getItemHTML(carousel_itemList[i-1]);
        carousel.add(i, itm);
        carousel_arr.push(itm);
    }
  }
  
  // Invoke home page carousel
  $('#carousel ul').jcarousel({
    scroll:1, // the number of items to scroll by
    auto: 5, // seconds to periodically autoscroll the content
    wrap: 'circular', // Specifies whether to wrap at the first/last item 
                      // (or both) and jump back to the start/end
    
    itemLoadCallback: {onBeforeAnimation: carouselitemLoadCallback},
    size: 6,
    initCallback: carouselInitCallback,
   
    easing:'easeInOutCubic', // The name of the easing effect that you want to use
    animation:1500 // The speed of the scroll animation as string in jQuery terms
  });
  
  // If good ole IE, apply some PNG fixes and allow for hover state on previous and next buttons
  /*
  if(msie){
    $('#carousel .desc-wrap, #carousel .lbl, .jcarousel-prev, .jcarousel-next').ifixpng();
    $('.jcarousel-prev,.jcarousel-next').hover(function(){
      $(this).iunfixpng().css('background-position','-50px 0');
    },function(){
      $(this).css('background-position','0 0').ifixpng();
    });
  }
  */
  
  
  
});