@echo off

:: Runs the application. You need to have at least JRE 6 installed on the path.
"%~dp0sbt.bat" "project Api" update container:start ~compile container:stop
