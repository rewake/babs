#!/usr/bin/env bash

file=~/.bash_profile
curdir=$(cd "$(dirname "${BASH_SOURCE[0]}")"; pwd -P)

# Empty file
> $file

# Write aliases to file
while alias= read -r line || [ -n "$line" ];
do
    echo $line >> $file
done < $curdir/aliases

# Source the aliases
source $file