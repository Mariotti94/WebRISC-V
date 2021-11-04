# WebRISC-V
[<img height="30" src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/version.png?raw=true"/>](https://github.com/Mariotti94/WebRISC-V/blob/master/docs/CHANGELOG.md)

WebRISC-V is a web-based graphical pipelined datapath simulation environment built for the [RISC-V instruction set architecture](https://content.riscv.org/wp-content/uploads/2017/05/riscv-spec-v2.2.pdf).
It is suitable for teaching how assembly level code is executed on the RISC-V pipelined architecture and for illustrating the Pipeline Architectural Elements.

[WebRISC-V is online and ready for use](http://www.dii.unisi.it/~giorgi/WebRISC-V)

<img src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/intro.png?raw=true"/>

## Publication

If you would like to cite WebRISC-V, please use this reference:

```
@InProceedings{Giorgi19-wcae,
  author = {Giorgi, Roberto and Mariotti, Gianfranco},
  title = {{WebRISC-V}: a Web-Based Education-Oriented  RISC-V Pipeline Simulation Environment},
  booktitle = "ACM Workshop on Computer Architecture Education (WCAE-19)",
  address = "Phoenix, AX, (USA)",
  pages = "1-6",
  rkey = "",
  surl = "",
  month = "jun",
  year = "2019",
  url = "http://www.dii.unisi.it/~giorgi/papers/Giorgi19-wcae.pdf",
  doi = "10.1145/3338698.3338894",
  isbn= "978-1-4503-6842-1/19/06",
  dxdo="http://doi.acm.org/",
  scopus="2-s2.0-8507127341"
}
```

## Table of Contents
- [WebRISC-V](#webrisc-v)
  - [Features](#features)
  - [Local Installation](#local-installation)
    - [Option 1: Apache](#option-1-apache)
    - [Option 2: Docker](#option-2-docker)

### Features

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

### Local Installation

You can install WebRISC-V on a local server.
The reference Installation has been done on the Linux distro Ubuntu 18.04 LTS
(it works also on the Ubuntu WSL in Windows 10).

#### Option 1: Apache

* To install the web-server Apache with the PHP interpreter issue the following commands:
```
  sudo apt -y update
  sudo apt -y install apache2 php libapache2-mod-php
  sudo apt -y install php-gmp
  sudo ufw allow "Apache"           (ufw may fail if you don't have ufw... just ignore it)
  sudo systemctl status apache2

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
* To install the WebRISC-V software:
```
  wget https://github.com/Mariotti94/WebRISC-V/archive/refs/heads/master.zip -O WebRISC-V-master.zip
  unzip WebRISC-V-master.zip
  sudo rm /var/www/html/*
  sudo mv WebRISC-V-master/www/* /var/www/html/
```
* In the browser now you can open WebRISC-V: \
[http://localhost](http://localhost)

#### Option 2: Docker

* To install docker and docker-compose issue the following commands:
```
sudo apt-get update
sudo apt-get install ca-certificates curl gnupg lsb-release
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update
sudo apt-get install docker-ce docker-ce-cli containerd.io
sudo systemctl start docker
sudo systemctl enable docker
sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```
* To install the WebRISC-V docker container:
```
  wget https://github.com/Mariotti94/WebRISC-V/archive/refs/heads/master.zip -O WebRISC-V-master.zip
  unzip WebRISC-V-master.zip
  cd WebRISC-V-master
  sudo docker-compose up -d --build
```
* In the browser now you can open WebRISC-V: \
[http://localhost](http://localhost)
