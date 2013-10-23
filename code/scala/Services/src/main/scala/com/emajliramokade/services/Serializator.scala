package com.emajliramokade
package services

import hr.ngs.patterns.ISerialization

trait Serializator {
  def serialization: ISerialization[String]
}
