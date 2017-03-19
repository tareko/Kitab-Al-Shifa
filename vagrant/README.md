This document will allow you to install and run a virtual development environment.
This is thoroughly tested on Ubuntu, and I assume it works in other environments
with some care.

# Requirements

* [Vagrant](http://vagrantup.com)
* [VirtualBox](http://virtualbox.org)
* [Ansible](http://releases.ansible.com/ansible/). If using Windows, **this will not work**.
* SSH. If using windows:
  * Get [PuTTY](http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html)
  * Get [PuTTYGen](http://the.earth.li/~sgtatham/putty/0.63/htmldoc/Chapter8.html#puttygen-conversions)
  * Read [this](http://stackoverflow.com/questions/9885108/ssh-to-vagrant-box-in-windows).
* [My Debian wheezy box](https://dl.dropboxusercontent.com/u/99151903/wheezy.box).

You may also use any linux-based box, but this is the setup we use at Kitab Central.

# Procedure
```
$ sudo apt install virtualbox vagrant ansible
$ vagrant box add wheezy https://www.dropbox.com/s/gikfk6vq2ve224q/wheezy.box
$ vagrant up
```
