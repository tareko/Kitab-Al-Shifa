This document will allow you to install and run a virtual development environment.
This is thoroughly tested on Ubuntu, and I assume it works in other environments
with some care.

# Requirements

* [Vagrant](http://vagrantup.com)
* [VirtualBox](http://virtualbox.org)
* [My Debian wheezy box](https://dl.dropboxusercontent.com/u/99151903/wheezy.box).
You may also use any linux-based box, but this is the setup we use at Kitab Central.

# Procedure
```
$ vagrant box add wheezy https://dl.dropboxusercontent.com/u/99151903/wheezy.box
$ vagrant up
```