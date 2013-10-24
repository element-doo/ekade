package com.emajliramokade
package email

import scala.xml.Elem

sealed abstract class MailElement[T](value: T) {
  override val toString = value.toString
}

case class Subject(body: String) extends MailElement[String](body)
case class TextBody(body: String) extends MailElement[String](body)
case class HtmlBody(body: String) extends MailElement[String](body)
case class XHtmlBody(body: Elem) extends MailElement[Elem](body)
