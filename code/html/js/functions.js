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

  $('#salji-kadu').click(function(e) {
    e.preventDefault();
    var email = $('#appendedInputButton').val();
    var kadaID = $('#kade li.selected img').attr('data-description');
    var body = JSON.stringify({ email: email, kadaID: kadaID });

    $.ajax({
      type: "post",
      url: 'https://emajliramokade.com/api',
      contentType: 'application/json; charset=utf-8',
      data: body,
      dataType: 'json',
    }).always(function(response) {
        if (response.responseText)
          response = JSON.parse(response.responseText);

        if (response.status)
          $('#mymodal-label').text('Kada je uspješno poslana');
        else
          $('#mymodal-label').text('Greška kod slanja kade!');

        $('#mymodal-body').text(response.poruka);
        $('#mymodal').modal('show');
        $('#salji-kadu i').removeClass('icon-spinner icon-spin').addClass('icon-double-angle-right');
    });
  });

  $('#upload-frame').load(function() {
    $('#submit-button i').removeClass('icon-spinner icon-spin');

    var rawResponse = $(this).contents().find('body').text();
    var response = JSON.parse(rawResponse);

    if (response.status)
      $('#mymodal-label').text('Kada je uspješno spremljena!');
    else
      $('#mymodal-label').text('Greška kod spremanja kade!');

    $('#mymodal-body').text(response.poruka);
    $('#mymodal').modal('show');
  });

  $('#submit-button').click(function() {
    $(this).find('i').addClass('icon-spinner icon-spin');
  });
});
