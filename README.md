# WebRISC-V
[<img height="30" src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/version.png?raw=true"/>](https://github.com/Mariotti94/WebRISC-V/blob/master/docs/CHANGELOG.md)

WebRISC-V is a web-based graphical pipelined datapath simulation environment built for the [RISC-V instruction set architecture](https://content.riscv.org/wp-content/uploads/2017/05/riscv-spec-v2.2.pdf).
It is suitable for teaching how assembly level code is executed on the RISC-V pipelined architecture and for illustrating the Pipeline Architectural Elements.

[WebRISC-V is online and ready for use](http://www.dii.unisi.it/~giorgi/WebRISC-V)

<img src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/intro.png?raw=true"/>

- [WebRISC-V](#webrisc-v)
  - [Features](#features)
  - [Local Installation](#local-installation)

## Features

* 5-stage Graphical Pipeline 64-bit Simulator
  * Pipeline Schema taken from Patterson's 'Computer Organization and Design: RISC-V Edition' and enhanced
  * Visualize every Architectural Element and the Data and Control paths
  * Execute with or without the Forwarding and the Delay Slot
  * Keep track of the execution in the Pipeline
    * Instruction Memory | Data Memory | Registers
  * Pipeline Table to show the execution trace
  * Console to interact with the execution through implemented syscalls
* Supported instructions are the full **RV64I** Base Instruction Set (excluding: fence) and **RV64M** Standard Multiplication Extension
  * List of supported instruction with small descriptions of the underlying function visible on click
  * RISC-V Assembly small examples available

## Local Installation

You can install WebRISC-V on a local server.
The reference Installation has been done on the Linux distro UBUNTU 18.04LTS
(it works also on the Ubuntu shell in Windows-10).

* To install the web-server with the PHP language included issue the following commands:
```
  sudo apt -y update && sudo apt -y install apache2 php libapache2-mod-php
  sudo apt -y install php-gmp
  sudo ufw allow 'Apache'           (ufw may fail if you don't have ufw... just ignore it)
  a2enmod php7.2
  sudo systemctl status apache2     (alternatively you may want to run:
                                    sudo service apache2 start && sudo service apache2 status )

  --> you should see something like:
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

* To test if the web server with PHP works, open your local web-broswer (e.g., firefox) and open this page: \
[http://localhost](http://localhost)

At this point you should see: "Apache2 Ubuntu Default Page"

* To install the WebRISC-V software:
```
  cd /var/www/html
  sudo wget http://www.dii.unisi.it/~giorgi/WebRISC-V.tgz
  sudo tar xf WebRISC-V.tgz
  chmod -R 655 .
  chown www-data:www-data .
```
* in the browser open: \
[http://localhost/WebRISC-V](http://localhost/WebRISC-V)

And here it is ready for use.
