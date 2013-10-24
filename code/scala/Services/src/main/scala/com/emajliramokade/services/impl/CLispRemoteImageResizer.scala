package com.emajliramokade
package services
package impl

import hr.ngs.patterns.ISerialization

class CLispRemoteImageResizer()
    extends abstracts.RemoteImageResizer
    with    RemotingZeroMQ {
  val serviceUrl = "tcp://10.6.2.1:10100/"
}
