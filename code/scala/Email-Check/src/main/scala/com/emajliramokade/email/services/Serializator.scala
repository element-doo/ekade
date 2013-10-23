package com.emajliramokade
package email.services

import hr.ngs.patterns.ISerialization

trait Serializator {
  def serialization: ISerialization[String]
}
