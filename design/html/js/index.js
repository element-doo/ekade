// Generated by CoffeeScript 1.6.3
(function() {
  var fetchKade, gallery, galleryModel;

  galleryModel = function() {
    this.images = ko.observableArray([]);
  };

  gallery = null;

  fetchKade = function(offset, limit) {
    var imageBase, requestUrl,
      _this = this;
    if (offset == null) {
      offset = 0;
    }
    if (limit == null) {
      limit = 100;
    }
    requestUrl = 'https://emajliramokade.com/platform/Kada.svc/KadaIzvorPodataka/OdobreneKade';
    imageBase = 'https://static.emajliramokade.com/';
    jQuery.ajax({
      type: 'GET',
      url: requestUrl,
      data: {
        offset: offset,
        limit: limit
      },
      dataType: 'json',
      success: function(response) {
        gallery.images([]);
        response.forEach(function(item) {
          var img, kada;
          if ((item.slikeKade != null) && item.slikeKade.length !== 0) {
            kada = item.slikeKade;
            img = {
              URI: item.URI,
              width: kada.thumbnail.width,
              height: kada.thumbnail.height,
              status: null,
              timestamp: item.dodana,
              filename: kada.web.filename,
              imgPath: imageBase + 'thumbnail/' + kada.URI + '/' + kada.thumbnail.filename,
              fullPath: imageBase + 'web/' + kada.URI + '/' + kada.web.filename
            };
            gallery.images.push(img);
          }
        });
      },
      error: function(response) {
        console.warn('Got error. ', response);
      }
    });
  };

  $(function() {
    gallery = new galleryModel();
    fetchKade();
    ko.applyBindings(gallery);
  });

}).call(this);
