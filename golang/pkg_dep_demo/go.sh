#!/bin/bash
this_dir=$(cd $(dirname $0) && pwd)
export GOPATH=$this_dir/vendor:$this_dir
echo 'Use GOAPTH: ' $GOPATH
go $*

