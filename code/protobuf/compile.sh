#!/bin/dash

# Protobuf 2.5.0 downloaded from http://code.google.com/p/protobuf/downloads/list
# Compiles proto files from model/ into java and cpp classes.
protoc --cpp_out=cpp --java_out=java model/*.proto
