#!/usr/bin/env bash

while alias= read -r line || [ -n "$line" ];
do
    echo $line >> ~/.bash_profile
done < $PWD/src/aliases