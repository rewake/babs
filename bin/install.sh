#!/usr/bin/env bash

file=~/.bash_profile
curdir=$(cd "$(dirname "${BASH_SOURCE[0]}")"; pwd -P)

# Empty file
> $file

# Write aliases to file
while alias= read -r line || [ -n "$line" ];
do
echo $line >> $file
done <<- EOL
alias pa='php artisan'
alias pas='php artisan serve'
alias pam='php artisan migrate'
alias pamf='php artisan migrate:fresh'
alias mig='php artisan make:migration'
alias migration='php artisan make:migration'
alias mod='php artisan make:model'
alias model='php artisan make:model'
alias cont='php artisan make:controller'
alias contract='php artisan make:controller'
alias pol='php artisan make:policy'
alias policy='php artisan make:policy'
alias mw='php artisan make:middleware'
alias middleware='php artisan make:middleware'
alias rl='php artisan route:list'
alias parl='php artisan route:list'
alias routes='php artisan route:list'
alias routelist='php artisan route:list'
alias pretty='php artisan route:pretty'
alias pr='php artisan route:pretty'
alias pat='php artisan tinker'
alias tink='php artisan tinker'
alias tinker='php artisan tinker'
alias c='composer'
alias ci='composer install'
alias cr='composer require'
alias crm='composer remove'
alias cup='composer update'
alias cug='composer upgrade'
alias sail='vendor/bin/sail'
alias sa='vendor/bin/sail artisan'
alias sud='vendor/bin/sail up -d'
alias sd='vendor/bin/sail down'
EOL

# Source the aliases
source $file