# WebRISC-V

WebRISC-V is a web-based graphical pipelined datapath simulation environment built for the [RISC-V instruction set architecture](https://content.riscv.org/wp-content/uploads/2017/05/riscv-spec-v2.2.pdf) in PHP, suitable for teaching how assembly level code is executed on the RISC-V pipelined architecture and illustrating its architectural elements.

WebRISC-V is already online and ready to use, at the following link: [VERSION 1.3](http://www.dii.unisi.it/~giorgi/WebRISC-V)

CURRENT VERSION on GitHub: VERSION 1.4

- [WebRISC-V](#WebRISC-V)
  - [Changelog](#changelog)
  - [Local Installation](#installation)
  
## Changelog

###VERSION 1.5

* Multiple steps backwards now possible
* Fixes to schema shown data
* UI improvements

###VERSION 1.4

* Adjustment of Pipeline schema branch logic
* UI improvements

###VERSION 1.3a

* Implementation of EBREAK
* UI improvements

###VERSION 1.3

* Implementation of ECALL
	* Implementation of a console to execute certain syscalls
* UI improvements

###VERSION 1.2a

* UI improvements

###VERSION 1.2

* Float to GMP numbers to remove approximation errors
* Jump Control Hazard Resolution Selector [Flush Instruction || Execute Delay Slot]
	* Load-and-Play Examples change with the selection
* Implementation of SRAI
* Small Bugfixes

###VERSION 1.1

* Implementation of SLLI, SRLI
* Implementation of Pipelining Table to better show execution
* Small Bugfixes

###VERSION 1.0

* Initial version, as described on the paper [WebRISC-V: a Web-Based Education-Oriented RISC-V Pipeline Simulation Environment
](https://dl.acm.org/citation.cfm?id=3338894)

  
## Local Installation

You can install WebRISC-V on a local server.
The reference Installation has been done on the Linux distro UBUNTU 18.04LTS
(it works also on the Ubuntu shell in Windows-10).

* To install the web-server with the PHP language included issue the following commands:
```
  sudo apt -y update && sudo apt -y install apache2 php libapache2-mod-php
  sudo apt -y install php-pear php-fpm php-dev php-zip php-curl php-gd php-mysql php-mbstring php-xml php-xmlrpc php-gmp
  sudo ufw allow 'Apache'
  a2enmod php7.2
  sudo systemctl status apache2 	(alternatively you may want to run:
									sudo service apache2 start && sudo service apache2 status )
  
  --> you should see somthing like (ufw may fail if you don't have ufw... just ignore it):
    apache2.service - The Apache HTTP Server
    Loaded: loaded (/lib/systemd/system/apache2.service; enabled; vendor preset: enabled)
    Drop-In: /lib/systemd/system/apache2.service.d
           └─apache2-systemd.conf
    Active: active (running) since Tue 2019-05-15 10:12:29 UTC; 1min ago
    Main PID: 4867 (apache2)
    Tasks: 52 (limit: 1101)
    CGroup: /system.slice/apache2.service
           ├─4868 /usr/sbin/apache2 -k start
           ├─4869 /usr/sbin/apache2 -k start
           └─4870 /usr/sbin/apache2 -k start
```

* To test if the web server with PHP works, open your local web-broswer (e.g., firefox)
and open this page:
  
  <a href="http://localhost/">http://localhost/</a>
  
At this point you should see: "Apache2 Ubuntu Default Page"

* To install the WebRISC-V software:
```
  cd /var/www/html
  sudo wget http://www.dii.unisi.it/~giorgi/WebRISC-V.tgz
  sudo tar xf WebRISC-V.tgz
  chmod -R 655 .
  chown www-data:www-data .
```
* in the browser open:
  <a href="http://localhost/WebRISC-V">http://localhost/WebRISC-V</a>
  
And here it is ready to use.
