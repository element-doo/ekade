package com.emajliramokade
package services
package impl

import image.proto.ImageProvjera.{ Odgovor, Zahtjev }

import hr.ngs.patterns.ISerialization

class CRemoteImageVerifier()
    extends abstracts.RemoteImageVerifier
    with    RemotingZeroMQ[Zahtjev] {
  def serviceUrlFactory(t: Zahtjev) = "tcp://144.76.184.25:10030"
}
