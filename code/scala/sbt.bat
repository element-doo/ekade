@echo off
setlocal
pushd
cd "%~dp0"

:: If called without arguments, SBT will do nothing, and exit.
:: This adds "shell" argument if argument list is empty.
if %1.==. set DEFAULT=shell

:: Runs SBT with enterprise defaults.
java ^
  -Xss2m -Xms4g -Xmx4g ^
  -XX:+TieredCompilation -XX:ReservedCodeCacheSize=256m -XX:MaxPermSize=512m -XX:+CMSClassUnloadingEnabled -XX:+UseNUMA -XX:+UseParallelGC ^
  -Dscalac.patmat.analysisBudget=off -Drun.mode=production ^
  -jar project/strap/gruj_vs_sbt-launch-0.13.0.jar ^
  %*

popd
endlocal
