package com.emajliramokade
package email

sealed abstract class Address(email: String, name: Option[String]) {
  override val toString = name match {
    case Some(n) => "\"%s\"<%s>".format(n, email)
    case _ => email
  }
}

case class From   (email: String, name: Option[String] = None) extends Address(email, name)
case class To     (email: String, name: Option[String] = None) extends Address(email, name)
case class ReplyTo(email: String, name: Option[String] = None) extends Address(email, name)
case class CC     (email: String, name: Option[String] = None) extends Address(email, name)
case class BCC    (email: String, name: Option[String] = None) extends Address(email, name)
