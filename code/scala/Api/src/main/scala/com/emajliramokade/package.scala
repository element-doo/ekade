package com.emajliramokade

import scala.concurrent.ExecutionContext
import java.util.concurrent.Executors

object `package` {
  implicit val ec = ExecutionContext.fromExecutor(Executors.newCachedThreadPool())
}
