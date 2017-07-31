jQuery(function($) {

  $('#close-btn, #page-overlay').on('click', function(){
    $('body').removeClass('visible-sidenav');
  });

  $('.open-btn').on('click', function(){
    var w = $('body').width();
    $('#main-content').css('width', w);
    $('body').addClass('visible-sidenav');
  });

});