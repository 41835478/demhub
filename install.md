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
- `composer install`
- `npm install`
- `cp .env.example .env`
- `artisan key:generate`
- `artisan migrate:refresh --seed`
- Open Chrome and visit `demhub.dev`

#### Before commiting
- `git config --global user.name "Your Name"`
- `git config --global user.email you@example.com`

OR

- commit inside the demhub folder, outside vagrant
