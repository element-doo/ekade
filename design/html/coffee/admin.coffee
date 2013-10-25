#--- ADMIN STUFF ---#

galleryModel = ->
  # objects & stuff
  @images =   ko.observableArray []
  @maxPages = ko.observable 0
  @currPage = ko.observable 1

  # flags
  @changes =   ko.observable 0
  @isWorking = ko.observable false

  # actions
  @actionApprove = ->
    i = gallery.images.indexOf @
    newItem = gallery.__cloneItem i
    newItem.status = true

    gallery.images.splice i, 1, newItem
    gallery.changes gallery.changes()+1
    return

  @actionReject = ->
    i = gallery.images.indexOf @
    newItem = gallery.__cloneItem i
    newItem.status = false

    gallery.images.splice i, 1, newItem
    gallery.changes gallery.changes()+1
    return

  @actionMarkAllConfirmed = =>
    @__markAll true
    return

  @actionMarkAllRejected = =>
    @__markAll false
    return

  @actionSaveChanges = =>
    requestUrl = 'https://emajliramokade.com/platform/Moderiraj.svc/MasovnaModeracija'
    @isWorking true

    data = []
    @images().forEach (item) ->
      kada =
        kadaID:   item.URI
        odobrena: item.status

      data.push kada  if item.status isnt null
      return

    moderiraneKade =
      moderacijeKada: data

    jQuery.ajax
      type: 'PUT'
      url:  requestUrl
      data: JSON.stringify moderiraneKade
      dataType: 'json'
      headers:
        'Content-Type': 'application/json'
        Authorization:  'Basic cm9iaTppYm9y'
      success:  (response) =>
        fetchKade()
        gallery.isWorking false
        return

      error:    (response) ->
        console.warn 'Got error. ', response
        return

    return

  @pagePrev = =>
    @currPage (if @currPage() is 1 then 1 else @currPage() - 1)
    fetchKade @currPage-1, 20
    return

  @pageNext = =>
    max = @pages().length
    gallery.currPage (if gallery.currPage() >= max then max else gallery.currPage() + 1)
    fetchKade @currPage-1, 20
    return

  @pageNum = ->
    max = gallery.pages().length
    gallery.currPage (if @.page <= max or @.page >= 1 then @.page else 1 )
    fetchKade gallery.currPage-1, 20
    return

  @pages = ko.computed =>
    i = 0
    pages = []
    while i < @maxPages()
      pages.push
        page: i+1
      i++
    pages

  # working class
  @__cloneItem = (index) ->
    item = gallery.images()[index]
    newItem =
      URI:    item.URI
      width:  item.width
      height: item.height
      timestamp: item.timestamp
      imgPath:   item.imgPath
      fullPath:  item.fullPath
      status: null

  @__markAll = (status) ->
    i = 0
    while i < @images().length
      newItem = @__cloneItem i
      newItem.status = status
      @images.splice i, 1, newItem

      @changes gallery.changes()+1
      i++
    return

  return

gallery = null

fetchKade = (offset = 0, limit = 100) ->
  requestUrl = 'https://emajliramokade.com/platform/Moderiraj.svc/KadaIzvorPodataka/NemoderiraneKade'
  imageBase = 'http://emajliramokade.com:10080/public/Slike/'

  jQuery.ajax
    type: 'GET'
    url:  requestUrl
    data:
      offset: offset
      limit:  limit
    dataType: 'json'
    headers:
      'Content-Type': 'application/json'
      Authorization:  'Basic cm9iaTppYm9y'
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
            imgPath:   imageBase+kada.URI+'/Thumbnail'
            fullPath:  imageBase+kada.URI+'/Email'

          gallery.images.push img
        return

      return
    error:    (response) ->
      console.warn 'Got error. ', response
      return
  return


$ ->
  $(window).on 'beforeunload', ->
    # browser is not really asking for following string, but at least it asks for confirmation...
    # don't have time for debugging it now, will do later.
    'Promjenjeno stanje '+gallery.changes()+' slike/a, da li sigurno želite napustiti stranicu?'


  gallery = new galleryModel()
  fetchKade()
  gallery.maxPages 3
  ko.applyBindings gallery

  return
