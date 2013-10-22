package com.emajliramokade

object `package` {
  implicit val executionContext =
    scala.concurrent.ExecutionContext.fromExecutor(
        java.util.concurrent.Executors.newCachedThreadPool())
}
