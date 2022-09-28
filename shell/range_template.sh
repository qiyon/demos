#!/usr/bin/env bash

START=100
END=105

for i in $(seq $START $END); do
	MSG=msg:$i:$(($i+100))
	echo $MSG
done

