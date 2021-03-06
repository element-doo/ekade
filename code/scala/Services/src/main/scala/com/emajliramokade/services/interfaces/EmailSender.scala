package com.emajliramokade
package services
package interfaces

import api.model.EmailProvjera.Odgovor
import email.Email

import scala.concurrent.Future

trait EmailSender {
  def send(email: Email): Future[Odgovor]
}
