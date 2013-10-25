package com.emajliramokade
package services

import hr.ngs.patterns.ISerialization

trait Serializator {
  protected def serialization: ISerialization[String]
}
