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
    @isWorking true

    data = []
    @images().forEach (item) ->
      data.push item  if item.status isnt null
      return
    console.log '--> ', JSON.stringify data

    setTimeout (->
      gallery.isWorking false
    ), 5000
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

  @actionAddRandom = ->
    __statuses = [null, null, null, true, false]
    _w = 200 + Math.round(Math.random()*50)
    _h = 100 + Math.round(Math.random()*100)
    img =
      name:   'Image'
      path:   'http://placekitten.com/'+_w+'/'+_h
      width:  _w
      height: _h
      status: __statuses[Math.round(Math.random()*5)]

    @images.push img
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
      name:   item.name
      path:   item.path
      width:  item.width
      height: item.height
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

fetchKade = (offset = 0, limit = 20) ->
  url = 'https://emajliramokade.com/platform/Moderiraj.svc/KadaIzvorPodataka/NemoderiraneKade'
  jQuery.ajax
    type: 'GET'
    url:  url
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
        img =
          URI:    item.URI
          path:   item.slikeKade
          width:  0
          height: 0
          status: null
          timestamp: item.dodana

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
  ###
  i = 0
  __statuses = [null, null, null, true, false]
  while i < 20
    _w = 200 + Math.round(Math.random()*50)
    _h = 100 + Math.round(Math.random()*100)
    img =
      URI:   'Image-'+(i+1)
      path:   'http://placekitten.com/'+_w+'/'+_h
      width:  _w
      height: _h
      status: __statuses[Math.round(Math.random()*5)]

    gallery.images.push img
    i++
  ###

  gallery.maxPages Math.round(2 + Math.random()*4)
  ko.applyBindings gallery

  return
