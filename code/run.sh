java \
  -Xss2m -Xms2g -Xmx2g -XX:+TieredCompilation -XX:ReservedCodeCacheSize=256m -XX:MaxPermSize=512m -XX:+CMSClassUnloadingEnabled -XX:+UseNUMA -XX:+UseParallelGC \
  -Dscalac.patmat.analysisBudget=off -Drun.mode=development -jar \
  project/strap/gruj_vs_sbt-launch-0.13.0.jar \
  "project Api" update container:start ~compile container:stop
