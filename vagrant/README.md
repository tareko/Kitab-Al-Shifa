This document will allow you to install and run a virtual development environment.
This is thoroughly tested on Ubuntu, and I assume it works in other environments
with some care.

# Requirements

* [Vagrant](http://vagrantup.com)
* [VirtualBox](http://virtualbox.org)
* [Ansible](http://releases.ansible.com/ansible/). If using Windows, **this will not work**.
* SSH. If using windows, get [PuTTY](http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html) and read [this](http://stackoverflow.com/questions/9885108/ssh-to-vagrant-box-in-windows).
* [My Debian wheezy box](https://dl.dropboxusercontent.com/u/99151903/wheezy.box).

You may also use any linux-based box, but this is the setup we use at Kitab Central.

# Procedure
```
$ vagrant box add wheezy https://dl.dropboxusercontent.com/u/99151903/wheezy.box
$ vagrant up
```