### Installation (OSX):

#### Dev basics
- Install [XCode](https://developer.apple.com/xcode/download/)
- Install [Homebrew](http://brew.sh/)
> `ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"`
- Install [Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
> `brew install composer`
- Install [Virtualbox](https://www.virtualbox.org/wiki/Downloads)
- Install [Vagrant](https://www.vagrantup.com/)
- Install [XQuartz](http://www.xquartz.org/) for Browser Automated Testing

#### Highly suggested tools
- Install [Atom](https://atom.io/) OR [PHPStorm](https://www.jetbrains.com/phpstorm/) for code editing
- Install [BetterTouchTool](http://www.boastr.net/) for general increased productivity
- Install [Sequel Pro](http://www.sequelpro.com/) for DB management
- Install [Slack](https://slack.com/) for team communication


#### Before Getting Started
- Create a bitbucket account
- Get invited to [DEMHUB Devs Group](https://bitbucket.org/account/user/demhub/groups/developers/) in [Bitbucket](https://bitbucket.org)
- Generate and copy SSH key (`ssh-keygen -t rsa` followed by `cat ~/.ssh/id_rsa.pub | pbcopy`)
- Add local SSH key to [DEMHUB SSH Keys](https://bitbucket.org/account/user/demhub/ssh-keys/)
> Adding an SSH Key to either [BitBucket](https://bitbucket.org/) or [DigitalOcean](https://www.digitalocean.com/) (for access to the staging and production servers) needs to be done by an administrator.
> Talk to [Aldo](mailto:aldo.ruiz.luna@gmail.com) or [Leon](mailto:lhaggarty@ryerson.ca) for that
- Create a [PivotalTracker](https://www.pivotaltracker.com/) account
- Get invited as a [PivotalTracker DEMHUB Member](https://www.pivotaltracker.com/projects/1425544/memberships)

#### Inside Terminal

- `mkdir ~/workspace; cd ~/workspace`
- `git clone git@bitbucket.org:demhub/demhub.git; cd demhub`
- `vagrant box add laravel/homestead`
- `composer global require "laravel/homestead=~2.0"`
- Follow the next two instructions with the following snippet of code:

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
alias ams='php artisan migrate:refresh --seed'

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
- `vim ~/.homestead/aliases` (The above snippet should be added at the top of aliases)

```bash
#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.

echo('Updating app-get')
apt-get update

echo('Installing Java, Firefox, and Xvfb')
apt-get install -y openjdk-7-jre firefox xvfb

echo('Installng Selenium')
npm install -g selenium-standalone
selenium-standalone install

echo('Installing Elasticsearch Public Signing Key')
wget -qO - http://packages.elasticsearch.org/GPG-KEY-elasticsearch | sudo apt-key add -

echo('Adding repository')
echo "deb http://packages.elastic.co/elasticsearch/2.x/debian stable main" | sudo tee -a /etc/apt/sources.list.d/elasticsearch-2.x.list

echo('Updating Aptitude')
sudo apt-get update

echo('Installing Elasticsearch')
sudo apt-get install elasticsearch

echo('Setting Elasticsearch to run on startup')
update-rc.d elasticsearch defaults 95 10

echo('Starting Elasticsearch server')
/etc/init.d/elasticsearch start
```

- `vim ~/.homestead/after.sh` (The above snippet should replace the contents of after.sh)
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
> **Note** that if the previous step fails, you may need to change /etc/hosts file permissions with the following command:
> `sudo chmod +a "$USER allow read,write" /etc/hosts`

- `homestead up`
- One by one, visit each one of these links and wait for their individual outputs. These will populate the DB with article entries from various news sources.

```
http://demhub.dev/scheduler/scrapeRSS
http://demhub.dev/scheduler/scrapeCustom?source=IRDR&page_from=1&page_to=1
http://demhub.dev/scheduler/scrapeCustom?source=EC&page_from=1&page_to=1
http://demhub.dev/scheduler/scrapeCustom?source=EC-PR&page_from=1&page_to=1
http://demhub.dev/scheduler/scrapeCustom?source=GIAC&page_from=1&page_to=1
```

#### First time after starting the Homestead machine
- `homestead ssh`
- `export DISPLAY=localhost:10.0`
- `cd /vagrant`
- `vim Vagrantfile`
- Follow the next instruction with the following snippet of code:
```shell
Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    ...etc...

    if File.exists? afterScriptPath then
        config.vm.provision "shell", path: afterScriptPath
    end

    config.ssh.forward_x11 = true
    config.vm.network "forwarded_port", guest: 9200, host: 62000
end
```
- Add `config.ssh.forward_x11 = true` as indicated in the above snippet
- `cd ~/workspace/demhub`
- `larafullnew` (For commands breakdown, refer to aliases above)
- `exit` in order to let all box changes take effect

#### Start developing

- `homestead ssh`
- `cd ~/workspace/demhub`
- Open Chrome (preferably) and visit `demhub.dev`

#### Before commiting (if applicable)
- `git config --global user.name "Your Name"`
- `git config --global user.email you@example.com`

OR
- commit inside the demhub folder, outside vagrant/homestead

#### Local DB Connection via Sequel Pro
- On the bottom left corner, select the "+" sign and name the new favorite connection "homestead-demhub"
- Under "Enter connection details below" choose the SSH tab
- Fill in the following:

| Field         | Value             |
| --------------|:-----------------:|
| Name          | homestead-demhub  |
| MySQL Host    | 127.0.0.1         |
| Username      | homestead         |
| Password      | secret            |
| Database      | homestead         |
| Port          | 3306              |
| SSH Host      | 127.0.0.1         |
| SSH User      | vagrant           |
| SSH Password  | ~/.ssh/id_rsa.pub |
| SSH Port      | 2222              |

- Save Changes
- Connect
