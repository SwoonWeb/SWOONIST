jQuery(function($) {
	// Common JS goes here

	// Enable Magnific Popup
  // http://dimsemenov.com/plugins/magnific-popup/documentation.html
	$('.entry-content').magnificPopup({
    delegate: 'a.atg-magnific-popup',
    type: 'image',
    closeOnContentClick: false,
    closeBtnInside: false,
    mainClass: 'mfp-with-zoom mfp-img-mobile',
    gallery: {
      enabled: true
    },
    zoom: {
      enabled: true,
      duration: 300, // don't foget to change the duration also in CSS
      opener: function(element) {
        return element.find('img');
      }
    }
  });
  
	// Enable Select 2
	$("select").select2({ width: '100%' });
})