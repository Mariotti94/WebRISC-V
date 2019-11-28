# WebRISC-V

[<img width="100" src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/img/version.png?raw=true"/>](https://github.com/Mariotti94/WebRISC-V/blob/master/docs/CHANGELOG.md)

WebRISC-V is a web-based graphical pipelined datapath simulation environment built for the [RISC-V instruction set architecture](https://content.riscv.org/wp-content/uploads/2017/05/riscv-spec-v2.2.pdf).
It is suitable for teaching how assembly level code is executed on the RISC-V pipelined architecture and for illustrating the Pipeline Architectural Elements.

[WebRISC-V is online and ready for use](http://www.dii.unisi.it/~giorgi/WebRISC-V)

<img src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/intro.gif?raw=true"/>

- [WebRISC-V](#webrisc-v)
  - [Features](#features)
  - [Usage](#usage)
    - [Commands and Options Panel](#commands-and-options-panel)
    - [Execution Status Panel](#execution-status-panel)
    - [Main Panel](#main-panel)
  - [Local Installation](#local-installation)

## Features

* 5-stage Graphical Pipeline Simulator [Pipeline as described in Patterson's 'Computer Organization and Design: RISC-V Edition']
  * Visualize every Architectural Element and the Data and Control paths
  * Keep track of the execution in the Pipeline
    * Instruction Memory | Data Memory | Registers
  * Pipeline Table to show the execution trace
  * Console to interact with the execution through implemented syscalls
* Supported instructions are a significant subset of the **RV64I** Base Instruction Set and **RV64M** Standard Multiplication Extension
  * List of supported instruction shown
  * RISC-V Assembly examples avalaible for use

## Usage

#### Commands and Options Panel

<span>
  <img width="32.3%" src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/img/commands.png?raw=true"/>
  <img width="26%" src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/img/exec_options.png?raw=true"/>
  <img width="31.6%" src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/img/vis_options.png?raw=true"/>
</span>

* Commands
  * Load Program: Open the Editor
  * Pipeline in New Window: Show the Pipeline schema in a standalone window
  * System Reset: Reinitialize the Simulator
  * Execute All | Step Forward | Step Back: Once a program is loaded, to go back and forth in the execution
* Execution Options
  * Jump Control Hazard Resolution selector, changing the execution mode
    * Flush the instruction past the branch
    * Execute the instruction past the branch [Delay Slot]	
* Visualization Options
  * Popup Elements on Hover: Show the internal state of an element on mouse hovering
  * Show Data Path | Show Control Path: Show or hide the Data and Control paths
  
#### Execution Status Panel

<span>
  <img width="24%" src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/img/info_box.png?raw=true"/>
  <img width="21.6%"  src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/img/instr_mem.png?raw=true"/>
  <img width="22.4%" src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/img/data_mem.png?raw=true"/> 
  <img width="25.5%" src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/img/registers.png?raw=true"/>
</span>

* Info Box
  * Shows program name and current clock
  * Execution Table: Opens the Pipeline Table to show the execution trace
  * Console: Opens the Console
  * Shows Stages that are Empty or in Stall
  * Shows alert at end of execution and for console interactions
* Instruction Memory
  * Current stage of the Instruction into the Pipeline and if it generated a Stall
  * Instruction: Address Decimal and Hex value, Type, Full instruction, Binary value, Fields Binary and Decimal value  
* Data Memory
  * Little Endian Addressing
  * Show Dwords(64-bit):
    * At specific address
    * At a range of addresses
    * Full content of memory
  * Dword: Decimal value of itself and his two Word(32-bit) subsets, Bytes Binary and Decimal values, Address Decimal value
* Registers
  * Register: Number, Identification name, Decimal and Binary value
  
  
#### Main Panel

<span>
  <img width="49%" src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/img/schema.png?raw=true"/>
  <img  width="49%" src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/img/editor.png?raw=true"/>
</span>

* Schema Layout
  * Clickable Architectural Elements to explore the Pipeline
* Editor
  * Example List: RISC-V Assembly examples ready to load into the Textbox
  * Load in Memory: Load Assembly into the Instruction Memory
  * Clear Textbox: Empty the Textbox
  * Return to Pipeline: Go back to the Pipeline Schema Layout
  * List of Instructions: Simulator implemented instructions

## Local Installation

You can install WebRISC-V on a local server.
The reference Installation has been done on the Linux distro UBUNTU 18.04LTS
(it works also on the Ubuntu shell in Windows-10).

* To install the web-server with the PHP language included issue the following commands:
```
  sudo apt -y update && sudo apt -y install apache2 php libapache2-mod-php
  sudo apt -y install php-pear php-fpm php-dev php-zip php-curl php-gd php-mysql php-mbstring php-xml php-xmlrpc php-gmp
  sudo ufw allow 'Apache'           (ufw may fail if you don't have ufw... just ignore it)
  a2enmod php7.2
  sudo systemctl status apache2	    (alternatively you may want to run:
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
