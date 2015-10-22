### Installation (OSX):

- Install [Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
- Install [Virtualbox](https://www.virtualbox.org/wiki/Downloads)
- Install [Vagrant](https://www.vagrantup.com/)
- Install [Atom](https://atom.io/) (Optional - Recommended)
- Get invited to [DEMHUB Devs Group](https://bitbucket.org/account/user/demhub/groups/developers/) in [Bitbucket](https://bitbucket.org)
- Add local SSH key to [DEMHUB SSH Keys](https://bitbucket.org/account/user/demhub/ssh-keys/)

#### Inside Terminal

- `mkdir ~/workspace; cd ~/workspace`
- `git clone git@bitbucket.org:demhub/demhub.git; cd demhub`
- `vagrant box add laravel/homestead`
- `composer global require "laravel/homestead=~2.0"`
- `echo 'export PATH="$PATH:~/.composer/vendor/bin"' >> ~/.bashrc`
- `source ~/.bashrc`
- `homestead make`
- `vim Homestead.yaml`

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
