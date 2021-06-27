#!/usr/bin/env bash

while alias= read -r line || [ -n "$line" ];
do
    echo $line >> ~/.bash_profile
done <<- EOL
alias art="php artisan"
alias p="php artisan"
alias pa"php artisan"
alias artisan="php artisan"
EOL
