#!/bin/sh

dir="$( dirname "$(readlink -f "$0")" )"

java \
  -jar "$dir/dsl-clc.jar" latest \
  --project-ini-path="$dir/project.ini" \
  --dsl-path="$dir/model" \
  --language=java,php \
  --output-path="$dir/generated" \
  "$@"
