package com.emajliramokade
package services
package impl

import api.model.ImageResize.ResizeZahtjev

import hr.ngs.patterns.ISerialization

class CLispRemoteImageResizer()
    extends abstracts.RemoteImageResizer
    with    RemotingZeroMQ[Seq[ResizeZahtjev]] {
  def serviceUrlFactory(t: Seq[ResizeZahtjev]) = "tcp://144.76.184.25:10100"
}
