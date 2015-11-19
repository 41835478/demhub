### Installation (OSX):

- Install [Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) (`brew install composer`)
- Install [Virtualbox](https://www.virtualbox.org/wiki/Downloads)
- Install [Vagrant](https://www.vagrantup.com/)
- Install [Atom](https://atom.io/) (Optional - Recommended)
- Get invited to [DEMHUB Devs Group](https://bitbucket.org/account/user/demhub/groups/developers/) in [Bitbucket](https://bitbucket.org)
- Add local SSH key to [DEMHUB SSH Keys](https://bitbucket.org/account/user/demhub/ssh-keys/) (`ssh-keygen -t rsa`)

#### Inside Terminal

- `mkdir ~/workspace; cd ~/workspace`
- `git clone git@bitbucket.org:demhub/demhub.git; cd demhub`
- `vagrant box add laravel/homestead`
- `composer global require "laravel/homestead=~2.0"`

```bash
#################################
## Laravel Development Aliases ##
#################################

alias pu='vendor/bin/phpunit'
alias ps='vendor/bin/phpspec'
alias phpspec='vendor/bin/phpspec'
alias psr='vendor/bin/phpspec run'
alias co='vendor/bin/codecept'
alias codecept='vendor/bin/codecept'
alias cr='vendor/bin/codecept run'
alias crf='vendor/bin/codecept run functional'
alias cri='vendor/bin/codecept run integration'
alias cru='vendor/bin/codecept run unit'
alias cra='vendor/bin/codecept run acceptance'
alias be='vendor/bin/behat'
alias behat='vendor/bin/behat'

alias vm='vagrant ssh'
alias hu='homestead up'
alias hvm='homestead ssh'
alias hs='homestead ssh'
alias hson='homestead up && homestead ssh'
alias hss='homestead suspend'
alias hsoff='homestead halt'

alias cu='composer update'
alias cda='composer dump-autoload -o'

alias selenium-start='xvfb-run --server-args=\"-screen 0, 1366x768x24\" selenium-standalone start' #To run headless selenium

alias art='php artisan'
alias migrate='php artisan migrate'
alias pam='php artisan migrate'
alias pad='php artisan db:seed'
alias pat='php artisan tinker'
alias mc='php artisan make:controller'
alias me='php artisan make:event'
alias mmo='php artisan make:model'
alias mm='php artisan make:migration:schema'
alias mp='php artisan make:migration:pivot'
alias ms='php artisan make:seed'
alias mpr='php artisan make:provider'
alias rl='php artisan route:list'
alias akey='php artisan key:generate'
alias mc='php artisan make:controller'
alias mms='php artisan make:migration:schema'

alias larafresh='composer dump-autoload && php artisan cache:clear && php artisan clear-compiled && php artisan optimize && php artisan migrate:refresh --seed'
alias laraquick='composer dump-autoload && php artisan cache:clear && php artisan clear-compiled' #Same as above except without the db refresh
alias larafull='rm -rf vendor && rm -rf node_modules && composer install && npm install && gulp && php artisan clear-compiled && php artisan optimize && php artisan migrate:refresh --seed'
alias larafullnew='rm -rf vendor && rm -rf node_modules && composer install && npm install && cp .env.example .env && php artisan key:generate && gulp && php artisan clear-compiled && php artisan optimize && php artisan migrate:refresh --seed' #Same as larafull plus .env creation with keys
alias larafullbow='rm -rf vendor && rm -rf node_modules && composer install && npm install && bower install && gulp && php artisan clear-compiled && php artisan optimize && php artisan migrate:refresh --seed' # Same as larafull plus bower

#########
## GIT ##
#########

alias stat="git status"
alias gadd="git add -A"
alias push="git push origin master"
alias pull="git pull origin master"

############
## OTHERS ##
############

alias c='clear'
alias h='cd ~'
alias ll="ls -laGFh"
alias ..='cd ..'
alias ...='cd ../..'
alias ....='cd ../../..'
alias .....='cd ../../../..'

###############
## ENDS HERE ##
###############
```

- `vim ~/.bash_profile` (The above snippet should be added at the top of .bash_profile)
- `vim ~/.homestead/aliases` (The following snippet should be added at the top of aliases)
- `echo 'export PATH=~/.composer/vendor/bin:$PATH' >> ~/.bash_profile`
- `source ~/.bash_profile`
- `homestead init`
- `homestead edit`

```yaml
---
folders:
    - map: "~/workspace"
      to: "/home/vagrant/workspace"

sites:
    - map: demhub.dev
      to: "/home/vagrant/workspace/demhub/public"

```

- `echo -e "\n#DEMHUB Dev\n192.168.10.10 demhub.dev" >> /etc/hosts`
- `homestead up`

#### Start developing

- `homestead ssh`
- `cd ~/workspace/demhub`
- `larafullnew` <!-- For commands breakdown, refer to aliases (above) -->
- Open Chrome (preferably) and visit `demhub.dev`

#### Before commiting (if applicable)
- `git config --global user.name "Your Name"`
- `git config --global user.email you@example.com`

OR

- commit inside the demhub folder, outside vagrant/homestead
