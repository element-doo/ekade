@echo off
setlocal

java ^
  -jar "%~dp0dsl-clc.jar" latest ^
  --project-ini-path="%~dp0project.ini" ^
  --dsl-path="%~dp0model" ^
  --language=java,php ^
  --output-path="%~dp0generated" ^
  %*
