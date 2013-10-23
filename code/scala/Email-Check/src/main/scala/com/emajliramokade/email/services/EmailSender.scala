package com.emajliramokade
package email.services

import api.model.EmailProvjera.Odgovor
import email.Email

import scala.concurrent.Future

trait EmailSender {
  def send(email: Email): Future[Odgovor]
}
