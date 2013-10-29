#--- ADMIN STUFF ---#

galleryModel = ->
  # objects & stuff
  @images =   ko.observableArray []
  return

gallery = null

fetchKade = (offset = 0, limit = 100) ->
  requestUrl = 'https://emajliramokade.com/platform/Kada.svc/KadaIzvorPodataka/OdobreneKade'
  imageBase =  'https://static.emajliramokade.com/'

  jQuery.ajax
    type: 'GET'
    url:  requestUrl
    data:
      offset: offset
      limit:  limit
    dataType: 'json'
    success:  (response) =>
      gallery.images []
      response.forEach (item) ->
        if item.slikeKade? and item.slikeKade.length isnt 0
          kada = item.slikeKade
          img =
            URI:    item.URI
            width:  kada.thumbnail.width
            height: kada.thumbnail.height
            status: null
            timestamp: item.dodana
            filename:  kada.web.filename
            imgPath:   imageBase+'thumbnail/'+kada.URI+'/'+kada.thumbnail.filename
            fullPath:  imageBase+'web/'+kada.URI+'/'+kada.web.filename

          gallery.images.push img
        return

      return
    error:    (response) ->
      console.warn 'Got error. ', response
      return
  return


$ ->
  gallery = new galleryModel()
  fetchKade()
  ko.applyBindings gallery

  return
