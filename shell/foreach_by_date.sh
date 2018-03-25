#!/usr/bin/env bash
date_list=(
20180323
20180324
20180325
)
for date in ${date_list[@]};
do
    echo "In foreach, date: ${date}"
done
