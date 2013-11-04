$(document).ready(function(){

  // flexslider
  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    itemWidth: 140,
    itemMargin: 5,
    asNavFor: '#slider'
  });

  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationSpeed : 700,
    slideshowSpeed : 4000,
    itemMargin: 15,
    sync: "#carousel"
  });

  // fancybox
  $(".fancybox").fancybox({
    openEffect  : 'elastic',
    closeEffect : 'elastic',
    helpers : {
      title : {
        type : 'inside'
      }
    }
  });


  // go to the top smooth
  $('a[href*=#]').click(function() {
  if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
    && location.hostname == this.hostname) {
      var $target = $(this.hash);
      $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
      if ($target.length) {
        var targetOffset = $target.offset().top;
        $('html,body').animate({scrollTop: targetOffset}, 1000);
        return false;
      }
    }
  });

  // tooltips
  $('.js-tooltip').tooltip();


  // js-btn-send
  $( ".js-btn-send" ).click(function() {
    $(this).find('i').removeClass('icon-location-arrow');
    $(this).find('i').addClass('icon-spinner icon-spin');
  });

  // bootstrap input style
  $('input[type=file]').bootstrapFileInput();

});