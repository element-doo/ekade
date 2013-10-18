#!/bin/dash

# Runs the application. You need to have at least JRE 6 installed on the path.
`dirname $0`/sbt.sh "project Api" update container:start ~compile container:stop
