package com.emajliramokade
package services
package impl

import image.proto.ImageProvjera.{ Odgovor, Zahtjev }

import hr.ngs.patterns.ISerialization

class CRemoteImageVerifier()
    extends abstracts.RemoteImageVerifier
    with    RemotingZeroMQ[Zahtjev] {
  def serviceUrlFactory(t: Zahtjev) = "tcp://10.5.13.1:20000"
}
